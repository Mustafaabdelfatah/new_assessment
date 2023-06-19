<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    // use SendsPasswordResetEmails;

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
    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        $token = Password::createToken($user);
        $user->sendPasswordResetNotification($token);

        return back()->with('status', 'We have emailed your password reset link Check Your Email!');
    }

    public function showLinkRequestForm()
    {
        return view('dashboard.auth.passwords.email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return back()->with('status', trans($response));

     }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        if ($response === Password::INVALID_USER) {
            return back()->withErrors([
                'email' => 'The email address entered does not exist.'
            ]);
        }

        // dd($response);
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }
}
