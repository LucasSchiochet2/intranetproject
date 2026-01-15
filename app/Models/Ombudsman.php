<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
// use App\Traits\BelongsToTenant; // ocultado por solicitação

class Ombudsman extends Model
{
    use CrudTrait;
    use HasFactory;
    // use BelongsToTenant; // ocultado por solicitação

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'type',
        'subject',
        'message',
        'status',
        'admin_notes',
        'attachment',
        'admin_attachment',
        'response_token',
        'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->response_token)) {
                $model->response_token = Str::upper(Str::random(12));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setAttachmentAttribute($value)
    {
        $attribute_name = "attachment";
        // Usa o disco padrão definido no .env (FILESYSTEM_DISK).
        // Em dev pode ser 'public', em prod pode ser 's3' ou 'r2'.
        $disk = config('filesystems.default');
        $destination_path = "uploads/ombudsman";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
    public function setAdminAttachmentAttribute($value)
    {
        $attribute_name = "admin_attachment";
        // Usa o disco padrão definido no .env (FILESYSTEM_DISK).
        // Em dev pode ser 'public', em prod pode ser 's3' ou 'r2'.
        $disk = config('filesystems.default');
        $destination_path = "uploads/ombudsman";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
