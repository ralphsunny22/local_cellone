<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = new Site();
        $site->name = 'Site Lorem';
        $site->tenant_id = 1;
        $site->location = 'Abuja';
        $site->created_by = 1;
        $site->save();

        $site = new Site();
        $site->name = 'Site Ipsum';
        $site->tenant_id = 2;
        $site->location = 'Lagos';
        $site->created_by = 1;
        $site->save();

        $site = new Site();
        $site->name = 'Site Acedet';
        $site->tenant_id = 2;
        $site->location = 'Lagos';
        $site->created_by = 1;
        $site->save();
  
    }
}
