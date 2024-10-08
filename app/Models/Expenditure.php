<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $perPage = 9999;
    protected $casts = ['date' => 'datetime'];

    public function scopeFilter($query, string $filter)
    {
        $query->when($filter ?? false, function ($query, $filter) {
            return $query->where('title', 'like', "%$filter%")->orWhereHas('uploader', function ($query) use ($filter) {
                $query->where('name', 'like', "%$filter%");
            });
        });
    }

    public function scopeProjectId($query, $projectId)
    {
        return $query->where('project_id', $projectId);
    }

    public function scopeUploaderId($query, $uploaderId)
    {
        return $query->where('uploader_id', $uploaderId);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }
}
