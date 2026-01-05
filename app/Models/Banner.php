<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use CrudTrait;
    protected $table = 'banners';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'link_url',
        'is_active',
        'display_order',
    ];

    public function setImageUrlAttribute($value)
   {
        $attribute_name = "image_url";
        // Usa o disco padrão definido no .env (FILESYSTEM_DISK).
        // Em dev pode ser 'public', em prod pode ser 's3' ou 'r2'.
        $disk = config('filesystems.default');
        $destination_path = "uploads/banners";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
