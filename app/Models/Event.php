<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function scopeSearch($query, string $search)
    {
        $query->when($search ?? false, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                ->orWhere('start_time', 'like', "%$search%")
                ->orWhere('end_time', 'like', "%$search%");
        });
    }

    public function scopeOwnerId($query, int $id)
    {
        return $query->where('owner_id', $id);
    }

    public function scopeNotStarted($query)
    {
        return $query->where('start_time', '>', now());
    }

    public function scopeOnGoing($query)
    {
        return $query->where('start_time', '<=', now())->where('end_time', '>=', now());
    }

    public function scopeDone($query)
    {
        return $query->where('end_time', '<', now());
    }

    public function scopeUndone($query)
    {
        return $query->where('end_time', '>', now());
    }
}
