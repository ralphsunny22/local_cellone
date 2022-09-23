<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = 'Site';
        $permission->slug = Str::slug('Site');
        $permission->created_by = 1;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'User';
        $permission->slug = Str::slug('User');
        $permission->created_by = 1;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Create Site';
        $permission->slug = Str::slug('Create Site');
        $permission->parent_id = '1';
        $permission->created_by = 1;
        $permission->save();


        $permission = new Permission();
        $permission->name = 'Edit Site';
        $permission->slug = Str::slug('Edit Site');
        $permission->parent_id = '1';
        $permission->created_by = 1;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'View Site';
        $permission->slug = Str::slug('View Site');
        $permission->parent_id = '1';
        $permission->created_by = 1;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Delete Site';
        $permission->slug = Str::slug('Delete Site');
        $permission->parent_id = '1';
        $permission->created_by = 1;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Assign Site';
        $permission->slug = Str::slug('Assign Site');
        $permission->parent_id = '1';
        $permission->created_by = '1';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Create User';
        $permission->slug = Str::slug('Create User');
        $permission->parent_id = '2';
        $permission->created_by = '1';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Edit User';
        $permission->slug = Str::slug('Edit User');
        $permission->parent_id = '2';
        $permission->created_by = '1';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Delete User';
        $permission->slug = Str::slug('Delete User');
        $permission->parent_id = '2';
        $permission->created_by = '1';
        $permission->save();
    }
}
