<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;
class Message extends Model
{
    use CrudTrait;
    use BelongsToTenant;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_read',
        'tenant_id',
    ];

    public function collaborators()
    {
        return $this->belongsToMany(Collaborators::class, 'message_collaborators', 'message_id', 'collaborator_id')
                    ->withPivot(['is_read', 'read_at'])
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
