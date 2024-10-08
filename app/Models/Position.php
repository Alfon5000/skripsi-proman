<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $perPage = 9999;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeSearch($query, string $search)
    {
        $query->when($search ?? false, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        });
    }
}
