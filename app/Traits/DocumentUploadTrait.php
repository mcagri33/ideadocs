<?php

namespace App\Traits;

use App\Services\FileService;

trait DocumentUploadTrait
{
  public function uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService)
  {
    FileService::uploadDocument($file, $documentName, $documentType, $user);

    $emailService->sendDocumentUploadedEmailToUploader($user, $documentName, 'Evrakınız Yüklendi');
    $emailService->sendDocumentUploadedEmailToAdmins($user, $documentName, 'Yeni Evrak Yüklendi');
  }
}
