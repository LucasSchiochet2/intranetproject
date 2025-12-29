<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collaborators extends Authenticatable
{
    use CrudTrait;
    use HasFactory, Notifiable;
    
    protected $table = 'collaborators';

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'department',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
