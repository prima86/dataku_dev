<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
// use ThrottlesLogins ;

use App\User;
use Auth;
use Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
  	{
  		return 'username';
  	}

    public function login(Request $request)
    {
        $field = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->username]);

        $this->validate($request, ['g-recaptcha-response' => 'required|captcha']);
        
        if (auth()->attempt($request->only($field, 'password')) )
        {
          Auth::user()->setSessionUserProfile();
          User::updateLastLogin();
          Cookie::queue(Cookie::forever('night_mode', '1'));
          // Cookie::queue(Cookie::forever('night_mode', @session('user_profile')->night_mode));

          // $telegram_message = "<b>[DataKu]</b> \n\n<b>User Logged In :</b> ";
          // if(Session('user_profile')->username){
      		// 	$telegram_message .= "\n<b>Username</b> : ".Session('user_profile')->username;
      		// 	$telegram_message .= "\n<b>Name</b> : ".Session('user_profile')->name;
      		// 	$telegram_message .= "\n<b>User Type</b> : ".Session('user_profile')->user_type;
      		// 	$telegram_message .= "\n<b>Instansi</b> : ".Session('user_profile')->instansi;
      		// 	$telegram_message .= "\n<b>Email</b> : ".Session('user_profile')->email;
      		// }
          // $telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];
          // telegram_notification($telegram_message,'force');

          return redirect('/');
        }else {
          // $telegram_message = "<b>[DataKu]</b> \n\n<b>Login Failed</b> ";
          // $telegram_message .= "\n<b>Username</b> : ".$request->username;
          // $telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];

          // telegram_notification($telegram_message,'force');

          return redirect('login')->withErrors([
            'username' => 'These credentials do not match our records.',
          ]);
        }

    }

    public function showLoginForm()
  	{
  		$data['user'] ='';
  		if(!empty(Cookie::get('user_token'))){
  			// $data['user'] = User::find(array('remember_token' => Cookie::get('user_token')));
  			// $data['user'] = User::where('remember_token',Cookie::get('user_token')) -> first();
  			$data['user'] = User::select('username','name','avatar')
                              ->where('remember_token',Cookie::get('user_token'))
                              ->first();

  		}
  		return view('auth.login',$data);
  	}

    public function logout(Request $request)
    {
  		$user_id = Auth::user()->id;
      $this->guard()->logout();

      $request->session()->flush();

      $request->session()->regenerate();

  		$token = User::find($user_id );
  		// $response = new Response;
  		// $response->withCookie(cookie()->forever('user_token', $token->remember_token));
  		// Cookie::queue('user_token', $token->remember_token,2628000);
  		// Cookie::forever('user_token', $token->remember_token);
  		Cookie::queue(Cookie::forever('user_token', $token->remember_token));
      return redirect('/');
    }

}
