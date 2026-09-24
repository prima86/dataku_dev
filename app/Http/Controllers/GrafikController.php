<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Schema;

class GrafikController extends Controller
{
  public function get_list_tahun($dss_url){

    $start_year = DB::table("dss_toc")
                        ->where('table_name', '=', $dss_url)
                        ->get()
                        ->first()
                        ->starting_year;


    // Membuat array semua tahun (tahun awal = $start_year, tahun akhir = tahun saat ini )
    $tahun_now = (int)date('Y');
    $tahuns = [];
    for ($y=$start_year; $y < $tahun_now ; $y++) { 
        $tahuns[] = strval($y);
    }

    return $tahuns;
  }

  public function get_data($dss_url) 
  {
    $data['tahuns'] = $this->get_list_tahun($dss_url);

    // Mengambil judul kolom (fields)
    $data['table_info'] = DB::table('dss_toc')
                                ->select("dss_toc.table_name","dss_toc.name","dss_toc.bab","instansi.instansi","dss_grafik.title")
                                ->leftJoin('dss_grafik', function ($join) {
                                    $join->on("dss_toc.table_name", "=", "dss_grafik.table_name");
                                  })
                                ->leftJoin('instansi', function ($join) {
                                    $join->on("dss_toc.id_instansi", "=", "instansi.id");
                                  })
                                ->where('dss_toc.table_name', $dss_url)
                                ->get();
    $data['fields'] = [];
    $get_fields = Schema::getColumnListing($dss_url);
    foreach ($get_fields as $key => $value) {
      if (str_contains($value, 'total')) { 
          $data['fields'][] = $value;
      }
    }

    // $data['get_query'] = DB::table($dss_url)
    //                           ->get();

    $data['result'] = [];
    foreach ($data['fields'] as $key => $value) {
      $data['result'][$key]['name'] = $value;
      $data['result'][$key]['data'] = array();

      
      // Custom untuk tabel dss_11_17 dan dss_11_18
      if ($dss_url == "dss_11_17" OR $dss_url == "dss_11_18") {
        foreach ($data['tahuns'] as $i => $tahun) {
          $get_query_by_year = DB::table($dss_url)
                                    ->select($dss_url.".*", $dss_url."_template.id_parent", $dss_url."_template.data","dss_toc_verval_date.verval_date as verval_date","dss_toc_verval_date.publish_date as publish_date")
                                    ->leftJoin('dss_toc_verval_date', function ($join) use($dss_url) {
                                              $join->on($dss_url.".table_name", "=", "dss_toc_verval_date.table_name")
                                                   ->where('dss_toc_verval_date.year', '=', session('dss_toc_year'));
                                          })
                                    ->leftJoin($dss_url."_template", function ($join) use($dss_url) {
                                              $join->on($dss_url.".id_template", "=", $dss_url."_template.id");
                                          })
                                    ->where($dss_url.'.year', '=', $tahun)
                                    ->get();

          // $data['result'][$key]['q'][$i] = $get_query_by_year;

          $jml_penerimaan = 0;
          $jml_pengeluaran = 0;
          foreach ($get_query_by_year as $j => $row) {

            // Jika id_parent == 1 (penerimaan) 
            if ($row->id_parent == 1 ) {
              $jml_penerimaan += $row->$value;
            }
            elseif ($row->id_parent == 8 ) {
              $jml_pengeluaran += $row->$value;
            }

            $jml = $jml_penerimaan - $jml_pengeluaran;          
          }
          array_push($data['result'][$key]['data'], $jml);
        }
      }

      // Default untuk semua table
      else {
        foreach ($data['tahuns'] as $i => $tahun) {
          $get_query_by_year = DB::table($dss_url)
                                    ->where('year', '=', $tahun)
                                    ->get();

          // $data['result'][$key]['q'][$i] = $get_query_by_year;

          $jml = 0;
          foreach ($get_query_by_year as $j => $query) {
            $jml += $query->$value;
          }
          array_push($data['result'][$key]['data'], $jml);
        }
      }
  
    }

    return response()->json($data);
  }

  public function get_list($id_category) 
  {
    $result = DB::table('dss_grafik')
                      ->where('id_category', $id_category)
                      ->get();

    return response()->json($result);
  }

}
