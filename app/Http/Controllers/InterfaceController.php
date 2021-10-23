<?php

namespace App\Http\Controllers;

use App\Models\InterfaceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InterfaceController extends Controller {
  public function __construct() {
    $this->Interface = new InterfaceModel();
  }

  public function showAboutMe() {
    return view('admin/about-me', [
      'admin' => $this->Interface->getAdminData()
    ]);
  }

  public function showMyContact() {
    return view('admin/my-contact', [
      'admin' => $this->Interface->getAdminData()
    ]);
  }

  public function updateAboutMe(Request $request) {
    $old_photo = $request->old_photo;

    $request->validate([
      'photo'      => 'nullable|image',
      'first_name' => 'required|string',
      'last_name'  => 'nullable|string',
      'bio'        => 'nullable|string|max:1000'
    ]);

    $data = array(
      'first_name' => $request->first_name,
      'last_name'  => $request->last_name,
      'bio'        => $request->bio,
      'skills'     => $request->skill
    );

    if ($request->photo <> '') {
      $file = $request->photo;
      $filename = uniqid() . '.' . $file->extension();
      $file->move(public_path('img/'), $filename);

      $data['photo'] = $filename;
      unlink(public_path('img/' . $old_photo));
    }

    $message = $this->Interface->updateAdminData($data) ? 'Your profile has been updated!' : 'Nothing was updated!';
    Session::flash('message', $message);

    return redirect()->back();
  }

  public function updateMyContact(Request $request) {
    $validated = $request->validate([
      'greetings' => 'nullable|string|max:1000',
      'email'     => 'nullable|email',
      'phone'     => 'nullable|numeric',
      'location'  => 'nullable|string',
      'facebook'  => 'nullable|string',
      'twitter'   => 'nullable|string',
      'telegram'  => 'nullable|string',
      'instagram' => 'nullable|string',
      'whatsapp'  => 'nullable|numeric'
    ]);

    $message = $this->Interface->updateAdminData($validated) ? 'Your contact info has been updated!' : 'Nothing was updated!';
    Session::flash('message', $message);
    
    return redirect()->back();
  }
}
