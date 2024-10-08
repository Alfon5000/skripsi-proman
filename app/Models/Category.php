<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $perPage = 9999;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function scopeSearch($query, string $search)
    {
        $query->when($search ?? false, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        });
    }
}
