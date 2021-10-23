<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Core;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller {
  public function __construct() {
    $this->Home  = new Home();
    $this->Core  = new Core();
    $this->Photo = new Photo();
  }

  public function index(Request $request) {
    $ip_address = $request->ip();
    $this->Home->Visitor($ip_address);

    return view('home/app', [
      'admin'     => $this->Home->getAdminData(),
      'carousel'  => $this->Photo->getPhotos('carousel'),
      'portfolio' => $this->Photo->getPhotos('portfolio')
    ]);
  }

  public function sendMessage(Request $request) {
    $validated = $request->validate([
      'name'    => 'required|string',
      'email'   => 'required|email',
      'message' => 'required|string|max:1000'
    ]);

    $notify = array(
      'status' => false,
      'data'   => []
    );

    if ($this->Home->sendMessage($validated)) {
      if ($this->Core->getSetting()->email_notification == 1) {
        $notify = array(
          'status' => true,
          'data'   => $validated
        );
      }
      $message = 'Thank you! Your message has been sent.';
    } else {
      $message = 'It seems that my mail server is not responding. Please try again later.';
    }
    
    return response()->json([
      'message' => $message,
      'notify'  => $notify
    ]);
  }

  public function notifyAdmin(Request $request) {
    $validated = $request->validate([
      'name'    => 'required|string',
      'email'   => 'required|email',
      'message' => 'required|string|max:1000'
    ]);
    
    $users = User::all();
    $admin = $this->Home->getAdminData();
    $name  = $admin->first_name . ' ' . $admin->last_name;

    foreach ($users as $user) {
      Notification::send($user, new MessageSent($name, $validated));
    }
  }
}
