<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageSent extends Notification implements ShouldQueue {
  use Queueable;

  protected $name;
  protected $data;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($name, $data) {
    $this->name = $name;
    $this->data = $data;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable) {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable) {
    return (new MailMessage)
      ->subject('New Message on Photocraft')
      ->greeting('Hello ' . $this->name . '!')
      ->line('Somebody just sent you a message. Here are the details:')
      ->line('Name: ' . $this->data['name'])
      ->line('Email: ' . $this->data['email'])
      ->line('Message: ' . $this->data['message'])
      ->line('Thank you for using our application!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable) {
    return [
      //
    ];
  }
}
