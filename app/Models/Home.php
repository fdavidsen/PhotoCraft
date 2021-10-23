<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Home extends Model {
  public function Visitor($ip_address) {
    return DB::table('visitors')->insert(['ip_address' => $ip_address]);
  }

  public function getAdminData() {
    return DB::table('admin')->first();
  }

  public function sendMessage($data) {
    $data['received_at'] = Carbon::now();
    return DB::table('messages')->insert($data);
  }
}
