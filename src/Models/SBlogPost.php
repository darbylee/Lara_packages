<?php

namespace Pdusan\SimpleBlog\Models;

use Illuminate\Database\Eloquent\Model;

class SBlogPost extends Model
{
    public $table = 'posts';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
        'tags',
        'status',
    ];

    public function comments()
    {
        return $this->hasMany('Pdusan\SimpleBlog\Models\SBlogComment', 'post_id');
    }

    public function category()
    {
        return $this->belongsTo('Pdusan\SimpleBlog\Models\SBlogCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}