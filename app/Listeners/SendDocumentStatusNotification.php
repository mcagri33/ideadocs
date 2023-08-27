<?php

namespace App\Listeners;

use App\Events\DocumentStatusUpdated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentStatusUpdated as DocumentStatusUpdatedMail;
use Illuminate\Support\Facades\Log;
class SendDocumentStatusNotification
{
  public function handle(DocumentStatusUpdated $event)
  {
    Log::info('Listener is working for DocumentStatusUpdated event.');

    try {
      Mail::to($event->user->email)->send(new DocumentStatusUpdatedMail($event->document, $event->newStatus));

      $adminUsers = User::whereHas('roles', function ($query) {
        $query->where('name', 'Admin');
      })->get();

      foreach ($adminUsers as $adminUser) {
        Mail::to($adminUser->email)->send(new DocumentStatusUpdatedMail($event->document, $event->newStatus));
      }
    } catch (\Exception $e) {
      Log::error('Mail sending error: ' . $e->getMessage());
    }
  }
}
