<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
  public function showLoginForm() {
    return view('auth/login');
  }

  public function login(Request $request) {
    $request->validate([
      'username' => 'required|string',
      'password' => 'required|string',
    ]);
  
    $credentials = $request->only('username', 'password');
    $remember = $request->remember;
  
    if (Auth::attempt($credentials, $remember)) {
      return redirect()->intended('admin');
    }
  
    return redirect('login')->with('message', 'Ops! You have entered invalid credentials!');
  }

  public function logout() {
    Auth::logout();
    return redirect('/');
  }
}
