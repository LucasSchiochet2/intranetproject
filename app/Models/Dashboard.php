<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant; // ocultado por solicitação

class Dashboard extends Model
{
    use CrudTrait;
    use HasFactory;
    use BelongsToTenant; // ocultado por solicitação

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
