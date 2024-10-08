<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $perPage = 9999;

    public function creater()
    {
        return $this->belongsTo(User::class, 'creater_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")->orWhereHas('creater', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        });

        $query->when($filters['department_id'] ?? false, function ($query, $departmentId) {
            return $query->where('department_id', $departmentId);
        });
    }

    public function scopeProjectId($query, $projectId)
    {
        return $query->where('project_id', $projectId);
    }

    public function scopeCreaterId($query, $createrId)
    {
        return $query->where('creater_id', $createrId);
    }

    public function scopeDepartmentId($query, $departmentId)
    {
        return $query->orWhere('department_id', $departmentId);
    }
}
