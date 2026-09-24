<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataStrategisModel extends Model
{
  public $timestamps = false;

  public static function getDstrategisToc($array){
    $dstrategis_toc = DB::table("dstrategis_toc")
                        ->select("dstrategis_toc.*","instansi.alias as instansi_alias","instansi.instansi as instansi_name")
                        ->leftJoin("instansi","dstrategis_toc.id_instansi", "=", "instansi.id")
                        ->where($array)
                        ->where('availability',1)
                        ->first();
    return $dstrategis_toc;
  }

  public static function getmonth(){
    $list_month = DB::table("month")
                        ->orderBy("id", "asc")
                        ->get();
    return $list_month;
  }
}
