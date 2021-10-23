<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Core extends Model {
  public function getTodayVisitor() {
    return DB::table('visitors')
      ->where('visited_at', '>=', Carbon::today())
      ->count();
  }
  
  public function getUniqueVisitor() {
    return DB::table('visitors')
      ->distinct()
      ->count('ip_address');
  }

  public function getTotalVisitor() {
    return DB::table('visitors')->count();
  }

  public function getMessage() {
    return DB::table('messages')
      ->orderByDesc('id')
      ->get();
  }

  public function getUnreadCount() {
    return DB::table('messages')
      ->where('seen', 0)
      ->count();
  }

  public function getSetting() {
    return DB::table('settings')->first();
  }

  public function markAsRead($last_id) {
    return DB::table('messages')
      ->where('id', '<=', $last_id)
      ->update([
        'seen' => 1
      ]);
  }

  public function updateEmailNotificationStatus($new_status) {
    return DB::table('settings')
      ->update([
        'email_notification' => $new_status
      ]);
  }

  public function deleteMessage($id) {
    return DB::table('messages')
      ->where('id', $id)
      ->delete();
  }
}
