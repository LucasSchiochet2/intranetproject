<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Services\TenantManager;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $tenantId = app(TenantManager::class)->getTenantId();

        // \Log::info("TenantScope applied on " . get_class($model) . ". TenantID: " . ($tenantId ?? 'NULL'));

        if ($tenantId) {
            // We are in a Tenant
            if ($model instanceof \App\Models\User) {
                // Allow tenant users AND global users (so global admin can login)
                $builder->where(function($query) use ($model, $tenantId) {
                    $query->where($model->getTable() . '.tenant_id', $tenantId)
                          ->orWhereNull($model->getTable() . '.tenant_id');
                });
            } else {
                // For all other content, enforce strict tenant isolation
                $builder->where($model->getTable() . '.tenant_id', $tenantId);
            }
        } else {
            // We are in the Main Domain
            
            // Only restrict Users to Global Users (prevent Tenant Users from logging in)
            if ($model instanceof \App\Models\User) {
                $builder->whereNull($model->getTable() . '.tenant_id');
            }
            // If we are NOT in the admin panel (e.g. API or Public Site), restrict content to Global only
            elseif (!request()->is('admin/*') && !app()->runningInConsole()) {
                 $builder->whereNull($model->getTable() . '.tenant_id');
            }
        }
    }
}
