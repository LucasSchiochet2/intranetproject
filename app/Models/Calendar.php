<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\BelongsToTenant; // ocultado por solicitação

class Calendar extends Model
{
    use CrudTrait;
    use HasFactory;
    // use BelongsToTenant; // ocultado por solicitação

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'collaborator_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function collaborator()
    {
        return $this->belongsTo(Collaborators::class);
    }
}
