<?php

namespace App\Http\Controllers\Dss;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\InstansiModel;
use App\Models\StatistikSektoralModel;
use Illuminate\Support\Facades\DB;
use Auth;

class dss_5_2_Controller extends Controller
{
  public function generateTemplate(){
    $template['kecamatan'] = DB::table("ref_kecamatan")
                                  ->orderBy('ref_kecamatan.kode_kecamatan','ASC')
                                  ->get();

    $template['kelurahan'] = DB::table("ref_kelurahan")
                                  ->select("ref_kelurahan.*","ref_kecamatan.*")
                                  // ->leftJoin("ref_kecamatan","ref_kelurahan.id_kecamatan", "=", "ref_kecamatan.id_kecamatan")
                                  ->leftJoin('ref_kecamatan', function ($join) {
                                            $join->on("ref_kelurahan.id_kecamatan", "=", "ref_kecamatan.id_kecamatan");
                                        })
                                  ->orderBy('ref_kecamatan.kode_kecamatan','ASC')
                                  ->orderBy('ref_kelurahan.kode_kelurahan','ASC')
                                  ->get();

    $table_title    = StatistikSektoralModel::getDssToc(['table_name'=>'dss_5_2']);

    $cek_status = DB::table("dss_5_2")
                              ->where('dss_5_2.year', '=', session('dss_toc_year'))
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

    $result['template'] = $template;

    return $result;
  }

  public function view()
  {
    $data['instansi_list']  = InstansiModel::getInstansiList();
    $data['table_title']    = StatistikSektoralModel::getDssToc(['table_name'=>'dss_5_2']);

    $data['dss_toc_list']   = StatistikSektoralModel::getDssTocList();
    $data['result']         = $this->generateTemplate();

    return view('statistik_sektoral.dss_5_2',$data);
  }

  public function get_data_by_year($year) 
  {
    $query = DB::table('dss_5_2')
                  ->select("dss_5_2.*","ref_kelurahan.*","ref_kecamatan.*","dss_toc_verval_date.verval_date as verval_date","dss_toc_verval_date.publish_date as publish_date")
                  ->leftJoin('ref_kelurahan', function ($join) {
                      $join->on("dss_5_2.id_kelurahan", "=", "ref_kelurahan.id_kelurahan");
                    })
                  ->leftJoin('ref_kecamatan', function ($join) {
                      $join->on("ref_kelurahan.id_kecamatan", "=", "ref_kecamatan.id_kecamatan");
                    })
                  ->leftJoin('dss_toc_verval_date', function ($join) use ($year){
                          $join->on("dss_5_2.table_name", "=", "dss_toc_verval_date.table_name")
                               ->where('dss_toc_verval_date.year', '=', $year);
                      })
                  ->where('dss_5_2.year', $year)
                  ->orderBy('ref_kecamatan.kode_kecamatan','ASC')
                  ->orderBy('ref_kelurahan.kode_kelurahan','ASC')
                  ->get();
    return response()->json($query);
  }

  public function store(Request $request)
  {
    $status_table = DB::table("dss_5_2")->where('dss_5_2.year', '=', $request->year)->first();
    
    //membuat nomor id
    $row_count = DB::table('dss_5_2')->get()->count();
    if($row_count > 0){
      $last_id = DB::table('dss_5_2')->orderBy('id', 'DESC')->first()->id;
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
          $query = DB::table('dss_5_2')
                          ->where('year', $request->year)
                          ->where('id_kelurahan', $request->data_input[$i]['id_kelurahan'])
                          ->update([
                              'total_puskesmas'  => $request->data_input[$i]['total_puskesmas'],
                              'total_rs'  => $request->data_input[$i]['total_rs'],
                              'total_klinik'  => $request->data_input[$i]['total_klinik'],
                              'total_pustu'  => $request->data_input[$i]['total_pustu'],
                              'total_balai_pemerintah'  => $request->data_input[$i]['total_balai_pemerintah'],
                              'total_balai_swasta'  => $request->data_input[$i]['total_balai_swasta'],
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
            'id_kelurahan' => $request->data_input[$i]['id_kelurahan'],
            'table_name' => 'dss_5_2',
            'total_puskesmas' => $request->data_input[$i]['total_puskesmas'],
            'total_rs' => $request->data_input[$i]['total_rs'],
            'total_klinik' => $request->data_input[$i]['total_klinik'],
            'total_pustu' => $request->data_input[$i]['total_pustu'],
            'total_balai_pemerintah'  => $request->data_input[$i]['total_balai_pemerintah'],
            'total_balai_swasta'  => $request->data_input[$i]['total_balai_swasta'],
            'year' => $request->year,
            'status' => '1',
            'updated_by' => Auth::user()->name
        );
        $insert_data[] = $data;
      }
      $query = DB::table('dss_5_2')->insert($insert_data);
      $result = true;
    }

    if($result){
      echo json_encode(['status'=>'success']);
    }else{
      echo json_encode(['status'=>'error']);
    }
  }

  public function delete(Request $request)
  {
    $result = DB::table('dss_5_2')
                        ->where('year', $request->year)
                        ->delete();
    echo(json_encode($result));

  }

  public function setVerification(Request $request)
  {
    $result = DB::table('dss_5_2')
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
    $result = DB::table('dss_5_2')
                        ->where('year', $request->year)
                        ->update([
                            'status' => 2
                        ]);
    $update_published_date = DB::table('dss_toc_verval_date')
                                ->where('year', $request->year)
                                ->where('table_name', 'dss_5_2')
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
