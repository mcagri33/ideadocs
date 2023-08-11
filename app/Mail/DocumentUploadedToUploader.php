<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentUploadedToUploader extends Mailable
{
  use Queueable, SerializesModels;

  public $emailData;

  public function __construct($emailData)
  {
    $this->emailData = $emailData;
  }

  public function build()
  {
    return $this->markdown('emails.document_uploaded_to_uploader')
                ->subject('Evrağınız Yüklendi');

  }
}
