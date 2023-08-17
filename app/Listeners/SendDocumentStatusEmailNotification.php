<?php

namespace App\Listeners;

use App\Events\DocumentStatusUpdated;
use App\Mail\DocumentUploadedToStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDocumentStatusEmailNotification implements ShouldQueue
{
  public function handle(DocumentStatusUpdated $event)
  {
    $emailData = [
      'user' => $event->user,
      'document_name' => $event->document->document_name,
      'status' => $event->newStatus,
      'subject' => 'Evrak Durumu',
    ];

    Mail::to($event->user->email)->send(new DocumentUploadedToStatus($emailData));
  }
}
