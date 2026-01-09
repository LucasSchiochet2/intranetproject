<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class Dashboard extends Model
{
    use CrudTrait;
    use BelongsToTenant;

    protected $fillable = [
        'name',
        'description',
        'tenant_id',
    ];

    public function collaborators()
    {
        return $this->belongsToMany(Collaborators::class, 'collaborator_dashboard', 'dashboard_id', 'collaborator_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
