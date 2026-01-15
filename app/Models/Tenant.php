<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name', 'subdomain'];

    protected static function booted()
    {
        static::created(function ($tenant) {
        //     // Banners
        //     Banner::factory(3)->create(['tenant_id' => $tenant->id]);

        //     // News
        //     News::factory(5)->create(['tenant_id' => $tenant->id]);

        //     // Calendar
        //     Calendar::factory(5)->create(['tenant_id' => $tenant->id]);

        //     // Documents
        //     $categories = DocumentCategory::factory(3)->create(['tenant_id' => $tenant->id]);
        //     $categories->each(function ($category) use ($tenant) {
        //         Documents::factory(3)->create([
        //             'document_category_id' => $category->id,
        //             'tenant_id' => $tenant->id
        //         ]);
        //     });

        //     // Collaborators
        //     $collaborators = Collaborators::factory(10)->create([
        //         'tenant_id' => $tenant->id
        //     ]);

        //     // Dashboards
        //     $dashboards = Dashboard::factory(2)->create([
        //         'tenant_id' => $tenant->id
        //     ]);

        //     // Tasks
        //     foreach ($dashboards as $dashboard) {
        //         $dashboard->collaborators()->attach($collaborators->random(5));

        //         Task::factory(5)->create([
        //             'dashboard_id' => $dashboard->id,
        //             'collaborator_id_sender' => $collaborators->random()->id,
        //             'collaborator_id_receiver' => $collaborators->random()->id,
        //         ]);
        //     }

        //     // Menu Items
        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Início',
        //         'type' => 'internal_link',
        //         'link' => '/',
        //         'icon' => 'las la-home',
        //         'parent_id' => null,
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Notícias',
        //         'type' => 'internal_link',
        //         'link' => 'noticias',
        //         'icon' => 'las la-newspaper',
        //         'parent_id' => null,
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Calendário',
        //         'type' => 'internal_link',
        //         'link' => 'calendario',
        //         'icon' => 'las la-calendar',
        //         'parent_id' => null,
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Tarefas',
        //         'type' => 'internal_link',
        //         'link' => 'tarefas',
        //         'icon' => 'las la-tasks',
        //         'parent_id' => null,
        //     ]);

        //     $docs = MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Documentos',
        //         'type' => 'internal_link',
        //         'link' => '#',
        //         'icon' => 'las la-folder',
        //         'parent_id' => null,
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Políticas',
        //         'type' => 'internal_link',
        //         'icon' => 'las la-file-alt',
        //         'link' => 'documentos',
        //         'parent_id' => $docs->id,
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Manuais',
        //         'type' => 'internal_link',
        //         'icon' => 'las la-book',
        //         'link' => '#',
        //         'parent_id' => $docs->id,
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Ouvidoria',
        //         'type' => 'internal_link',
        //         'icon' => 'las la-comments',
        //         'link' => 'ouvidoria',
        //         'parent_id' => null,
        //     ]);

        //     // Last Access
        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Portal RH',
        //         'type' => 'internal_link',
        //         'link' => '#',
        //         'icon' => 'las la-users',
        //         'parent_id' => null,
        //         'menu_key' => 'fastaccess',
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Suporte TI',
        //         'type' => 'internal_link',
        //         'link' => '#',
        //         'icon' => 'las la-headset',
        //         'parent_id' => null,
        //         'menu_key' => 'fastaccess',
        //     ]);

        //     // Links
        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'Google',
        //         'type' => 'external_link',
        //         'link' => 'https://google.com',
        //         'icon' => 'lab la-google',
        //         'parent_id' => null,
        //         'menu_key' => 'links',
        //     ]);

        //     MenuItem::create([
        //         'tenant_id' => $tenant->id,
        //         'name' => 'LinkedIn',
        //         'type' => 'external_link',
        //         'link' => 'https://linkedin.com',
        //         'icon' => 'lab la-linkedin',
        //         'parent_id' => null,
        //         'menu_key' => 'links',
        //     ]);
        });
    }
}
