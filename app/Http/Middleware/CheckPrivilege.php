<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\DB;

class CheckPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Auth::check()) {
        if ($request->is('dss/*')) {
          $table_name         =str_replace("dss/","",$request->route()->getPrefix());
          $data               = DB::table($table_name)
                                    ->select("*")
                                    ->where($table_name.'.year', '=', session('dss_toc_year'))
                                    ->first();
          if ((@in_array($request->route()->getPrefix(),session('user_profile')->privilege) && @$data->status != '2') || @session('user_profile')->user_type=='admin'){
            if (strpos($request->url(), $request->route()->getPrefix().'/store') !== false) {
              DB::insert("REPLACE INTO `dss_toc_status` SET table_name = '".$table_name."',`status`='1', `year` = '".$request->year."'");
            }elseif(strpos($request->url(), $request->route()->getPrefix().'/set_publish') !== false) {
              DB::insert("REPLACE INTO `dss_toc_status` SET table_name = '".$table_name."',`status`='2', `year` = '".$request->year."'");
            }elseif(strpos($request->url(), $request->route()->getPrefix().'/set_verification') !== false) {
              DB::insert("REPLACE INTO `dss_toc_status` SET table_name = '".$table_name."',`status`='1', `year` = '".$request->year."'");
            }elseif(strpos($request->url(), $request->route()->getPrefix().'/delete') !== false) {
              DB::table('dss_toc_status')->where('year', $request->year)->where('table_name', $table_name)->delete();
            }
          }else{
            abort(403);
          }
        }elseif($request->is('user/*')) {
          if (@session('user_profile')->user_type != 'admin'){
            abort(403);
          }
        }

        $telegram_message = "<b>[DataKu]</b>";
        $telegram_message .= "\n\n<b>Action</b> : \n".url()->current();

        if(Session('user_profile')->username){
          $telegram_message .= "\n\n<b>User Profile</b> : ";
          $telegram_message .= "\n<b>Username</b> : ".Session('user_profile')->username;
          $telegram_message .= "\n<b>Name</b> : ".Session('user_profile')->name;
          $telegram_message .= "\n<b>Instansi</b> : ".Session('user_profile')->instansi;
          $telegram_message .= "\n<b>Email</b> : ".Session('user_profile')->email;
        }

        $telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];
        telegram_notification($telegram_message);

        return $next($request);
      }else{
        return abort(403);
      }

    }
}
