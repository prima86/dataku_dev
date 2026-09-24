<?php

namespace App\Http\Controllers;

use DateInterval;
use DatePeriod;
use DateTimeImmutable;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class HargaController extends Controller
{
    /**
     * Menampilkan data lokal dan, setelah jam sinkronisasi, mengambil tanggal
     * yang belum tersimpan dari SIMDAG V2. Controller ini tidak pernah memanggil V1.
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $today = new DateTimeImmutable('today');
        $settings = $this->simdagSettings();
        $cutoverDate = new DateTimeImmutable((string) $settings['cutover_date']);
        $syncAfter = strtotime($today->format('Y-m-d') . ' ' . $settings['sync_after']);

        if ($today >= $cutoverDate && time() >= $syncAfter) {
            try {
                $this->synchronizeMissingDates($cutoverDate, $today);
            } catch (Throwable $exception) {
                // Halaman tetap menampilkan data lokal terakhir ketika API gagal.
                Log::warning('Sinkronisasi harga SIMDAG V2 gagal.', [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        $latestDate = DB::table('harga_komoditi')->max('tanggal');
        $result = $latestDate === null
            ? collect()
            : DB::table('harga_komoditi')
                ->where('tanggal', $latestDate)
                ->orderBy('nama_pasar')
                ->orderBy('nama_komoditi')
                ->get();

        return view('harga.index', [
            'tanggal' => $latestDate ?: $today->format('Y-m-d'),
            'result' => $result,
        ]);
    }

    /**
     * Mengambil seluruh tanggal setelah data terakhir. Tanggal sebelum cutover
     * tidak pernah diminta ke V2. Satu tanggal hanya disimpan jika ketiga pasar
     * berhasil mengembalikan data, sehingga data parsial tidak menjadi tanggal terbaru.
     */
    private function synchronizeMissingDates(DateTimeImmutable $cutoverDate, DateTimeImmutable $today)
    {
        $latestDate = DB::table('harga_komoditi')->max('tanggal');
        $startDate = $latestDate === null
            ? $cutoverDate
            : (new DateTimeImmutable($latestDate))->modify('+1 day');

        if ($startDate < $cutoverDate) {
            $startDate = $cutoverDate;
        }

        if ($startDate > $today) {
            return;
        }

        $period = new DatePeriod(
            $startDate,
            new DateInterval('P1D'),
            $today->modify('+1 day')
        );

        foreach ($period as $date) {
            $rows = $this->fetchCompleteDate($date->format('Y-m-d'));

            if ($rows === null) {
                continue;
            }

            DB::transaction(function () use ($rows) {
                foreach ($rows as $row) {
                    DB::table('harga_komoditi')->updateOrInsert(
                        [
                            'tanggal' => $row['tanggal'],
                            'id_pasar' => $row['id_pasar'],
                            'id_komoditi' => $row['id_komoditi'],
                        ],
                        [
                            'nama_pasar' => $row['nama_pasar'],
                            'nama_komoditi' => $row['nama_komoditi'],
                            'harga' => $row['harga'],
                        ]
                    );
                }
            });
        }
    }

    /**
     * @return array|null Null berarti tanggal belum lengkap dan tidak boleh disimpan.
     */
    private function fetchCompleteDate($date)
    {
        $settings = $this->simdagSettings();
        $baseUrl = rtrim((string) $settings['base_url'], '/');
        $integrationKey = (string) $settings['integration_key'];
        $markets = $settings['markets'];

        if ($baseUrl === '' || $integrationKey === '') {
            throw new RuntimeException('Konfigurasi URL atau integration key SIMDAG V2 belum tersedia.');
        }

        if (!is_array($markets) || count($markets) !== 3) {
            throw new RuntimeException('Konfigurasi tiga pasar SIMDAG V2 belum lengkap.');
        }

        $rows = [];

        foreach ($markets as $market) {
            $marketId = isset($market['id']) ? trim((string) $market['id']) : '';
            $displayName = isset($market['display_name']) ? trim((string) $market['display_name']) : '';

            if ($marketId === '' || $displayName === '') {
                throw new RuntimeException('ID atau nama tampilan pasar SIMDAG V2 belum dikonfigurasi.');
            }

            $url = $baseUrl
                . '/api/v2/integration/harga-pasar/pasars/'
                . rawurlencode($marketId)
                . '/harga-harian/'
                . rawurlencode($date);

            $response = Http::acceptJson()
                ->withHeaders([
                    'X-SIMDAG-CLIENT-TYPE' => 'integration',
                    'X-SIMDAG-CLIENT-KEY' => $integrationKey,
                ])
                ->timeout((int) $settings['timeout_seconds'])
                ->retry(2, 300)
                ->get($url);

            $data = $this->validatedData($response, $marketId, $date);

            // Belum ada data Verified untuk salah satu pasar: jangan simpan tanggal parsial.
            if (count($data['komoditas']) === 0) {
                return null;
            }

            foreach ($data['komoditas'] as $commodity) {
                $rows[] = $this->transformCommodity($commodity, $data, $displayName, $date);
            }
        }

        return $rows;
    }

    private function validatedData(Response $response, $expectedMarketId, $expectedDate)
    {
        if (!$response->successful()) {
            throw new RuntimeException('SIMDAG V2 merespons HTTP ' . $response->status() . '.');
        }

        $payload = $response->json();

        if (!is_array($payload)
            || !isset($payload['success'])
            || $payload['success'] !== true
            || !isset($payload['data'])
            || !is_array($payload['data'])
        ) {
            throw new RuntimeException('Struktur respons SIMDAG V2 tidak valid.');
        }

        $data = $payload['data'];
        $actualMarketId = isset($data['pasar']['id']) ? (string) $data['pasar']['id'] : '';
        $actualDate = isset($data['tanggal']) ? (string) $data['tanggal'] : '';

        if ($actualMarketId !== (string) $expectedMarketId || $actualDate !== (string) $expectedDate) {
            throw new RuntimeException('Identitas pasar atau tanggal respons SIMDAG V2 tidak sesuai request.');
        }

        if (!isset($data['komoditas']) || !is_array($data['komoditas'])) {
            throw new RuntimeException('Daftar komoditas SIMDAG V2 tidak valid.');
        }

        return $data;
    }

    private function transformCommodity(array $commodity, array $data, $displayName, $date)
    {
        $commodityId = isset($commodity['id']) ? trim((string) $commodity['id']) : '';
        $name = isset($commodity['nama']) ? trim((string) $commodity['nama']) : '';
        $unit = isset($commodity['satuan']) ? trim((string) $commodity['satuan']) : '';
        $price = isset($commodity['harga']) ? $commodity['harga'] : null;

        if ($commodityId === '' || strlen($commodityId) > 36 || $name === '' || !is_numeric($price)) {
            throw new RuntimeException('Data komoditas SIMDAG V2 tidak valid.');
        }

        return [
            'tanggal' => $date,
            'nama_pasar' => $displayName,
            'id_pasar' => (string) $data['pasar']['id'],
            'id_komoditi' => $commodityId,
            'nama_komoditi' => $this->formatCommodityName($name, $unit),
            // Tabel Dataku lama bertipe INT dan view menampilkan harga tanpa desimal.
            'harga' => (int) round((float) $price, 0, PHP_ROUND_HALF_UP),
        ];
    }

    private function formatCommodityName($name, $unit)
    {
        if ($unit === '' || stripos($name, $unit) !== false) {
            return $name;
        }

        return $name . ' (' . $unit . ')';
    }

    /**
     * Membaca file konfigurasi secara langsung supaya deployment tetap bekerja
     * meskipun Dataku memakai config cache dan operator tidak dapat menjalankan Artisan.
     */
    private function simdagSettings()
    {
        static $settings;

        if ($settings === null) {
            $settings = require base_path('config/simdag_harga_v2.php');
        }

        return $settings;
    }
}
