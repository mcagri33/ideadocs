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
       Role::create(['name' => 'Admin']);
       Role::create(['name' => 'Customer']);

      // İzinlerin tanımlanması
      /*$uploadEvrakPermission = Permission::create(['name' => 'evrak_yükleme']);
      $viewAllEvrakPermission = Permission::create(['name' => 'tüm_evrakları_görüntüleme']);

      $adminRole->givePermissionTo($viewAllEvrakPermission);

      $musteriRole->givePermissionTo($uploadEvrakPermission);*/

    }
}
