<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $adminRole = Role::create(['name' => 'Admin']);
      $musteriRole = Role::create(['name' => 'Müşteri']);

      // İzinlerin tanımlanması
      $uploadEvrakPermission = Permission::create(['name' => 'evrak yükleme']);
      $viewAllEvrakPermission = Permission::create(['name' => 'tüm evrakları görüntüleme']);

      // Admin rolüne tüm evrakları görüntüleme iznini verelim
      $adminRole->givePermissionTo($viewAllEvrakPermission);

      // Müşteri rolüne evrak yükleme iznini verelim
      $musteriRole->givePermissionTo($uploadEvrakPermission);

      // Tüm müşterilere özel izinleri eklemek için buraya ekleyebilirsin.

      // Evraklar tablosuna role_id'leri ekleyelim
      $evraklar = Evraklar::all();
      foreach ($evraklar as $evrak) {
        if ($evrak->user->isAdmin()) {
          $evrak->assignRole('Admin');
        } else {
          $evrak->assignRole('Müşteri');
        }
      }
    }
}
