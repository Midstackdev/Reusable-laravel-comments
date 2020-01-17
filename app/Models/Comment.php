<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'body'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function children()
    {
    	return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function commentable()
    {
    	$this->morphTo();
    }
}
