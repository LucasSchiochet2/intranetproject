<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['document_category_id', 'title', 'description', 'files'];

    protected $casts = [
        'files' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }

    public function setFilesAttribute($value)
    {
        $attribute_name = "files";
        $disk = config('filesystems.default');
        $destination_path = "uploads/documents";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
