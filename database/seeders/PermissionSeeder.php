<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'name'=>'dashboard',
                'guard_name'=>'web'
            ],
//            product
            [
                'name'=>'product-list',
                'guard_name'=>'web'
            ],
            [
                'name'=>'product-add',
                'guard_name'=>'web'
            ],
            [
                'name'=>'product-edit',
                'guard_name'=>'web'
            ],
            [
                'name'=>'product-delete',
                'guard_name'=>'web'
            ],
//            category

        ]);
    }
}
