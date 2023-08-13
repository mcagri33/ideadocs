<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Models\Documents;
use App\Services\EmailService;
use Illuminate\Http\Request;
use App\Services\FileService;
use Auth;
use App\Traits\DocumentUploadTrait;

class DocumentController extends Controller
{
  protected $emailService;
  use DocumentUploadTrait;

  public function __construct(EmailService $emailService)
  {
    $this->emailService = $emailService;
  }

  public function yonetimkuruluevraklari()
  {
    $user = Auth::user();
    $yonetimKuruluEvraklari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Yönetim Kurulu İmzaları')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.yonetimkurulu', compact('yonetimKuruluEvraklari'));
  }

  public function yonetimkuruluevraklaristore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Yönetim Kurulu İmzaları';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.yonetimkuruluimzalari.index')
      ->with('success', 'Evrak yüklendi!');
  }


  public function tumyilmuavin()
  {
    $user = Auth::user();
    $tumYilMuavin = Documents::where('user_id', $user->id)
      ->where('document_type', 'Tum Yil Muavinleri')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.tumyilmuavin', compact('tumYilMuavin'));
  }

  public function tumyilmuavinstore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Tum Yil Muavinleri';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.tumyilmuavin.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function alinanverilencekler()
  {
    $user = Auth::user();
    $alinanverilencekler = Documents::where('user_id', $user->id)
      ->where('document_type', 'Alinan Verilen Cekler')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.alinanverilencekler', compact('alinanverilencekler'));
  }

  public function alinanverilenceklerstore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Alinan Verilen Cekler';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.alinanverilencekler.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function alinanverilenteminatmektuplarilistesi()
  {
    $user = Auth::user();
    $alinanVerilenTeminatMektuplariListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Alinan Verilen Teminat Mektuplarlari Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.alinanverilenteminatmektuplarilistesi', compact('alinanVerilenTeminatMektuplariListesi'));
  }

  public function alinanverilenteminatmektuplarilistesistore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Alinan Verilen Teminat Mektuplarlari Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.alinanverilenteminatmektuplarilistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function aktifleruzerindekisigorta()
  {
    $user = Auth::user();
    $aktifleruzerindekisigorta = Documents::where('user_id', $user->id)
      ->where('document_type', 'Aktifler Uzerindeki Sigorta Teminat Tutarları')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.aktifleruzerindekisigorta', compact('aktifleruzerindekisigorta'));
  }

  public function aktifleruzerindekisigortastore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Aktifler Uzerindeki Sigorta Teminat Tutarları';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.aktifleruzerindekisigorta.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function kirasozlesme()
  {
    $user = Auth::user();
    $kiraSozlesme = Documents::where('user_id', $user->id)
      ->where('document_type', 'Kira Sozlesme')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.kirasozlesme', compact('kiraSozlesme'));
  }

  public function kirasozlesmestore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Kira Sozlesme';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.kirasozlesme.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function kasasayimtutanagi()
  {
    $user = Auth::user();
    $kasaSayimTutanagi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Kasa Sayim Tutanagi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.kasasayimtutanagi', compact('kasaSayimTutanagi'));
  }

  public function kasasayimtutanagistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Kasa Sayim Tutanagi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.kasasayimtutanagi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function bankamutabakatlari()
  {
    $user = Auth::user();
    $bankaMutabakatlari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Banka Mutabakatlari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.bankamutabakatlari', compact('bankaMutabakatlari'));
  }

  public function bankamutabakatlaristore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Banka Mutabakatlari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.bankamutabakatlari.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function stoksayimtutanagi()
  {
    $user = Auth::user();
    $stokSayimTutanagi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Stok Sayim Tutanagi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.stoksayimtutanagi', compact('stokSayimTutanagi'));
  }

  public function stoksayimtutanagistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Stok Sayim Tutanagi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.stoksayimtutanagi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function stokmiktardengesi()
  {
    $user = Auth::user();
    $stokMiktarDengesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Stok Miktar Dengesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.stokmiktardengesi', compact('stokMiktarDengesi'));
  }

  public function stokmiktardengesistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Stok Miktar Dengesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.stokmiktardengesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function stoktutardengesi()
  {
    $user = Auth::user();
    $stokTutarDengesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Stok Tutar Dengesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.stoktutardengesi', compact('stokTutarDengesi'));
  }

  public function stoktutardengesistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Stok Tutar Dengesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.stoktutardengesi.index')
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

}
