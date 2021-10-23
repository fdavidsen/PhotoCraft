<?php

namespace App\Http\Controllers;

use App\Models\Core;
use Illuminate\Http\Request;

class CoreController extends Controller {
  public function __construct() {
    $this->Core = new Core();
  }

  public function dashboard() {
    return view('admin/dashboard', [
      'unread_count'    => $this->Core->getUnreadCount(),
      'today_visitors'  => $this->Core->getTodayVisitor(),
      'unique_visitors' => $this->Core->getUniqueVisitor(),
      'total_visitors'  => $this->Core->getTotalVisitor()
    ]);
  }

  public function showMessage() {
    $message_list = $this->Core->getMessage();

    return view('admin/message', [
      'message'      => $this->formatMessageDate($message_list),
      'unread_count' => $this->Core->getUnreadCount(),
      'setting'      => $this->Core->getSetting()
    ]);
  }

  public function markAsRead(Request $request) {
    $last_id = $request->last_id;
    return $this->Core->markAsRead($last_id);
  }
  
  public function toggleNotification() {
    $current_status = $this->Core->getSetting()->email_notification;

    $new_status = $current_status == 0 ? 1 : 0;
    $this->Core->updateEmailNotificationStatus($new_status);

    return true;
  }

  public function destroyMessage(Request $request) {
    $id = $request->id;
    return $this->Core->deleteMessage($id);
  }
  
  private function formatMessageDate($message_list) {
    $today_date = date('Y-m-d');
    $today_year = date('Y');
  
    foreach ($message_list as $index => $item) {
      $received_time = strtotime($item->received_at);
      $received_date = date('Y-m-d', $received_time);
      $received_year = date('Y', $received_time);
  
      if ($received_date == $today_date) {
        $format = 'H:i';
      } elseif ($received_year == $today_year) {
        $format = 'M d';
      } else {
        $format = 'M d, Y';
      }
  
      $message_list[$index]->received_at = date($format, $received_time);
    }

    return $message_list;
  }
}
