<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionModel extends Model
{
  public $timestamps = false;

  public static function getCountryList() {
    $country_list = DB::table('ref_country')
                        ->select("ref_country.*");
    $country_list = $country_list->get();
    return $country_list;
  }

	public static function getProvinsiList() {
    $provinsi_list = DB::table('ref_provinsi')
                        ->select("ref_provinsi.*");
    $provinsi_list = $provinsi_list->get();
		return $provinsi_list;
	}

	public static function getKotaList($id_provinsi) {
    $kota_list = DB::table('ref_kota')
                        ->select("ref_kota.*")
                        ->where('ref_kota.id_provinsi', '=', $id_provinsi);
    $kota_list = $kota_list->get();
		return $kota_list;
	}

  public static function getKecamatanList(){
    $kecamatan_list = DB::table('ref_kecamatan')
                          ->select('ref_kecamatan.*');
    $kecamatan_list = $kecamatan_list->get();
    return $kecamatan_list;
  }

  public static function getKelurahanList($id_kecamatan) {
    $kelurahan_list = DB::table('ref_kelurahan')
                        ->select("ref_kelurahan.*");
    if ($id_kecamatan) {
      $kelurahan_list = $kelurahan_list->where('ref_kelurahan.id_kecamatan', '=', $id_kecamatan);
    }
    $kelurahan_list = $kelurahan_list->get();
		return $kelurahan_list;
	}

}
