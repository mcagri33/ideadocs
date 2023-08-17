<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentUploadedToStatus extends Mailable
{
  use Queueable, SerializesModels;

  public $emailData;

  public function __construct($emailData)
  {
    $this->emailData = $emailData;
  }

  public function build()
  {
    try {
      return $this->markdown('emails.document_status_updated')
        ->subject('Evrak Durumu Güncellendi')
        ->with([
          'user' => $this->emailData['user'],
          'document' => $this->emailData['document_name'],
          'status_text' => $this->getStatusText($this->emailData['status']),
        ]);
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error('E-posta gönderimi sırasında hata oluştu: ' . $e->getMessage());
    }
  }



  protected function getStatusText($status)
  {
    if ($status === 1) {
      return 'Onaylandı';
    } elseif ($status === 0) {
      return 'Reddedildi';
    } elseif ($status === 2) {
      return 'Onay Bekliyor';
    } else {
      return 'Bilinmeyen Durum';
    }
  }

}
