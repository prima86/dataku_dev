<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstansiModel;
use App\Models\StatistikSektoralModel;
use App\Models\RegionModel;
use Illuminate\Support\Facades\DB;
use Auth;

class StatistikSektoralController extends Controller
{
  public function index()
  {
    $data['instansi_list']  = InstansiModel::getInstansiList();
    // dd($data['instansi_list']);
    $data['dss_toc_list']   = StatistikSektoralModel::getDssTocList();
    $data['nama_instansi_user'] = "";

    return view('statistik_sektoral.index', $data);
  }

  public function setDssGlobalYear(Request $request)
  {
    session(['dss_toc_year' => $request->year]);
    $data['dss_toc_list']   = StatistikSektoralModel::getDssTocList();
    echo json_encode(['data'=>   $data['dss_toc_list']] );
  }

  public function grafiks()
  {
    return view('statistik_sektoral.grafiks');
  }
}
