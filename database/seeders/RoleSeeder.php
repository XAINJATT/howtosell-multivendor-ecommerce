<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name'=>'Admin',
                'guard_name'=>'web'
            ],[
                'name'=>'Vendor',
                'guard_name'=>'web'
            ],[
                'name'=>'Customer',
                'guard_name'=>'web'
            ]
        ]);
    }
}
