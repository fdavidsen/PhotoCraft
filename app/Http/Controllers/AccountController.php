<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {
  public function __construct() {
    $this->Account = new Account();
  }

  public function showChangeUsernameForm() {
    return view('admin/change-username');
  }

  public function showChangePasswordForm() {
    return view('admin/change-password');
  }

  public function changeUsername(Request $request) {
    $request->validate([
      'username' => 'required|string|max:255|unique:users'
    ]);
    
    $new_username = $request->username;
    $message = $this->Account->updateUsername(Auth::id(), $new_username) ? 'Your username has been changed!' : 'Nothing was updated!';

    return redirect()->back()->with('message', $message);
  }

  public function changePassword(Request $request) {
    $request->validate([
      'old_password' => 'required|string|min:8',
      'new_password' => 'required|string|min:8|confirmed',
      'new_password_confirmation' => 'required'
    ]);

    $old_password = $request->old_password;
    $new_password = Hash::make($request->new_password);

    if (Hash::check($old_password, Auth::user()->password)) {
      $message = $this->Account->updatePassword(Auth::id(), $new_password) ? 'Your password has been changed!' : 'Nothing was updated!';
    } else {
      $message = 'Incorrect old password!';
    }

    return redirect()->back()->with('message', $message);
  }
}
