<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $perPage = 9999;
    protected $casts = ['start_time' => 'datetime', 'end_time' => 'datetime'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }

    public function expenditures()
    {
        return $this->hasMany(Expenditure::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        });

        $query->when($filters['category_id'] ?? false, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        });
    }

    public function scopeIsMember($query)
    {
        $query->whereHas('members', function ($query) {
            return $query->where('member_id', auth()->id());
        });
    }

    public function scopeNotStarted($query)
    {
        return $query->where('start_time', '>', now());
    }

    public function scopeOnGoing($query)
    {
        return $query->where('start_time', '>=', now())->where('end_time', '<=', now());
    }

    public function scopeDone($query)
    {
        return $query->where('end_time', '<', now());
    }

    public function scopeUndone($query)
    {
        return $query->where('end_time', '>', now());
    }

    public function scopeCategoryId($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeManagerId($query, $managerId)
    {
        return $query->where('manager_id', $managerId);
    }
}
