<?php

namespace App\Mail;

use App\Models\Documents;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentStatusUpdated extends Mailable
{
  use Queueable, SerializesModels;

  public $document;
  public $newStatus;

  public function __construct(Documents $document, $newStatus)
  {
    $this->document = $document;
    $this->newStatus = $newStatus;
  }

  public function build()
  {
    return $this->markdown('emails.document-status-updated')
    ->with(['user' => $this->document->user, 'newStatus' => $this->newStatus])
      ->subject('Evrak Durumu Güncellendi');;
  }
}
