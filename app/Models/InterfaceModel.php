<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InterfaceModel extends Model {
  public function getAdminData() {
    return DB::table('admin')->first();
  }

  public function updateAdminData($data) {
    return DB::table('admin')->update($data);
  }
}
