<?php

namespace App\Listeners;

use App\Events\DocumentStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDocumentStatusEmails
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

  public function handle(DocumentStatusUpdated $event)
  {
    $user = $event->user;
    $document = $event->document;

    if ($document->status === 1) { // Onaylandı durumu
      // Onaylandı e-postası gönderme işlemleri
      $subject = 'Evrakınız Onaylandı';
      $message = 'Sayın ' . $user->name . ', belgeniz onaylandı.';
    } elseif ($document->status === 0) { // Reddedildi durumu
      // Reddedildi e-postası gönderme işlemleri
      $subject = 'Evrakınız Reddedildi';
      $message = 'Sayın ' . $user->name . ', belgeniz reddedildi.';
    }

    try {
      \Mail::to($user->email)->send(new \App\Mail\DocumentUploadedToStatus([
        'subject' => $subject,
        'message' => $message,
      ]));
    } catch (\Exception $e) {
      \Log::error('E-posta gönderilirken hata oluştu: ' . $e->getMessage());
    }
  }
}
