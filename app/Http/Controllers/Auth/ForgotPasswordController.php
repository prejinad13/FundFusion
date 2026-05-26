<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    use SendsPasswordResetEmails;

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user=User::where('email',$request->email)->first();
        if(!$user){
            return back()->with('error','Email Not Registered');
        }
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        // return $response == Password::RESET_LINK_SENT
        //             ? $this->sendResetLinkResponse($request, $response)
        //             : $this->sendResetLinkFailedResponse($request, $response);

        Session::flash('swal_success','Password Reset Link Sent!');
        return redirect()->route('index');
    }
}
