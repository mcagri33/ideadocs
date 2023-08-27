<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\panel\RoleController;
use App\Http\Controllers\panel\UserController;
use App\Http\Controllers\panel\DocumentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
Route::group(['prefix' => '/'], function () {
  Route::get('/', [AuthController::class, 'site'])
    ->name('site.index');
});

Route::group(['prefix' => '/panel', 'middleware' => ['auth']], function () {
  Route::get('/', [AuthController::class, 'castle'])
    ->name('castle.panel.index');
});

Route::group(['prefix' => '/panel/user','middleware' => ['auth','role:Admin']], function () {
  Route::get('/', [UserController::class, 'index'])
    ->name('castle.user.index');
  Route::get('/add',[UserController::class,'create'])
    ->name('castle.user.add');
  Route::post('/store',[UserController::class,'store'])
    ->name('castle.user.store');
  Route::get('/edit/{uuid}', [UserController::class, 'edit'])
    ->name('castle.user.edit');
  Route::post('/update/{uuid}', [UserController::class, 'update'])
    ->name('castle.user.update');
  Route::get('/delete/{uuid}', [UserController::class, 'destroy'])
    ->name('castle.user.delete');
});

Route::group(['prefix' => '/panel/roles','middleware' => ['auth','role:Admin']], function () {
  Route::get('/', [RoleController::class, 'index'])
    ->name('castle.role.index');
  Route::get('/add',[RoleController::class,'create'])
    ->name('castle.role.add');
  Route::post('/store',[RoleController::class,'store'])
    ->name('castle.role.store');
  Route::get('/edit/{id}', [RoleController::class, 'edit'])
    ->name('castle.role.edit');
  Route::post('/update/{id}', [RoleController::class, 'update'])
    ->name('castle.role.update');
  Route::get('/delete/{id}', [RoleController::class, 'destroy'])
    ->name('castle.role.delete');
});

Route::group(['prefix' => '/panel/tum-evraklar','middleware' => ['auth','role:Admin']], function () {
  Route::get('/', [DocumentController::class, 'allDocuments'])
    ->name('castle.alldocument.index');
  Route::get('/{userUuid}', [DocumentController::class, 'getUserDetails'])
    ->name('castle.user.evrak');
  Route::post('/update-document-status/{document}', [DocumentController::class, 'updateStatus'])->name('update.document.status');
  Route::post('/add-document-note/', [DocumentController::class, 'addDocumentNote'])->name('add.document.note');

  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.file.download');
});


Route::group(['prefix' => '/panel/yonetim-kurulu-imzalari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'yonetimKuruluEvraklari'])
    ->name('castle.yonetimkuruluimzalari.index');
  Route::post('/store',[DocumentController::class,'yonetimKuruluEvraklariStore'])
    ->name('castle.yonetimkuruluimzalari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.yonetimkuruluimzalari.download');
  Route::get('/search', 'DocumentController@yonetimKuruluEvraklari')
    ->name('castle.yonetimkuruluimzalari.search');
});

/*Route::group(['prefix' => '/panel/tum-yil-muavin','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'tumYilMuavin'])
    ->name('castle.tumyilmuavin.index');
  Route::post('/store',[DocumentController::class,'tumYilmuavinStore'])
    ->name('castle.tumyilmuavin.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.tumyilmuavin.download');
});*/

Route::group(['prefix' => '/panel/alinan-verilen-cekler','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'alinanVerilenCekler'])
    ->name('castle.alinanverilencekler.index');
  Route::post('/store',[DocumentController::class,'alinanVerilenCeklerStore'])
    ->name('castle.alinanverilencekler.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.alinanverilencekler.download');
});

Route::group(['prefix' => '/panel/alinan-verilen-teminat-mektuplari-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'alinanVerilenTeminatMektuplariListesi'])
    ->name('castle.alinanverilenteminatmektuplarilistesi.index');
  Route::post('/store',[DocumentController::class,'alinanVerilenTeminatMektuplariListesiStore'])
    ->name('castle.alinanverilenteminatmektuplarilistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.alinanverilenteminatmektuplarilistesi.download');
});

Route::group(['prefix' => '/panel/aktifler-uzerindeki-sigorta','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'aktiflerUzerindekiSigorta'])
    ->name('castle.aktifleruzerindekisigorta.index');
  Route::post('/store',[DocumentController::class,'aktiflerUzerindekiSigortaStore'])
    ->name('castle.aktifleruzerindekisigorta.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.aktifleruzerindekisigorta.download');
});

Route::group(['prefix' => '/panel/kira-sozlesme','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'kiraSozlesme'])
    ->name('castle.kirasozlesme.index');
  Route::post('/store',[DocumentController::class,'kiraSozlesmeStore'])
    ->name('castle.kirasozlesme.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.kirasozlesme.download');
});

Route::group(['prefix' => '/panel/kasa-sayim-tutanagi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'kasaSayimTutanagi'])
    ->name('castle.kasasayimtutanagi.index');
  Route::post('/store',[DocumentController::class,'kasaSayimTutanagiStore'])
    ->name('castle.kasasayimtutanagi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.kasasayimtutanagi.download');
});

Route::group(['prefix' => '/panel/banka-mutabakatlari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'bankaMutabakatlari'])
    ->name('castle.bankamutabakatlari.index');
  Route::post('/store',[DocumentController::class,'bankaMutabakatlariStore'])
    ->name('castle.bankamutabakatlari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.bankamutabakatlari.download');
});

Route::group(['prefix' => '/panel/stok-sayim-tutanagi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'stokSayimTutanagi'])
    ->name('castle.stoksayimtutanagi.index');
  Route::post('/store',[DocumentController::class,'stokSayimTutanagiStore'])
    ->name('castle.stoksayimtutanagi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.stoksayimtutanagi.download');
});

Route::group(['prefix' => '/panel/stok-miktar-dengesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'stokMiktarDengesi'])
    ->name('castle.stokmiktardengesi.index');
  Route::post('/store',[DocumentController::class,'stokMiktarDengesiStore'])
    ->name('castle.stokmiktardengesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.stokmiktardengesi.download');
});

Route::group(['prefix' => '/panel/stok-tutar-dengesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'stokTutarDengesi'])
    ->name('castle.stoktutardengesi.index');
  Route::post('/store',[DocumentController::class,'stokTutarDengesiStore'])
    ->name('castle.stoktutardengesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.stoktutardengesi.download');
});

Route::group(['prefix' => '/panel/supheli-alacaklar-icra-evraklari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'supheliAlacaklar'])
    ->name('castle.suphelialacaklar.index');
  Route::post('/store',[DocumentController::class,'supheliAlacaklarStore'])
    ->name('castle.suphelialacaklar.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.suphelialacaklar.download');
});

Route::group(['prefix' => '/panel/taksitli-kredi-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'taksitliKrediListesi'])
    ->name('castle.taksitlikredilistesi.index');
  Route::post('/store',[DocumentController::class,'taksitliKrediListesiStore'])
    ->name('castle.taksitlikredilistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.taksitlikredilistesi.download');
});

Route::group(['prefix' => '/panel/satis-fatura-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'satisFaturalariListesi'])
    ->name('castle.satisfaturalarilistesi.index');
  Route::post('/store',[DocumentController::class,'satisFaturalariListesiStore'])
    ->name('castle.satisfaturalarilistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.satisfaturalarilistesi.download');
});

Route::group(['prefix' => '/panel/satislarin-maliyet-calismasi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'satislarinMaliyetCalismasi'])
    ->name('castle.satislarinmaliyetcalismasi.index');
  Route::post('/store',[DocumentController::class,'satislarinMaliyetCalismasiStore'])
    ->name('castle.satislarinmaliyetcalismasi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.satislarinmaliyetcalismasi.download');
});


Route::group(['prefix' => '/panel/amortisman-calismasi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'amortismanlarinCalismasi'])
    ->name('castle.amortismanlarincalismasi.index');
  Route::post('/store',[DocumentController::class,'amortismanlarinCalismasiStore'])
    ->name('castle.amortismanlarincalismasi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.amortismanlarincalismasi.download');
});

Route::group(['prefix' => '/panel/personel-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'personelListesi'])
    ->name('castle.personellistesi.index');
  Route::post('/store',[DocumentController::class,'personelListesiStore'])
    ->name('castle.personellistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.personellistesi.download');
});

Route::group(['prefix' => '/panel/interaktif-alinan-arac-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'interaktiftenAlinanAracListesi'])
    ->name('castle.interaktiftenalinanaraclistesi.index');
  Route::post('/store',[DocumentController::class,'interaktiftenAlinanAracListesiStore'])
    ->name('castle.interaktiftenalinanaraclistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.interaktiftenalinanaraclistesi.download');
});

Route::group(['prefix' => '/panel/doviz-degerleme-tablolari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'dovizDegerlemeTablolari'])
    ->name('castle.dovizdegerlemetablolari.index');
  Route::post('/store',[DocumentController::class,'dovizDegerlemeTablolariStore'])
    ->name('castle.dovizdegerlemetablolari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.dovizdegerlemetablolari.download');
});

Route::group(['prefix' => '/panel/organizasyon-semasi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'organizasyonSemasi'])
    ->name('castle.organizasyonsemasi.index');
  Route::post('/store',[DocumentController::class,'organizasyonSemasiStore'])
    ->name('castle.organizasyonsemasi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.organizasyonsemasi.download');
});

Route::group(['prefix' => '/panel/cari-yil-guncel-mizani','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'cariYilGuncelMizani'])
    ->name('castle.cariyilguncelmizani.index');
  Route::post('/store',[DocumentController::class,'cariYilGuncelMizaniStore'])
    ->name('castle.cariyilguncelmizani.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.cariyilguncelmizani.download');
});

Route::group(['prefix' => '/panel/mdv-degerleme-calismalari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'mdvDegerlemeCalismalari'])
    ->name('castle.mdvdegerlemecalismalari.index');
  Route::post('/store',[DocumentController::class,'mdvDegerlemeCalismalariStore'])
    ->name('castle.mdvdegerlemecalismalari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.mdvdegerlemecalismalari.download');
});

Route::group(['prefix' => '/panel/mizan-kurumlar-vergisi-beyaname','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'mizanKurumlarVergisiBeyanamesi'])
    ->name('castle.mizankurumlarvergisibeyanamesi.index');
  Route::post('/store',[DocumentController::class,'mizanKurumlarVergisiBeyanamesiStore'])
    ->name('castle.mizankurumlarvergisibeyanamesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.mizankurumlarvergisibeyanamesi.download');
});

Route::group(['prefix' => '/panel/tapu-takyidat-yazisi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'tapuTakyidatYazisi'])
    ->name('castle.taputakyidatyazisi.index');
  Route::post('/store',[DocumentController::class,'tapuTakyidatYazisiStore'])
    ->name('castle.taputakyidatyazisi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.taputakyidatyazisi.download');
});

Route::group(['prefix' => '/panel/avukat-yazisi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'avukatYazisi'])
    ->name('castle.avukatyazisi.index');
  Route::post('/store',[DocumentController::class,'avukatYazisiStore'])
    ->name('castle.avukatyazisi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.avukatyazisi.download');
});

Route::group(['prefix' => '/panel/vergi-dairesi-borc-durumu','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'vergiDairesiBorcDurumu'])
    ->name('castle.vergidairesiborc.index');
  Route::post('/store',[DocumentController::class,'vergiDairesiBorcDurumuStore'])
    ->name('castle.vergidairesiborc.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.vergidairesiborc.download');
});

Route::group(['prefix' => '/panel/sgk-borc-durumu','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'sgkBorcDurumu'])
    ->name('castle.sgkborcdurumu.index');
  Route::post('/store',[DocumentController::class,'sgkBorcDurumuStore'])
    ->name('castle.sgkborcdurumu.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.sgkborcdurumu.download');
});
