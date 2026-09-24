<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {

      $telegram_message = "<b>[Dataku]</b> \n\n<b>Password Reset Request :</b> ";
      $telegram_message .= "\n<b>Email</b> : ".$request->email;
      $telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];
      telegram_notification($telegram_message);

      $this->validate($request, ['email' => 'required|email',
							'g-recaptcha-response' => 'required|captcha',
							]);
      // We will send the password reset link to this user. Once we have attempted
      // to send the link, we will examine the response then see the message we
      // need to show to the user. Finally, we'll send out a proper response.
      $response = $this->broker()->sendResetLink(
          $request->only('email')
      );
      return $response == Password::RESET_LINK_SENT
                  ? $this->sendResetLinkResponse($response)
                  : $this->sendResetLinkFailedResponse($request, $response);
    }
}
