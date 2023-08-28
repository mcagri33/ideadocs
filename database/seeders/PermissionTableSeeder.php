<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $permissions = [
      'user',
      'roles',
      'tum-evraklar',
      'yonetim-kurulu-imzaları',
      'tum-yil-muavinleri',
      'alinan-verilen-cekler',
      'alinan-verilen-teminat',
      'aktif-uzerindeki-sigorta-teminat',
      'kira-sozlesmeleri',
      'kasa-sayim-tutanagi',
      'banka-mutabakat',
      'stok-sayim-tutanagi',
      'stok-miktar-dengesi',
      'stok-tutar-dengesi',
      'supheli-alacaklar-icra-evraklari',
      'taksitli-kredi-listesi',
      'satis-fatura-listesi',
      'satislarin-maliyet-calismasi',
      'amortisman-calismasi',
      'personel-listesi',
      'interaktif-alinan-arac-listesi',
      'doviz-degerleme-tablolari',
      'organizasyon-semasi',
      'cari-yil-guncel-mizani',
      'mdv-degerleme-calismalari',
      'avukat-yazisi',
      'tapu-takyidat-yazisi',
      'mizan-kurumlar-vergisi-beyaname',
      'vergi-dairesi-borc-durumu',
      'sgk-borc-durumu',
    ];

    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }
  }
}
