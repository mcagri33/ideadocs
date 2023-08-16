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
  Route::patch('/update-document-status/{document}', [DocumentController::class, 'updateStatus'])->name('update.document.status');

  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.file.download');

});


Route::group(['prefix' => '/panel/yonetim-kurulu-imzalari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'yonetimkuruluevraklari'])
    ->name('castle.yonetimkuruluimzalari.index');
  Route::post('/store',[DocumentController::class,'yonetimkuruluevraklaristore'])
    ->name('castle.yonetimkuruluimzalari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.yonetimkuruluimzalari.download');
});

Route::group(['prefix' => '/panel/tum-yil-muavin','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'tumyilmuavin'])
    ->name('castle.tumyilmuavin.index');
  Route::post('/store',[DocumentController::class,'tumyilmuavinstore'])
    ->name('castle.tumyilmuavin.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.tumyilmuavin.download');
});

Route::group(['prefix' => '/panel/alinan-verilen-cekler','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'alinanverilencekler'])
    ->name('castle.alinanverilencekler.index');
  Route::post('/store',[DocumentController::class,'alinanverilenceklerstore'])
    ->name('castle.alinanverilencekler.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.alinanverilencekler.download');
});

Route::group(['prefix' => '/panel/alinan-verilen-teminat-mektuplari-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'alinanverilenteminatmektuplarilistesi'])
    ->name('castle.alinanverilenteminatmektuplarilistesi.index');
  Route::post('/store',[DocumentController::class,'alinanverilenteminatmektuplarilistesistore'])
    ->name('castle.alinanverilenteminatmektuplarilistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.alinanverilenteminatmektuplarilistesi.download');
});

Route::group(['prefix' => '/panel/aktifler-uzerindeki-sigorta','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'aktifleruzerindekisigorta'])
    ->name('castle.aktifleruzerindekisigorta.index');
  Route::post('/store',[DocumentController::class,'aktifleruzerindekisigortastore'])
    ->name('castle.aktifleruzerindekisigorta.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.aktifleruzerindekisigorta.download');
});

Route::group(['prefix' => '/panel/kira-sozlesme','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'kirasozlesme'])
    ->name('castle.kirasozlesme.index');
  Route::post('/store',[DocumentController::class,'kirasozlesmestore'])
    ->name('castle.kirasozlesme.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.kirasozlesme.download');
});

Route::group(['prefix' => '/panel/kasa-sayim-tutanagi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'kasasayimtutanagi'])
    ->name('castle.kasasayimtutanagi.index');
  Route::post('/store',[DocumentController::class,'kasasayimtutanagistore'])
    ->name('castle.kasasayimtutanagi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.kasasayimtutanagi.download');
});

Route::group(['prefix' => '/panel/banka-mutabakatlari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'bankamutabakatlari'])
    ->name('castle.bankamutabakatlari.index');
  Route::post('/store',[DocumentController::class,'bankamutabakatlaristore'])
    ->name('castle.bankamutabakatlari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.bankamutabakatlari.download');
});

Route::group(['prefix' => '/panel/stok-sayim-tutanagi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'stoksayimtutanagi'])
    ->name('castle.stoksayimtutanagi.index');
  Route::post('/store',[DocumentController::class,'stoksayimtutanagistore'])
    ->name('castle.stoksayimtutanagi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.stoksayimtutanagi.download');
});

Route::group(['prefix' => '/panel/stok-miktar-dengesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'stokmiktardengesi'])
    ->name('castle.stokmiktardengesi.index');
  Route::post('/store',[DocumentController::class,'stokmiktardengesistore'])
    ->name('castle.stokmiktardengesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.stokmiktardengesi.download');
});

Route::group(['prefix' => '/panel/stok-tutar-dengesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'stoktutardengesi'])
    ->name('castle.stoktutardengesi.index');
  Route::post('/store',[DocumentController::class,'stoktutardengesistore'])
    ->name('castle.stoktutardengesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.stoktutardengesi.download');
});

Route::group(['prefix' => '/panel/supheli-alacaklar-icra-evraklari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'suphelialacaklar'])
    ->name('castle.suphelialacaklar.index');
  Route::post('/store',[DocumentController::class,'suphelialacaklarstore'])
    ->name('castle.suphelialacaklar.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.suphelialacaklar.download');
});

Route::group(['prefix' => '/panel/taksitli-kredi-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'taksitlikredilistesi'])
    ->name('castle.taksitlikredilistesi.index');
  Route::post('/store',[DocumentController::class,'taksitlikredilistesistore'])
    ->name('castle.taksitlikredilistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.taksitlikredilistesi.download');
});

Route::group(['prefix' => '/panel/satis-fatura-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'satisfaturalarilistesi'])
    ->name('castle.satisfaturalarilistesi.index');
  Route::post('/store',[DocumentController::class,'satisfaturalarilistesistore'])
    ->name('castle.satisfaturalarilistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.satisfaturalarilistesi.download');
});

Route::group(['prefix' => '/panel/satislarin-maliyet-calismasi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'satislarinmaliyetcalismasi'])
    ->name('castle.satislarinmaliyetcalismasi.index');
  Route::post('/store',[DocumentController::class,'satislarinmaliyetcalismasistore'])
    ->name('castle.satislarinmaliyetcalismasi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.satislarinmaliyetcalismasi.download');
});


Route::group(['prefix' => '/panel/amortisman-calismasi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'amortismanlarincalismasi'])
    ->name('castle.amortismanlarincalismasi.index');
  Route::post('/store',[DocumentController::class,'amortismanlarincalismasistore'])
    ->name('castle.amortismanlarincalismasi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.amortismanlarincalismasi.download');
});

Route::group(['prefix' => '/panel/personel-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'personellistesi'])
    ->name('castle.personellistesi.index');
  Route::post('/store',[DocumentController::class,'personellistesistore'])
    ->name('castle.personellistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.personellistesi.download');
});

Route::group(['prefix' => '/panel/interaktif-alinan-arac-listesi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'interaktiftenalinanaraclistesi'])
    ->name('castle.interaktiftenalinanaraclistesi.index');
  Route::post('/store',[DocumentController::class,'interaktiftenalinanaraclistesistore'])
    ->name('castle.interaktiftenalinanaraclistesi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.interaktiftenalinanaraclistesi.download');
});

Route::group(['prefix' => '/panel/doviz-degerleme-tablolari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'dovizdegerlemetablolari'])
    ->name('castle.dovizdegerlemetablolari.index');
  Route::post('/store',[DocumentController::class,'dovizdegerlemetablolaristore'])
    ->name('castle.dovizdegerlemetablolari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.dovizdegerlemetablolari.download');
});

Route::group(['prefix' => '/panel/organizasyon-semasi','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'organizasyonsemasi'])
    ->name('castle.organizasyonsemasi.index');
  Route::post('/store',[DocumentController::class,'organizasyonsemasistore'])
    ->name('castle.organizasyonsemasi.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.organizasyonsemasi.download');
});

Route::group(['prefix' => '/panel/cari-yil-guncel-mizani','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'cariyilguncelmizani'])
    ->name('castle.cariyilguncelmizani.index');
  Route::post('/store',[DocumentController::class,'cariyilguncelmizanistore'])
    ->name('castle.cariyilguncelmizani.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.cariyilguncelmizani.download');
});

Route::group(['prefix' => '/panel/mdv-degerleme-calismalari','middleware' => ['auth']], function () {
  Route::get('/', [DocumentController::class, 'mdvdegerlemecalismalari'])
    ->name('castle.mdvdegerlemecalismalari.index');
  Route::post('/store',[DocumentController::class,'mdvdegerlemecalismalaristore'])
    ->name('castle.mdvdegerlemecalismalari.store');
  Route::get('/{file}/download', [DocumentController::class, 'download'])->name('castle.mdvdegerlemecalismalari.download');
});
