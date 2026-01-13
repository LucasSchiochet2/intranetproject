<?php

namespace Database\Seeders;

use App\Models\Collaborators;
use App\Models\Dashboard;
use App\Models\Task;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CollaboratorTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a central tenant for these records to ensure they are related
        $tenant = Tenant::first() ?? Tenant::factory()->create([
            'name' => 'Primary Tenant',
            'subdomain' => 'primary'
        ]);

        // Create Collaborators for this tenant
        $collaborators = Collaborators::factory(10)->create([
            'tenant_id' => $tenant->id
        ]);

        // Create Dashboard for this tenant
        $dashboards = Dashboard::factory(2)->create([
            'tenant_id' => $tenant->id
        ]);

        // Attach collaborators to dashboards
        foreach ($dashboards as $dashboard) {
            $dashboard->collaborators()->attach($collaborators->random(5));

            // Create Tasks for this dashboard
            Task::factory(10)->create([
                'dashboard_id' => $dashboard->id,
                'collaborator_id_sender' => $collaborators->random()->id,
                'collaborator_id_receiver' => $collaborators->random()->id,
            ]);
        }
    }
}
