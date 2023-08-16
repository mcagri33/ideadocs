<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Models\Documents;
use App\Models\User;
use App\Services\EmailService;
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

  public function allDocuments()
  {
    $usersDocs = User::whereHas('roles', function ($query) {
      $query->where('name', 'Customer');
    })->with('documents')->get();
    return view('panel.documents.tumevrak', compact('usersDocs'));
  }

  public function getUserDetails($userUuid)
  {
    $users = User::where('uuid',$userUuid)->paginate(10);
    //dd($users);
    return view('panel.documents.evrak-show',compact('users'));
  }

  public function updateStatus(DocumentStoreRequest $request, Documents $document)
  {
    try {
      $newStatus = $request->input('status');
      $document->update(['status' => $newStatus]);
      return response()->json(['message' => 'Evrak durumu güncellendi']);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Evrak durumu güncellenirken hata oluştu.'], 500);
    }
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

  public function suphelialacaklar()
  {
    $user = Auth::user();
    $supheliAlacaklar = Documents::where('user_id', $user->id)
      ->where('document_type', 'Supheli Alacaklar İcra Evraklari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.suphelialacaklar', compact('supheliAlacaklar'));
  }

  public function suphelialacaklarstore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Supheli Alacaklar İcra Evraklari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.suphelialacaklar.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function taksitlikredilistesi()
  {
    $user = Auth::user();
    $taksitliKrediListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Taksitli Kredi Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.taksitlikredilistesi', compact('taksitliKrediListesi'));
  }

  public function taksitlikredilistesistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Taksitli Kredi Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.taksitlikredilistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function satisfaturalarilistesi()
  {
    $user = Auth::user();
    $satisFaturaListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Satis Fatura Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.satisfaturalarilistesi', compact('satisFaturaListesi'));
  }

  public function satisfaturalarilistesistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Satis Fatura Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.satisfaturalarilistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function satislarinmaliyetcalismasi()
  {
    $user = Auth::user();
    $satislarinMaliyetCalismasi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Satislarin Maliyet Calismasi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.satislarinmaliyetcalismasi', compact('satislarinMaliyetCalismasi'));
  }

  public function satislarinmaliyetcalismasistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Satislarin Maliyet Calismasi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.satislarinmaliyetcalismasi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function amortismanlarincalismasi()
  {
    $user = Auth::user();
    $amortismanCalismasi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Amortisman Calismasi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.amortismanlarincalismasi', compact('amortismanCalismasi'));
  }

  public function amortismanlarincalismasistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Amortisman Calismasi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.amortismanlarincalismasi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function personellistesi()
  {
    $user = Auth::user();
    $personelListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Personel Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.personellistesi', compact('personelListesi'));
  }

  public function personellistesistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Personel Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.personellistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function interaktiftenalinanaraclistesi()
  {
    $user = Auth::user();
    $interaktiftenAlinanAracListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Interaktiften Alinan Arac Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.interaktiftenalinanaraclistesi', compact('interaktiftenAlinanAracListesi'));
  }

  public function interaktiftenalinanaraclistesistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Interaktiften Alinan Arac Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.interaktiftenalinanaraclistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function dovizdegerlemetablolari()
  {
    $user = Auth::user();
    $dovizDegerlemeTablolari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Doviz Degerleme Tablolari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.dovizdegerlemetablolari', compact('dovizDegerlemeTablolari'));
  }

  public function dovizdegerlemetablolaristore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Doviz Degerleme Tablolari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.dovizdegerlemetablolari.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function organizasyonsemasi()
  {
    $user = Auth::user();
    $organizasyonSemasi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Organizasyon Semasi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.organizasyonsemasi', compact('organizasyonSemasi'));
  }

  public function organizasyonsemasistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Organizasyon Semasi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.organizasyonsemasi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function cariyilguncelmizani()
  {
    $user = Auth::user();
    $cariYilGuncelMizani = Documents::where('user_id', $user->id)
      ->where('document_type', 'Cari Yil Guncel Mizani')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.cariyilguncelmizani', compact('cariYilGuncelMizani'));
  }

  public function cariyilguncelmizanistore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Cari Yil Guncel Mizani';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.cariyilguncelmizani.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function mdvdegerlemecalismalari()
  {
    $user = Auth::user();
    $mdvDegerlemeCalismalari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Mdv Degerleme Calismalari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.mdvdegerlemecalismalari', compact('mdvDegerlemeCalismalari'));
  }

  public function mdvdegerlemecalismalaristore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Mdv Degerleme Calismalari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.mdvdegerlemecalismalari.index')
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
