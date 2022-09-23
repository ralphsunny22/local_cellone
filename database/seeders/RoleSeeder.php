<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Manager';
        $role->tenant_id = 1;
        $role->slug = Str::slug('Manager-1');
        $role->created_by = 1;
        $role->save();

        $role = new Role();
        $role->name = 'Assistant';
        $role->tenant_id = 1;
        $role->slug = Str::slug('Assistant-1');
        $role->created_by = 1;
        $role->save();

        $role = new Role();
        $role->name = 'Developer';
        $role->tenant_id = 2;
        $role->slug = Str::slug('Developer-2');
        $role->created_by = 1;
        $role->save();

        $role = new Role();
        $role->name = 'Assistant';
        $role->tenant_id = 2;
        $role->slug = Str::slug('Assistant-2');
        $role->created_by = 1;
        $role->save();

        $role = new Role();
        $role->name = 'Manager';
        $role->tenant_id = 2;
        $role->slug = Str::slug('Manager-2');
        $role->created_by = 1;
        $role->save();

    }
}
