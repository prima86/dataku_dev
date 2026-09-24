<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'username','name', 'email', 'password','user_type','avatar','last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function updateLastLogin()
    {
      $user = User::find(Auth::user()->id);
      $user->last_login = date("Y-m-d H:i:s");
      $user->save();
    }


    public static function setSessionUserProfile()
  	{
  		$user = DB::table('users')
  						->select('users.*','instansi.instansi','instansi.alias')
              ->leftJoin('instansi','users.id_instansi', '=', 'instansi.id')
  						->where('users.id', '=', Auth::user()->id)
  						->first();
      // $privilege['dss']  = DB::table('dss_toc')
      // $privilege        = new \stdClass();
      $privilege  = array();
      $data   = DB::table('dss_toc')
                						->select('dss_toc.url')
                            ->where('dss_toc.id_instansi', '=', Auth::user()->id_instansi)
                						->get();

      foreach ($data as $key => $value) {
        if($value->url){
          $privilege[] = $value->url;
        }
      }
      $user->privilege    = $privilege;
  		@session(['user_profile' => $user]);
  	}

    public static function getSessionUserProfile()
    {
      if (!empty(Session('user_profile'))){
        $user_profile = Session('user_profile');
      }else{
        User::setSessionUserProfile();
        $user_profile = Session('user_profile');
      }
      return $user_profile;
    }

    public static function getUserList()
  	{
  		$user_list = DB::table('users')
        						->select('users.*','instansi.instansi','instansi.alias')
                    ->leftJoin('instansi','users.id_instansi', '=', 'instansi.id')
                  ->get();
  		return $user_list;
  	}
}
