<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuth extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }
    public function dologin(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $attempt = auth()->attempt($credentials);
        if ($attempt) {
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->withInput();
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        return redirect('/login');
    }
    public function change_password(Request $request){
        $user = auth()->user();
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                },
            ],
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ]);
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        if (isset($user)) {
         return response()->json(['success' => true, 'message' => 'Password updated successfully']);
         } else {
             return response()->json(['errors' => 'Failed to update Password']);
         }
     }
}
