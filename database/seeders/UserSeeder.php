<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'SuperAdmin Cellone';
        $user->email = 'super@super.com';
        $user->password = Hash::make('password');
        $user->isSuperAdmin = true;
        $user->status = 'true';
        $user->save();

        $user = new User();
        $user->name = 'Admin Cellone';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('password');
        $user->tenant_id = 1;
        $user->created_by = 1;
        $user->save();

        $user = new User();
        $user->name = 'User Cellone';
        $user->email = 'user@user.com';
        $user->password = Hash::make('password');
        $user->tenant_id = 1;
        $user->created_by = 1;
        $user->save();
    }

    
}
