<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tenants = App\Models\Tenant::all();
echo "Tenants count: " . $tenants->count() . "\n";
foreach ($tenants as $tenant) {
    echo "ID: {$tenant->id}, Name: {$tenant->name}, Subdomain: {$tenant->subdomain}\n";
}
