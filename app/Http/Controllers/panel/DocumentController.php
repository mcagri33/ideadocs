<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Services\EmailService;
use Illuminate\Http\Request;
use App\Services\FileService;
use Auth;
class DocumentController extends Controller
{

  public function yonetimkuruluevraklari()
  {
    $user = Auth::user();
    $yonetimKuruluEvraklari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Yönetim Kurulu İmzaları')
      ->paginate(10);

    return view('panel.documents.yonetimkurulu',compact('yonetimKuruluEvraklari'));
  }

  public function yonetimkuruluevraklaristore(Request $request, EmailService $emailService)
  {
    $request->validate([
      'document_name' => 'required',
      'file' => 'required|file|max:200048',
    ]);

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Yönetim Kurulu İmzaları';
    $file = $request->file('file');

    FileService::uploadDocument($file, $documentName, $documentType, $user);
    $emailService->sendDocumentUploadedEmail(Auth::user()->name, $documentName);

    return redirect()->route('castle.document.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function download($file)
  {
    $document = Documents::find($file);

    if (!$document) {
      return abort(404);
    }

    $filePath = FileService::getDocumentFilePath($document);
   // dd($filePath);

    return response()->download(public_path($filePath));

  }

  /*public function destroy($id)
  {
    $document = Documents::findOrFail($id);
    FileService::deleteDocument($document);

    return redirect()->route('evrak.index')
      ->with('success', 'Evrak silindi!');
  }*/
}
