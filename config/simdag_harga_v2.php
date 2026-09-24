<?php

return [
    // Konfigurasi dibuat langsung agar deployment Dataku tidak memerlukan
    // perubahan .env atau perintah Artisan. Isi nilai production sebelum upload.
    // File ini memuat secret: jangan publikasikan atau masukkan ke repository publik.
    'base_url' => 'https://api.simdag.salatiga.go.id',
    'integration_key' => 'integration-test-key',
    'cutover_date' => '2026-08-20',
    'sync_after' => '14:00:00',
    'timeout_seconds' => 15,

    'markets' => [
        [
            'id' => 'a1380035-0353-496f-8e41-5124a83671be',
            'display_name' => 'PASAR REJOSARI',
        ],
        [
            'id' => '192f8e0b-63b9-4543-bc7a-3ea8a3408147',
            'display_name' => 'PASAR BLAURAN',
        ],
        [
            'id' => 'f4afad23-85c2-4217-892b-a2a5fd4649cc',
            'display_name' => 'PASAR RAYA I',
        ],
    ],
];
