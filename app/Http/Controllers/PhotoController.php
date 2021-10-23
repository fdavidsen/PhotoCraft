<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhotoController extends Controller {
  public function __construct() {
    $this->Photo = new Photo();
  }

  public function show($section) {
    return view('admin/photo-list', [
      'section' => $section,
      'photos'  => $this->Photo->getPhotos($section)
    ]);
  }

  public function store(Request $request) {
    $request->validate([
      'photo'   => 'required|image',
      'caption' => 'nullable|string'
    ]);

    $file = $request->photo;
    $file_name = uniqid() . '.' . $file->extension();
    $file->move(public_path('img/photo'), $file_name);

    $data = array(
      'section'  => $request->section,
      'filename' => $file_name,
      'caption'  => $request->caption
    );
    
    $message = $this->Photo->addNewPhoto($data) ? 'Your photo has been uploaded!' : 'Nothing was uploaded!';
    Session::flash('message', $message);

    return true;
  }
  
  public function update(Request $request) {
    $id        = $request->id;
    $old_photo = $request->old_photo;

    $request->validate([
      'photo'   => 'nullable|image',
      'caption' => 'nullable|string'
    ]);

    $data = ['caption' => $request->caption];

    if ($request->photo <> '') {
      $file = $request->photo;
      $filename = uniqid() . '.' . $file->extension();
      $file->move(public_path('img/photo'), $filename);

      $data['filename'] = $filename;
      unlink(public_path('img/photo/' . $old_photo));
    }

    $message = $this->Photo->updatePhoto($id, $data) ? 'Your photo has been updated!' : 'Nothing was updated!';
    Session::flash('message', $message);

    return true;
  }

  public function destroy(Request $request) {
    $id       = $request->id;
    $filename = $request->filename;

    if ($this->Photo->deletePhoto($id)) {
      unlink(public_path('img/photo/' . $filename));
      $message = 'Your photo has been deleted!';
    } else {
      $message = 'Nothing was deleted!';
    }
    Session::flash('message', $message);

    return true;
  }
}
