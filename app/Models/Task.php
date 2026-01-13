<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $casts = [
        'attachment' => 'array',
        'is_completed' => 'boolean',
        'deadline' => 'datetime',
        'is_archived' => 'boolean',
    ];
    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'deadline',
        'collaborator_id_sender',
        'collaborator_id_receiver',
        'status',
        'tag',
        'attachment',
        'is_archived',
        'dashboard_id',
    ];

    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class);
    }

    public function sender()
    {
        return $this->belongsTo(Collaborators::class, 'collaborator_id_sender');
    }
    public function receiver()
    {
        return $this->belongsTo(Collaborators::class, 'collaborator_id_receiver');
    }

    public function checklistItems()
    {
        return $this->hasMany(TaskChecklistItem::class);
    }

    public function getAttachmentAttribute($value)
    {
        if (is_null($value)) return [];
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        return $value;
    }

    public function setAttachmentAttribute($value)
    {
        $attribute_name = "attachment";
        $disk = config('filesystems.default');
        $destination_path = "uploads/tasks";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
