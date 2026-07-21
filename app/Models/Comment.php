<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'forum_id',
        'author',
        'comment',
        'user_id'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}