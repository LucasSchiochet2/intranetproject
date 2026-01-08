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
        'birth_date',
        'url_photo',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    public function setUrlPhotoAttribute($value)
    {
        $attribute_name = "url_photo";
        // Usa o disco padrão definido no .env (FILESYSTEM_DISK).
        // Em dev pode ser 'public', em prod pode ser 's3' ou 'r2'.
        $disk = config('filesystems.default');
        $destination_path = "uploads/collaborators";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
    public function sentTasks()
    {
        return $this->hasMany(Task::class, 'collaborator_id_sender');
    }
    
    public function receivedTasks()
    {
        return $this->hasMany(Task::class, 'collaborator_id_receiver');
    }
}
