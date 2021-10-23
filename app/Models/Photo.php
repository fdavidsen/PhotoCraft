<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Photo extends Model {
  public function getPhotos($section) {
    return DB::table('photos')
      ->orderByDesc('id')
      ->where('section', $section)
      ->get();
  }
  
  public function addNewPhoto($data) {
    return DB::table('photos')->insert($data);
  }

  public function updatePhoto($id, $data) {
    return DB::table('photos')
      ->where('id', $id)
      ->update($data);
  }

  public function deletePhoto($id) {
    return DB::table('photos')
      ->where('id', $id)
      ->delete();
  }
}