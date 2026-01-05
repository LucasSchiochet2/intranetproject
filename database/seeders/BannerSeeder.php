<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'id' => 1,
                'title' => "Bem-vindo à Intranet",
                'image_url' => "https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80",
                'link_url' => "#",
                'description' => "Fique por dentro de todas as novidades da empresa.",
                'is_active' => true,
                'display_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => "Novos Benefícios",
                'image_url' => "https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1200&q=80",
                'link_url' => "/beneficios",
                'description' => "Confira a nova lista de benefícios para colaboradores.",
                'is_active' => true,
                'display_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => "Evento de Final de Ano",
                'image_url' => "https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=1200&q=80",
                'link_url' => "/eventos",
                'description' => "Não perca nossa festa de confraternização!",
                'is_active' => true,
                'display_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($banners as $banner) {
            DB::table('banners')->updateOrInsert(['id' => $banner['id']], $banner);
        }
    }
}
