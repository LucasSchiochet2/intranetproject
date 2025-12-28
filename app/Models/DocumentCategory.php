<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class DocumentCategory extends Model
{
    use CrudTrait;
    use HasFactory;
    use BelongsToTenant;

    protected $fillable = ['name', 'slug'];

    public function documents()
    {
        return $this->hasMany(Documents::class, 'document_category_id');
    }
}
