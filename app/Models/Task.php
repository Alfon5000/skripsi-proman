<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['start_time' => 'datetime', 'end_time' => 'datetime'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', "%$search%");
        });

        $query->when($filters['project_id'] ?? false, function ($query, $projectId) {
            return $query->where('project_id', $projectId);
        });

        $query->when($filters['priority_id'] ?? false, function ($query, $priorityId) {
            return $query->where('priority_id', $priorityId);
        });

        $query->when($filters['status_id'] ?? false, function ($query, $statusId) {
            return $query->where('status_id', $statusId);
        });
    }

    public function scopeProjectId($query, $projectId)
    {
        return $query->where('project_id', $projectId);
    }

    public function scopeWorkerId($query, $workerId)
    {
        return $query->where('worker_id', $workerId);
    }

    public function scopeStatusId($query, $statusId)
    {
        return $query->where('status_id', $statusId);
    }

    public function scopeDone($query)
    {
        return $query->where('status_id', 4);
    }

    public function scopeUndone($query)
    {
        return $query->where('status_id', '!=', 4);
    }
}
