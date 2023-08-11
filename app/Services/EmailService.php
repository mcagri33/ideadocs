<?php

namespace App\Services;

namespace App\Services;

use App\Mail\DocumentUploadedToUploader;
use App\Mail\DocumentUploadedToAdmins;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EmailService
{
  public function sendDocumentUploadedEmailToUploader($uploader, $documentName)
  {
    $emailData = [
      'uploader' => $uploader,
      'document_name' => $documentName,
      'subject' => 'Evrakınız Yüklendi',

    ];

    Mail::to($uploader->email)->send(new DocumentUploadedToUploader($emailData));
  }

  public function sendDocumentUploadedEmailToAdmins($uploader, $documentName)
  {
    $emailData = [
      'uploader' => $uploader,
      'document_name' => $documentName,
      'subject' => 'Yeni Evrak Yüklendi',
    ];

    $admins = User::whereHas('roles', function ($query) {
      $query->where('name', 'Admin');
    })->get();

    foreach ($admins as $admin) {
      Mail::to($admin->email)->send(new DocumentUploadedToAdmins($emailData));
    }
  }
}

