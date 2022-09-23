<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = new Tenant();
        $tenant->name = 'Tenant Lorem';
        $tenant->domain = 'tenantlorem';
        $tenant->location = 'Abuja';
        $tenant->created_by = 1;
        $tenant->save();

        $tenant = new Tenant();
        $tenant->name = 'Tenant Ipsum';
        $tenant->domain = 'tenantipsum';
        $tenant->location = 'Lagos';
        $tenant->created_by = 1;
        $tenant->save();

        $tenant = new Tenant();
        $tenant->name = 'Tenant Acedet';
        $tenant->domain = 'tenantacedet';
        $tenant->location = 'Lagos';
        $tenant->created_by = 1;
        $tenant->save();
    }
}
