<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'banners';
    use \App\Traits\BelongsToTenant; // ocultado por solicitação
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'link_url',
        'is_active',
        'display_order',
        'tenant_id',
    ];

    public function setImageUrlAttribute($value)
    {
        $attribute_name = "image_url";

        // If the value is a URL (like from a factory), just save it.
        if (filter_var($value, FILTER_VALIDATE_URL)) {
             $this->attributes[$attribute_name] = $value;
             return;
        }

        // Usa o disco padrão definido no .env (FILESYSTEM_DISK).
        // Em dev pode ser 'public', em prod pode ser 's3' ou 'r2'.
        $disk = config('filesystems.default');
        $destination_path = "uploads/banners";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
