<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller {
  public function showLinkRequestForm() {
    return view('auth/password/forgot');
  }

  public function sendResetLinkEmail(Request $request) {
    $request->validate([
      'email' => 'required|email'
    ]);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
      ? redirect()->back()->with(['message' => __($status)])
      : redirect()->back()->withErrors(['email' => __($status)]);
  }
}
