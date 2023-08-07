<?php

namespace App\Services;

use App\Mail\DocumentApproved;
use App\Mail\DocumentRejected;

class EmailService
{
  public function sendDocumentUploadedEmail($userName, $documentName)
  {
    $emailData = [
      'user_name' => $userName,
      'document_name' => $documentName,
    ];

    Mail::to('your-email@example.com')->send(new DocumentUploaded($emailData));
  }

  public function sendDocumentApprovedEmail($userName, $documentName)
  {
    $emailData = [
      'user_name' => $userName,
      'document_name' => $documentName,
    ];

    Mail::to('your-email@example.com')->send(new DocumentApproved($emailData));
  }

  public function sendDocumentRejectedEmail($userName, $documentName)
  {
    $emailData = [
      'user_name' => $userName,
      'document_name' => $documentName,
    ];

    Mail::to('your-email@example.com')->send(new DocumentRejected($emailData));
  }
}
