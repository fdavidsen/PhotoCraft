<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Account extends Model {
  public function updateUsername($id, $new_username) {
    return DB::table('users')
      ->where('id', $id)
      ->update([
        'username'   => $new_username,
        'updated_at' => Carbon::now()
      ]);
  }

  public function updatePassword($id, $new_password) {
    return DB::table('users')
      ->where('id', $id)
      ->update([
        'password'   => $new_password,
        'updated_at' => Carbon::now()
      ]);
  }
}
