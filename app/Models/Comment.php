<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function commenter()
    {
        return $this->belongsTo(User::class, 'commenter_id');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function scopeFilter($query, $search)
    {
        return $query->where('body', 'like', "%$search%")->orWhereHas('commenter', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });
    }

    public function scopeDiscussionId($query, $discussionId)
    {
        return $query->where('discussion_id', $discussionId);
    }

    public function scopeCommenterId($query, $commenterId)
    {
        return $query->where('commenter_id', $commenterId);
    }
}
