<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;
use Illuminate\Support\Facades\Auth;

class ChMessage extends Model
{
    use UUID;

    protected $guarded = ['id'];
    // protected $with = ['fromUser', 'toUser'];

    public function scopeToAuth($query)
    {
        return $query->where('to_id', Auth::id());
    }
    public function scopeFromAuth($query)
    {
        return $query->where('from_id', Auth::id());
    }
    public function scopeUnseen($query)
    {
        return $query->where('seen', 0);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
