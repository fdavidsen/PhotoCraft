<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class RegisterController extends Controller {
  public function showVerifyRegistrationForm() {
    return view('auth/verify-register');
  }

  public function showRegistrationForm(Request $request) {
    if ($request->session()->has('verified_registration')) {
      return view('auth/register');
    }

    return redirect('/register');
  }

  public function verifyRegistration(Request $request) {
    $request->validate([
      'password' => 'required|string'
    ]);

    $password = DB::table('settings')->first()->registration_password;

    if ($request->password === $password) {
      $request->session()->put('verified_registration', true);
      return redirect('/register/verified');
    }

    return redirect()->back()->with('message', 'Incorrect password!');
  }

  public function register(Request $request) {
    if (! $request->session()->has('verified_registration')) abort(403);
    
    $request->validate([
      'username' => 'required|string|max:255|unique:users',
      'email'    => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed'
    ]);
    
    $user = User::create([
      'username' => $request->username,
      'email'    => $request->email,
      'password' => Hash::make($request->password),
    ]);
    
    Auth::login($user);
    event(new Registered($user));
    
    $request->session()->forget('verified_registration');
    
    return redirect()->route('verification.notice')->with('message', 'Account successfully created! We have sent an email with a verification link to your email address. If you do not receive a confirmation email, please check your spam folder.');
  }
}
