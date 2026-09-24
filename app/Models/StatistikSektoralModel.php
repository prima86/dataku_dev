<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StatistikSektoralModel extends Model
{
  public $timestamps = false;

  public static function getDssTocList(){
    if (empty(session('dss_toc_year'))) {
      $bulan = date('m');

      if ($bulan >= 1 && $bulan <= 6) {
          // Antara bulan Januari sampai Juni
          $year = date('Y')-1;
      }
      else {
          // Antara bulan Juli sampai Desember
          $year = date('Y').'_1';
      }
      session(['dss_toc_year' => $year]);
    }

    $dss_toc_list = DB::table("dss_toc")
                        // ->select("dss_toc.*","instansi.alias as instansi_alias","dss_2_1.status")
                        ->select("dss_toc.*","dss_toc_status.*","instansi.alias as instansi_alias")
                        ->leftJoin("instansi","dss_toc.id_instansi", "=", "instansi.id")
                        // ->leftJoin("dss_toc_status","dss_toc.table_name", "=", "dss_toc_status.table_name")
                        ->leftJoin('dss_toc_status', function ($join) {
                                  $join->on("dss_toc.table_name", "=", "dss_toc_status.table_name")
                                       ->where('dss_toc_status.year', '=', session('dss_toc_year'));
                                       // ->where("dss_2_1.year", "=", "2018_1");
                              })
                        // ->leftJoin("dss_2_1","dss_toc.table_name", "=", "dss_2_1.table_name")
                        /*->leftJoin('dss_2_1', function ($join) {
                                  $join->on("dss_toc.table_name", "=", "dss_2_1.table_name")
                                       ->where('dss_2_1.year', '=', session('dss_toc_year'));
                                       // ->where("dss_2_1.year", "=", "2018_1");
                              })*/
                        ->where('availability',1)
                        ->where('starting_year', '<=', session('dss_toc_year'))
                        // ->orderBy("dss_toc.bab", "asc")
                        ->orderBy("dss_toc.id", "asc")
                        ->orderBy("dss_toc.table_name", "asc");
    
    $dss_toc_list = $dss_toc_list->distinct()->get();

    $bab          =  '';
    foreach ($dss_toc_list as $key => $value) {
      if($value->bab != $bab){
        $bab = $value->bab;
      }
      foreach ($value as $child_key => $child_value) {
        $new_dss_toc_list[$bab][$value->id][$child_key]=$child_value;
      }
    }

    $new_dss_toc_list['BAB I (Gambaran Umum Daerah)'][1]['status'] = 2;

		return $new_dss_toc_list;
  }

  public static function getDssToc($array){
    $dss_toc = DB::table("dss_toc")
                        ->select("dss_toc.*","instansi.alias as instansi_alias","instansi.instansi as instansi_name")
                        ->leftJoin("instansi","dss_toc.id_instansi", "=", "instansi.id")
                        ->where($array)
                        ->where('availability',1)
                        ->first();
    return $dss_toc;
  }

  public static function getmonth(){
    $list_month = DB::table("month")
                        ->orderBy("id", "asc")
                        ->get();
    return $list_month;
  }
}
