<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Api_StatistikSektoralController extends Controller
{
    
    public function index()
    {
        //
    }
    
    public function get_kode_tabel()
    {
        $data = DB::table("dss_toc")
                      ->select("dss_toc.bab as bab", "dss_toc.name as judul", "dss_toc.table_name as kode_table")
                      ->where('availability', 1)
                      ->get();
                      
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => 'Tabel Ref Kode Tabel',
                'data' => $data
            ]);
    }

    public function get_data($kode_tabel)
    {
        //
        $data = DB::table($kode_tabel)
                        ->get();
                        
        $judul_data = DB::table("dss_toc")
                        ->where('table_name', $kode_tabel)
                        ->first()
                        ->name;
                        
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => $judul_data,
                'data' => $data
            ]);
    }
    
    public function get_data_by_year($kode_tabel, $tahun)
    {
        $data = DB::table($kode_tabel)
                        ->where('year', $tahun)
                        ->get();
        $judul_data = DB::table("dss_toc")
                        ->where('table_name', $kode_tabel)
                        ->first()
                        ->name;
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => $judul_data,
                'data' => $data
            ]);
    }

    public function get_kode_kelurahan()
    {
        $data = DB::table("ref_kelurahan")
                        ->select("ref_kelurahan.id_kelurahan as id_kelurahan", "ref_kelurahan.kelurahan as nama_kelurahan", "ref_kecamatan.kecamatan as nama_kecamatan", 
                            DB::raw("CONCAT('33.73.0', ref_kecamatan.kode_kecamatan, '.', ref_kelurahan.kode_kelurahan) AS kode_kelurahan")
                        )
                        ->leftJoin('ref_kecamatan', function ($join) {
                                $join->on("ref_kelurahan.id_kecamatan", "=", "ref_kecamatan.id_kecamatan");
                            })
                        ->get();
                      
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => 'Tabel Ref Kode Kelurahan',
                'data' => $data
            ]);
    }
    
    public function get_kode_kecamatan()
    {
        $data = DB::table("ref_kecamatan")
                        ->select("ref_kecamatan.id_kecamatan as id_kecamatan", "ref_kecamatan.kecamatan as nama_kecamatan",
                            DB::raw("CONCAT('33.73.0', ref_kecamatan.kode_kecamatan) AS kode_kecamatan")
                        )
                        ->get();
                      
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => 'Tabel Ref Kode Kecamatan',
                'data' => $data
            ]);
    }
    
    public function get_kode_opd()
    {
        $data = DB::table("opd")
                        ->select("opd.id as id_opd", "opd.opd as nama_opd", "opd.alias as alias")
                        ->where('status_opd_active', 1)
                        ->where('jenis_opd', '!=', 7)
                        ->get();
                      
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => 'Tabel Ref Kode OPD',
                'data' => $data
            ]);
    }
    
    public function get_kode_golongan_asn()
    {
        $data = DB::table("asn_golongan")
                        ->get();
                      
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => 'Tabel Ref Kode Golongan ASN',
                'data' => $data
            ]);
    }
    
    public function get_kode_agama()
    {
        $data = DB::table("agama")
                        ->get();
                      
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => 'Tabel Ref Kode Agama',
                'data' => $data
            ]);
    }
    
    public function get_kode_bulan()
    {
        $data = DB::table("month")
                        ->get();
                      
        return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'judul_data' => 'Tabel Ref Kode Bulan',
                'data' => $data
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
