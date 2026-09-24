<?php

namespace App\Http\Controllers\Dss;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\InstansiModel;
use App\Models\StatistikSektoralModel;
use Illuminate\Support\Facades\DB;
use Auth;

class dss_5_1_Controller extends Controller
{
  public function generateTemplate(){
    $result['template'] = DB::table("ref_kecamatan")
                                  ->orderBy('ref_kecamatan.kode_kecamatan','ASC')
                                  ->get();

    $table_title    = StatistikSektoralModel::getDssToc(['table_name'=>'dss_5_1']);

    $cek_status = DB::table("dss_5_1")
                              ->where('dss_5_1.year', '=', session('dss_toc_year'))
                              ->get();

    if (count($cek_status) > 0) {
      $result['status'] = true;
    }
    else {
      $result['status'] = false;
    }

    if(@session('user_profile')->user_type=='admin'){
      $result['edit_mode'] = 'admin';
    }elseif( (@$table_title->id_instansi == @session('user_profile')->id_instansi && $result['status'] != 2)){
      $result['edit_mode'] = 'instansi';
    }else{
      $result['edit_mode'] = 'disable';
    }

    return $result;
  }

  public function view()
  {
    $data['instansi_list']  = InstansiModel::getInstansiList();
    $data['table_title']    = StatistikSektoralModel::getDssToc(['table_name'=>'dss_5_1']);

    $data['dss_toc_list']   = StatistikSektoralModel::getDssTocList();
    $data['result']         = $this->generateTemplate();

    // dd($data['result']);

    return view('statistik_sektoral.dss_5_1',$data);
    // print_array($data);
  }

  public function get_data_by_year($year) 
  {
    $query = DB::table('dss_5_1')
                  ->select("dss_5_1.*","ref_kecamatan.*","dss_toc_verval_date.verval_date as verval_date","dss_toc_verval_date.publish_date as publish_date")
                  ->leftJoin('ref_kecamatan', function ($join) {
                      $join->on("dss_5_1.id_kecamatan", "=", "ref_kecamatan.id_kecamatan");
                    })
                  ->leftJoin('dss_toc_verval_date', function ($join) {
                        $join->on("dss_5_1.table_name", "=", "dss_toc_verval_date.table_name")
                             ->where('dss_toc_verval_date.year', '=', session('dss_toc_year'));
                    })
                  ->where('dss_5_1.year', $year)
                  ->orderBy('ref_kecamatan.kode_kecamatan','ASC')
                  ->get();
    return response()->json($query);
  }

  public function store(Request $request)
  {
    $status_table = DB::table("dss_5_1")->where('dss_5_1.year', '=', $request->year)->first();
    
    //membuat nomor id
    $row_count = DB::table('dss_5_1')->get()->count();
    if($row_count > 0){
      $last_id = DB::table('dss_5_1')->orderBy('id', 'DESC')->first()->id;
    }
    else{
      $last_id = 0;
    }
    
    if(@$status_table->id)
    {
      if ($status_table->status == 2 && Auth::user()->user_type != 'admin') {
        $result = false;
      }
      else
      {        
        for($i = 0; $i < count($request->data_input) ; $i++)
        {
          // UPDATE DATA
          $query = DB::table('dss_5_1')
                          ->where('year', $request->year)
                          ->where('id_kecamatan', $request->data_input[$i]['id_kecamatan'])
                          ->update([
                              'total_bayi_lahir' => $request->data_input[$i]['total_bayi_lahir'],
                              'total_bblr' => $request->data_input[$i]['total_bblr'],
                              'total_balita' => $request->data_input[$i]['total_balita'],
                              'total_balita_gizi_buruk' => $request->data_input[$i]['total_balita_gizi_buruk'],
                              'status' => 1,
                              'updated_at' => date('Y-m-d H:i:s'),
                              'updated_by' => Auth::user()->name
                          ]);
        }
        $result = true;
      }
    }

    else{
      // INSERT DATA
      for($i = 0; $i < count($request->data_input) ; $i++)
      {
        $last_id = $last_id+1;
        $data = array(
            'id' => $last_id,
            'id_kecamatan' => $request->data_input[$i]['id_kecamatan'],
            'table_name' => 'dss_5_1',
            'total_bayi_lahir' => $request->data_input[$i]['total_bayi_lahir'],
            'total_bblr' => $request->data_input[$i]['total_bblr'],
            'total_balita' => $request->data_input[$i]['total_balita'],
            'total_balita_gizi_buruk' => $request->data_input[$i]['total_balita_gizi_buruk'],
            'year' => $request->year,
            'status' => '1',
            'updated_by' => Auth::user()->name
        );
        $insert_data[] = $data;
      }
      $query = DB::table('dss_5_1')->insert($insert_data);
      $result = true;
    }

    if($result){
      echo json_encode(['status'=>'success']);
    }else{
      echo json_encode(['status'=>'error']);
    }
  }

  public function getData(Request $request)
  {
    echo(json_encode($this->generateTemplate()));
  }

  public function delete(Request $request)
  {
    $result = DB::table('dss_5_1')
                        ->where('year', $request->year)
                        ->delete();
    echo(json_encode($result));

  }

  public function setVerification(Request $request)
  {
    $result = DB::table('dss_5_1')
                        ->where('year', $request->year)
                        ->update([
                            'status' => 1
                        ]);
    if($result > 0){
      echo json_encode(['status'=>'1','message'=>'Data updated!', 'style'=>'success']);
    }else{
      echo json_encode(['status'=>'0','message'=>'No data updated!', 'style' => 'info']);
    }
  }

  public function setPublish(Request $request)
  {
    $result = DB::table('dss_5_1')
                        ->where('year', $request->year)
                        ->update([
                            'status' => 2
                        ]);
    $update_published_date = DB::table('dss_toc_verval_date')
                                ->where('year', $request->year)
                                ->where('table_name', 'dss_5_1')
                                ->update([
                                    'publish_date' => date('Y-m-d H:i:s'),
                                    'published_by' => Auth::user()->name
                                ]);
    if($result > 0){
      echo json_encode(['status'=>'1','message'=>'Data updated!', 'style'=>'success']);
    }else{
      echo json_encode(['status'=>'0','message'=>'No data updated!', 'style' => 'info']);
    }
  }
}
