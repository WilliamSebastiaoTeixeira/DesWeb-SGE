<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'empresa_access',
            ],
            [
                'id'    => 2,
                'title' => 'pessoa_access',
            ]
        ];

        Permission::insert($permissions);
    }
}
