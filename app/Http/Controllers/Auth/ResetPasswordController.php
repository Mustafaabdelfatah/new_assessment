<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
// use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('dashboard.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectPath())
                            ->with('status', trans($response));
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }
    public function reset(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);
        return redirect('/')->with('status', 'Your password has been reset!');

        // $request->validate($this->rules(), $this->validationErrorMessages());

        // // Here, we will attempt to reset the user's password. If it is successful we
        // // will update the password on an actual user model and persist it to the
        // // database. Otherwise we will parse the error and return the response.
        // $response = $this->broker()->reset(
        //     $this->credentials($request), function ($user, $password) {
        //         $this->resetPassword($user, $password);
        //     }
        // );

        // // If the password was successfully reset, we will redirect the user back to
        // // the application's home authenticated view. If there is an error we can
        // // redirect them back to where they came from with their error message.
        // return $response == Password::PASSWORD_RESET
        //             ? $this->sendResetResponse($request, $response)
        //             : $this->sendResetFailedResponse($request, $response);
    }
}
