<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/dss/kode_tabel",
     * tags={"Kode tabel"},
     * summary="( API Get Kode Tabel )",
     * description="Kode Tabel Statistik Sektoral",
     * operationId="get_kode_tabel",
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  )
     * )
    */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    

    public function store(Request $request)
    {
        //
    }


    /**
     * @OA\Get(
     * path="/api/dss/{kode_tabel}",
     * tags={"Tabel data"},
     * summary="( API Get Data, [parameter : kode_tabel] )",
     * description="Request data by kode_tabel",
     * operationId="get_data_param",
     * @OA\Parameter(
     *      name="kode_tabel",
     *      in="path",
     *      required=true,
     *      description="masukkan kode tabel"
     *  ),
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    /**
     * @OA\Get(
     * path="/api/dss/{kode_tabel}/{tahun}",
     * tags={"Tabel data"},
     * summary="( API Get Data, [parameter : kode_tabel, tahun_data] )",
     * description="Request data by kode tabel, tahun data",
     * operationId="get_data_param_kode_tahun",
     * @OA\Parameter(
     *      name="kode_tabel",
     *      in="path",
     *      required=true,
     *      description="masukkan kode tabel"
     *  ),
     * @OA\Parameter(
     *      name="tahun",
     *      in="path",
     *      required=true,
     *      description="masukkan tahun data"
     *  ),
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function get_data_by_year($id)
    {
        //
    }


    /**
     * @OA\Get(
     * path="/api/kode_kelurahan",
     * tags={"Tabel kode referensi"},
     * summary="(API Get Kode Kelurahan)",
     * description="Kode Kelurahan",
     * operationId="get_kode_kelurahan",
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function get_kode_kelurahan()
    {
        //
    }
    
    /**
     * @OA\Get(
     * path="/api/kode_kecamatan",
     * tags={"Tabel kode referensi"},
     * summary="(API Get Kode Kecamatan)",
     * description="Kode Kecamatan",
     * operationId="get_kode_kecamatan",
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function get_kode_kecamatan()
    {
        //
    }
    
    /**
     * @OA\Get(
     * path="/api/kode_opd",
     * tags={"Tabel kode referensi"},
     * summary="(API Get Kode OPD)",
     * description="Kode OPD",
     * operationId="get_kode_opd",
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function get_kode_opd()
    {
        //
    }
    
    /**
     * @OA\Get(
     * path="/api/kode_golongan_asn",
     * tags={"Tabel kode referensi"},
     * summary="(API Get Kode Golongan ASN)",
     * description="Kode Golongan ASN",
     * operationId="get_kode_golongan_asn",
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function get_kode_golongan_asn()
    {
        //
    }
    
    /**
     * @OA\Get(
     * path="/api/kode_agama",
     * tags={"Tabel kode referensi"},
     * summary="(API Get Kode Agama)",
     * description="Kode Agama",
     * operationId="get_kode_agama",
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function get_kode_agama()
    {
        //
    }
    
    /**
     * @OA\Get(
     * path="/api/kode_bulan",
     * tags={"Tabel kode referensi"},
     * summary="(API Get Kode Bulan)",
     * description="Kode Bulan",
     * operationId="get_kode_bulan",
     * @OA\Response(
     *      response="200",
     *      description="Data ditemukan"
     *  ),
     * @OA\Response(
     *      response="404",
     *      description="Data tidak ditemukan"
     *  )
     * )
    */
    public function get_kode_bulan()
    {
        //
    }
}
