<?php

namespace App\Http\Controllers\panel;

use App\Events\DocumentStatusUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Models\Documents;
use App\Models\User;
use App\Services\EmailService;
use App\Services\FileService;
use Auth;
use App\Traits\DocumentUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
  use DocumentUploadTrait;
  protected $emailService;

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

  public function updateStatus(Request $request, Documents $document)
  {
    try {
      $newStatus = $request->input('status');
      $document->update(['status' => $newStatus]);
      Log::info('Document status updated event is about to be fired.');

      event(new DocumentStatusUpdated($document, $document->user, $newStatus));

      return response()->json(['message' => 'Evrak durumu güncellendi']);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Evrak durumu güncellenirken hata oluştu.'], 500);
    }
  }

  public function yonetimKuruluEvraklari()
  {
    $user = Auth::user();
    $yonetimKuruluEvraklari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Yönetim Kurulu İmzaları')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.yonetimkurulu', compact('yonetimKuruluEvraklari'));
  }

  public function yonetimKuruluEvraklariStore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Yönetim Kurulu İmzaları';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.yonetimkuruluimzalari.index')
      ->with('success', 'Evrak yüklendi!');
  }


  /*public function tumYilMuavin()
  {
    $user = Auth::user();
    $tumYilMuavin = Documents::where('user_id', $user->id)
      ->where('document_type', 'Tum Yil Muavinleri')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.tumyilmuavin', compact('tumYilMuavin'));
  }

  public function tumYilmuavinStore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Tum Yil Muavinleri';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.tumyilmuavin.index')
      ->with('success', 'Evrak yüklendi!');
  }*/

  public function alinanVerilenCekler()
  {
    $user = Auth::user();
    $alinanverilencekler = Documents::where('user_id', $user->id)
      ->where('document_type', 'Alinan Verilen Cekler')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.alinanverilencekler', compact('alinanverilencekler'));
  }

  public function alinanVerilenCeklerStore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Alinan Verilen Cekler';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.alinanverilencekler.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function alinanVerilenTeminatMektuplariListesi()
  {
    $user = Auth::user();
    $alinanVerilenTeminatMektuplariListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Alinan Verilen Teminat Mektuplarlari Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.alinanverilenteminatmektuplarilistesi', compact('alinanVerilenTeminatMektuplariListesi'));
  }

  public function alinanVerilenTeminatMektuplariListesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Alinan Verilen Teminat Mektuplarlari Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.alinanverilenteminatmektuplarilistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function aktiflerUzerindekiSigorta()
  {
    $user = Auth::user();
    $aktifleruzerindekisigorta = Documents::where('user_id', $user->id)
      ->where('document_type', 'Aktifler Uzerindeki Sigorta Teminat Tutarları')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.aktifleruzerindekisigorta', compact('aktifleruzerindekisigorta'));
  }

  public function aktiflerUzerindekiSigortaStore(DocumentStoreRequest $request, EmailService $emailService)
  {

    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Aktifler Uzerindeki Sigorta Teminat Tutarları';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.aktifleruzerindekisigorta.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function kiraSozlesme()
  {
    $user = Auth::user();
    $kiraSozlesme = Documents::where('user_id', $user->id)
      ->where('document_type', 'Kira Sozlesme')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.kirasozlesme', compact('kiraSozlesme'));
  }

  public function kiraSozlesmeStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Kira Sozlesme';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.kirasozlesme.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function kasaSayimTutanagi()
  {
    $user = Auth::user();
    $kasaSayimTutanagi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Kasa Sayim Tutanagi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.kasasayimtutanagi', compact('kasaSayimTutanagi'));
  }

  public function kasaSayimTutanagiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Kasa Sayim Tutanagi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.kasasayimtutanagi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function bankaMutabakatlari()
  {
    $user = Auth::user();
    $bankaMutabakatlari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Banka Mutabakatlari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.bankamutabakatlari', compact('bankaMutabakatlari'));
  }

  public function bankaMutabakatlariStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Banka Mutabakatlari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.bankamutabakatlari.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function stokSayimTutanagi()
  {
    $user = Auth::user();
    $stokSayimTutanagi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Stok Sayim Tutanagi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.stoksayimtutanagi', compact('stokSayimTutanagi'));
  }

  public function stokSayimTutanagiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Stok Sayim Tutanagi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.stoksayimtutanagi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function stokMiktarDengesi()
  {
    $user = Auth::user();
    $stokMiktarDengesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Stok Miktar Dengesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.stokmiktardengesi', compact('stokMiktarDengesi'));
  }

  public function stokMiktarDengesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Stok Miktar Dengesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.stokmiktardengesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function stokTutarDengesi()
  {
    $user = Auth::user();
    $stokTutarDengesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Stok Tutar Dengesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.stoktutardengesi', compact('stokTutarDengesi'));
  }

  public function stokTutarDengesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Stok Tutar Dengesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.stoktutardengesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function supheliAlacaklar()
  {
    $user = Auth::user();
    $supheliAlacaklar = Documents::where('user_id', $user->id)
      ->where('document_type', 'Supheli Alacaklar İcra Evraklari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.suphelialacaklar', compact('supheliAlacaklar'));
  }

  public function supheliAlacaklarStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Supheli Alacaklar İcra Evraklari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.suphelialacaklar.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function taksitliKrediListesi()
  {
    $user = Auth::user();
    $taksitliKrediListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Taksitli Kredi Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.taksitlikredilistesi', compact('taksitliKrediListesi'));
  }

  public function taksitliKrediListesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Taksitli Kredi Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.taksitlikredilistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function satisFaturalariListesi()
  {
    $user = Auth::user();
    $satisFaturaListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Satis Fatura Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.satisfaturalarilistesi', compact('satisFaturaListesi'));
  }

  public function satisFaturalariListesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Satis Fatura Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.satisfaturalarilistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function satislarinMaliyetCalismasi()
  {
    $user = Auth::user();
    $satislarinMaliyetCalismasi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Satislarin Maliyet Calismasi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.satislarinmaliyetcalismasi', compact('satislarinMaliyetCalismasi'));
  }

  public function satislarinMaliyetCalismasiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Satislarin Maliyet Calismasi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.satislarinmaliyetcalismasi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function amortismanlarinCalismasi()
  {
    $user = Auth::user();
    $amortismanCalismasi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Amortisman Calismasi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.amortismanlarincalismasi', compact('amortismanCalismasi'));
  }

  public function amortismanlarinCalismasiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Amortisman Calismasi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.amortismanlarincalismasi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function personelListesi()
  {
    $user = Auth::user();
    $personelListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Personel Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.personellistesi', compact('personelListesi'));
  }

  public function personelListesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Personel Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.personellistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function interaktiftenAlinanAracListesi()
  {
    $user = Auth::user();
    $interaktiftenAlinanAracListesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Interaktiften Alinan Arac Listesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.interaktiftenalinanaraclistesi', compact('interaktiftenAlinanAracListesi'));
  }

  public function interaktiftenAlinanAracListesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Interaktiften Alinan Arac Listesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.interaktiftenalinanaraclistesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function dovizDegerlemeTablolari()
  {
    $user = Auth::user();
    $dovizDegerlemeTablolari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Doviz Degerleme Tablolari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.dovizdegerlemetablolari', compact('dovizDegerlemeTablolari'));
  }

  public function dovizDegerlemeTablolariStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Doviz Degerleme Tablolari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.dovizdegerlemetablolari.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function organizasyonSemasi()
  {
    $user = Auth::user();
    $organizasyonSemasi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Organizasyon Semasi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.organizasyonsemasi', compact('organizasyonSemasi'));
  }

  public function organizasyonSemasiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Organizasyon Semasi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.organizasyonsemasi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function cariYilGuncelMizani()
  {
    $user = Auth::user();
    $cariYilGuncelMizani = Documents::where('user_id', $user->id)
      ->where('document_type', 'Cari Yil Guncel Mizani')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.cariyilguncelmizani', compact('cariYilGuncelMizani'));
  }

  public function cariYilGuncelMizaniStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Cari Yil Guncel Mizani';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.cariyilguncelmizani.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function mdvDegerlemeCalismalari()
  {
    $user = Auth::user();
    $mdvDegerlemeCalismalari = Documents::where('user_id', $user->id)
      ->where('document_type', 'Mdv Degerleme Calismalari')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.mdvdegerlemecalismalari', compact('mdvDegerlemeCalismalari'));
  }

  public function mdvDegerlemeCalismalariStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Mdv Degerleme Calismalari';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.mdvdegerlemecalismalari.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function mizanKurumlarVergisiBeyanamesi()
  {
    $user = Auth::user();
    $mizanKurumlarVergisiBeyanamesi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Mizan ve Kurumlar Vergisi Beyanamesi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.mizankurumlarvergisibeyanamesi', compact('mizanKurumlarVergisiBeyanamesi'));
  }

  public function mizanKurumlarVergisiBeyanamesiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Mizan ve Kurumlar Vergisi Beyanamesi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.mizankurumlarvergisibeyanamesi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function tapuTakyidatYazisi()
  {
    $user = Auth::user();
    $tapuTakyidatYazisi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Tapu Takyidat Yazisi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.taputakyidatyazisi', compact('tapuTakyidatYazisi'));
  }


  public function tapuTakyidatYazisiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Tapu Takyidat Yazisi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.taputakyidatyazisi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function avukatYazisi()
  {
    $user = Auth::user();
    $avukatYazisi = Documents::where('user_id', $user->id)
      ->where('document_type', 'Avukat Yazisi')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.avukatyazisi', compact('avukatYazisi'));
  }

  public function avukatYazisiStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Avukat Yazisi';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.avukatyazisi.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function vergiDairesiBorcDurumu()
  {
    $user = Auth::user();
    $vergiDairesiBorcDurumu = Documents::where('user_id', $user->id)
      ->where('document_type', 'Vergi Dairesi Borc Durumu')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.vergidairesiborc', compact('vergiDairesiBorcDurumu'));
  }

  public function vergiDairesiBorcDurumuStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Vergi Dairesi Borc Durumu';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.vergidairesiborc.index')
      ->with('success', 'Evrak yüklendi!');
  }

  public function sgkBorcDurumu()
  {
    $user = Auth::user();
    $sgkBorcDurumu = Documents::where('user_id', $user->id)
      ->where('document_type', 'Sgk Borc Durumu')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('panel.documents.sgkborcdurumu', compact('sgkBorcDurumu'));
  }

  public function sgkBorcDurumuStore(DocumentStoreRequest $request, EmailService $emailService)
  {
    $user = Auth::user();
    $documentName = $request->input('document_name');
    $documentType = 'Sgk Borc Durumu';
    $file = $request->file('file');

    $this->uploadDocumentAndNotify($file, $documentName, $documentType, $user, $emailService);

    return redirect()->route('castle.sgkborcdurumu.index')
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
