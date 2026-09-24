<?php

namespace App\Http\Controllers\Dss;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\InstansiModel;
use App\Models\StatistikSektoralModel;
use Illuminate\Support\Facades\DB;
use Auth;

class Set_dss_verval_date_Controller extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }

  public function index()
  {
    if(Auth::user()) {
      if (Auth::user()->user_type === 'admin') {
        $data['instansi_list']  = InstansiModel::getInstansiList();
        $data['dss_toc_list']   = StatistikSektoralModel::getDssTocList();

        $data['dss_toc'] = DB::table('dss_toc')
                                ->select("dss_toc.*","instansi.instansi as instansi")
                                      ->leftJoin('instansi', function ($join) {
                                            $join->on("dss_toc.id_instansi", "=", "instansi.id");
                                        })
                                ->where('availability', 1)
                                ->get();

        // Set verval_year
        $bulan = date('m');

        if ($bulan >= 1 && $bulan <= 6) {
            // Verval antara bulan Januari sampai Juni -> untuk data pada tahun sebelumnya
            $verval_year = date('Y')-1;
            $txt_verval_year = 'Tahun '.$verval_year;
        }
        else if ($bulan >= 7 && $bulan <= 12) {
            // Verval antara bulan Juli sampai Desember -> Verval utk semester 1 pada tahun tersebut
            $verval_year = date('Y').'_1';
            $txt_verval_year = 'Tahun '.date('Y').' Semester 1';
        }
        else {
        }
        $data['verval_year'] = $verval_year;
        $data['txt_verval_year'] = $txt_verval_year;
        $data['list_instansi_sudah_verval'] = $this->list_instansi_sudah_verval();
        $ada_band = $this->list_instansi_sudah_verval();

        // dd($data['list_instansi_sudah_verval']);
        // dd($data['instansi_list']);

        return view('statistik_sektoral.set_dss_verval_date', $data);
      }
      else {
        return view('statistik_sektoral.dss');
      }
    }
  }

  public function get_list_tabel(Request $request)
  {
    $year = $request->year;
    $id_instansi = $request->id_instansi;
    $data = DB::table('dss_toc')
                  ->select("dss_toc.*","instansi.instansi as instansi","dss_toc_verval_date.verval_date")
                        ->leftJoin('instansi', function ($join) {
                              $join->on("dss_toc.id_instansi", "=", "instansi.id");
                          })
                        ->leftJoin('dss_toc_verval_date', function ($join) use ($year){
                                      $join->on("dss_toc.table_name", "=", "dss_toc_verval_date.table_name")
                                           ->where('dss_toc_verval_date.year', '=', $year);
                                  })
                  ->where('dss_toc.availability', 1)
                  ->where('dss_toc.id_instansi', $id_instansi)
                  ->orderBy('table_name', 'ASC')
                  ->get();

    return response()->json($data);
  }

  public function get_dss_toc_detail($table_name)
  {
    $data = DB::table('dss_toc')
                    ->select("dss_toc.*","instansi.instansi as instansi")
                        ->leftJoin('instansi', function ($join) {
                              $join->on("dss_toc.id_instansi", "=", "instansi.id");
                          })
                    ->where('table_name', $table_name)
                    ->get();

    return response()->json($data);
  }

  public function simpan(Request $request)
  {
    $table_name = $request->nama_tabel;
    $verval_date = $request->verval_date;
    $year = $request->year;
    $user = Auth::user()->name;

    if ($verval_date !== NULL) {
      $result = DB::table('dss_toc_verval_date')
                    ->where('table_name', $table_name)
                    ->where('year', $year)
                    ->delete();
      
      $result = DB::table('dss_toc_verval_date')->insert([
                      'table_name' => $table_name,
                      'year' => $year,
                      'verval_date' => $verval_date,
                      'verval_by' => $user,
                      'publish_date' => NULL,
                      'published_by' => NULL
                  ]);
    }
    else {
        
    }
    
    return response()->json($result);
  }

  public function list_instansi_sudah_verval()
  {
    // $year = $request->year;

    $year = session('dss_toc_year');
    $year = (string)$year;


    $data = InstansiModel::getInstansiList();

    foreach ($data as $key => $value) {
        $get_dss_tables_count = DB::table('dss_toc')
                                        ->where('id_instansi', $value->id)
                                        ->where('availability', 1)
                                        ->get()
                                        ->count();

        // $get_dss_users_count = DB::table('users')
        //                                 ->where('id_instansi', $value->id)
        //                                 ->get()
        //                                 ->count();

        $get_dss_verval_count = DB::table('dss_toc')
                                        ->select("dss_toc.*","dss_toc_verval_date.year as year","dss_toc_verval_date.verval_date as verval_date","dss_toc_verval_date.publish_date as publish_date")
                                        ->leftJoin('dss_toc_verval_date', function ($join) use ($year){
                                                  $join->on("dss_toc.table_name", "=", "dss_toc_verval_date.table_name")
                                                       ->where('dss_toc_verval_date.year', '=', $year);
                                              })

                                        ->where('dss_toc_verval_date.year', "=", $year)
                                        ->where('dss_toc.id_instansi', $value->id)
                                        ->where('dss_toc.availability', 1)
                                        ->orderBy('dss_toc.id', 'ASC')
                                        ->get()
                                        ->count();

        $data[$key]->jumlah_tabel = $get_dss_tables_count;
        // $data['instansi_list'][$key]->jumlah_user = $get_dss_users_count;
        $data[$key]->jumlah_verval = $get_dss_verval_count;
    }

    return $data;
    // dd($data);
    // return view('instansi.index', $data);
  }
}
