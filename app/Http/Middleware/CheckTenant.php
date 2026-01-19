<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Tenant;
use App\Services\TenantManager;

class CheckTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $parts = explode('.', $host);
        
        if (count($parts) > 0) {
            $subdomain = $parts[0];
            
            $tenant = Tenant::where('subdomain', $subdomain)->first();
            
            if ($tenant) {
                \Log::info("Tenant found: " . $tenant->name);
                app(TenantManager::class)->setTenant($tenant);
                
                // Optional: Share tenant with all views
                view()->share('tenant', $tenant);
            } else {
                \Log::info("Tenant not found for subdomain: " . $subdomain);
            }
        } else {
            \Log::info("No subdomain found in host: " . $host);
        }

        return $next($request);
    }
}
