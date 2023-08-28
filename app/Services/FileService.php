<?php

namespace App\Services;

use App\Models\Documents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileService
{
  public static function uploadDocument(UploadedFile $file, $documentName, $documentType, $user)
  {
    $userName = Str::slug($user->name) . '-' . Str::slug($user->company);
    $fileName = $documentName . '_' . now()->format('Y-m-d') . '.' . $file->getClientOriginalExtension();
    $filePath = $file->storeAs('public/documents/'.$userName, $fileName);

    $document = new Documents([
      'user_id' => $user->id,
      'uuid' => Str::uuid(),
      'document_name' => $documentName,
      'document_type' => $documentType,
      'path' => $filePath,
    ]);

    $document->save();
    return $document;
  }


  public static function getDocumentFilePath(Documents $document)
  {
    return Storage::url($document->path);
  }

  public static function deleteDocument(Documents $document)
  {
    Storage::delete($document->path);
    $document->delete();
  }
}
