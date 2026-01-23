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
            // Banners
            Banner::create([
                'tenant_id' => $tenant->id,
                'title' => 'Bem-vindo à Intranet',
                'subtitle' => 'Sua central de informações',
                'image_path' => '',
                'link' => '#',
            ]);

            Banner::create([
                'tenant_id' => $tenant->id,
                'title' => 'Novidades do mês',
                'subtitle' => 'Confira as atualizações recentes',
                'image_path' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
                'link' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
            ]);

            Banner::create([
                'tenant_id' => $tenant->id,
                'title' => 'Eventos em destaque',
                'subtitle' => 'Participe dos próximos eventos',
                'image_path' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca',
                'link' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca',
            ]);

            Banner::create([
                'tenant_id' => $tenant->id,
                'title' => 'Documentos importantes',
                'subtitle' => 'Acesse os arquivos essenciais',
                'image_path' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308',
                'link' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308',
            ]);


            // Menu Items
            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Início',
                'type' => 'internal_link',
                'link' => '/',
                'icon' => 'las la-home',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Notícias',
                'type' => 'internal_link',
                'link' => 'noticias',
                'icon' => 'las la-newspaper',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Calendário',
                'type' => 'internal_link',
                'link' => 'calendario',
                'icon' => 'las la-calendar',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Tarefas',
                'type' => 'internal_link',
                'link' => 'tarefas',
                'icon' => 'las la-tasks',
                'parent_id' => null,
            ]);

            $docs = MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Documentos',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-folder',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Políticas',
                'type' => 'internal_link',
                'icon' => 'las la-file-alt',
                'link' => 'documentos',
                'parent_id' => $docs->id,
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Manuais',
                'type' => 'internal_link',
                'icon' => 'las la-book',
                'link' => '#',
                'parent_id' => $docs->id,
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Ouvidoria',
                'type' => 'internal_link',
                'icon' => 'las la-comments',
                'link' => 'ouvidoria',
                'parent_id' => null,
            ]);

            // Last Access
            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Portal RH',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-users',
                'parent_id' => null,
                'menu_key' => 'fastaccess',
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Suporte TI',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-headset',
                'parent_id' => null,
                'menu_key' => 'fastaccess',
            ]);

            // Links
            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'Google',
                'type' => 'external_link',
                'link' => 'https://google.com',
                'icon' => 'lab la-google',
                'parent_id' => null,
                'menu_key' => 'links',
            ]);

            MenuItem::create([
                'tenant_id' => $tenant->id,
                'name' => 'LinkedIn',
                'type' => 'external_link',
                'link' => 'https://linkedin.com',
                'icon' => 'lab la-linkedin',
                'parent_id' => null,
                'menu_key' => 'links',
            ]);
        });
    }
}
