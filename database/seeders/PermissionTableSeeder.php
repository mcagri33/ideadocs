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
        'rol-list',
        'role-create',
        'role-edit',
        'role-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',
        'son-yuklenen-evraklar-list',
        'musteri-bazli-evrak-list',
        'yonetim-kurulu-imzaları-list',
        'yonetim-kurulu-imzaları-create',
        'tum-yil-muavinleri-list',
        'tum-yil-muavinleri-create',
        'alinan-verilen-cekler-list',
        'alinan-verilen-cekler-create',
        'alinan-verilen-teminat-list',
        'alinan-verilen-teminat-create',
        'aktif-uzerindeki-sigorta-teminat-list',
        'aktif-uzerindeki-sigorta-teminat-create',
        'kira-sozlesmeleri-list',
        'kira-sozlesmeleri-create',
        'kasa-sayim-tutanagi-list',
        'kasa-sayim-tutanagi-create',
        'banka-mutabakat-list',
        'banka-mutabakat-create',
        'stok-sayim-tutanagi-list',
        'stok-sayim-tutanagi-create',
        'stok-miktar-dengesi-list',
        'stok-miktar-dengesi-create',
        'stok-tutar-dengesi-list',
        'stok-tutar-dengesi-create',
        'supheli-alacaklar-icra-evraklari-list',
        'supheli-alacaklar-icra-evraklari-create',
        'taksitli-kredi-listesi-list',
        'taksitli-kredi-listesi-create',
        'satis-fatura-listesi-list',
        'satis-fatura-listesi-create',
        'satislarin-maliyet-calismasi-list',
        'satislarin-maliyet-calismasi-create',
        'amortisman-calismasi-list',
        'amortisman-calismasi-create',
        'personel-listesi-list',
        'personel-listesi-create',
        'interaktif-alinan-arac-listesi-list',
        'interaktif-alinan-arac-listesi-create',
        'doviz-degerleme-tablolari-list',
        'doviz-degerleme-tablolari-create',
        'organizasyon-semasi-list',
        'organizasyon-semasi-create',
        'cari-yil-guncel-mizani-list',
        'cari-yil-guncel-mizani-create',
        'mdv-degerleme-calismalari-list',
        'mdv-degerleme-calismalari-create',

      ];

      foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
      }
    }
}
