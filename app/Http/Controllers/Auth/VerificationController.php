<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller {
  public function __construct() {
    $this->middleware('signed')->only('verify');
    $this->middleware('throttle:6,1')->only('resendVerificationEmail');
  }

  public function showVerification() {
    return view('auth/email/verify');
  }

  public function showVerified() {
    return view('auth/email/verified');
  }

  public function verify(EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/email/verified')->with('message', 'Your email address was successfully verified!');
  }

  public function resend(Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return redirect()->back()->with('message', 'Verification link sent!');
  }
}
