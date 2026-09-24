<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstansiModel extends Model
{
  public $timestamps = false;

  public static function getInstansiList(){
    $instansi_list = DB::table('instansi')
                        ->select("instansi.*","opd.jenis_opd as id_jenis_opd",
                            DB::raw("ifnull(opd_jenis.jenis, 'Instansi vertikal / institusi pendidikan')
                                                as jenis_opd")
                        )
                        ->leftJoin('opd', function ($join) {
                                      $join->on("instansi.id", "=", "opd.id_instansi");
                                    })
                        ->leftJoin('opd_jenis', function ($join) {
                                      $join->on("opd.jenis_opd", "=", "opd_jenis.id");
                                    })
                        ->where('status_instansi_active', 1)
                        // ->where('instansi', 'not like', "%kecamatan%")
                        ->where('instansi', 'not like', "%kelurahan%")                        
                        ->orderBy('id_jenis_opd', 'ASC');

    $instansi_list = $instansi_list->get();
		return $instansi_list;
  }

}
