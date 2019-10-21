<?php

namespace Pdusan\SimpleBlog\Models;

use Illuminate\Database\Eloquent\Model;

class SBlogComment extends Model
{
    public $table = 'comments';

    public $timestamps = true;

    protected $fillable = [
        'body',
        'post_id',
        'user_id',
    ];

    public function post()
    {
        return $this->belongsTo('Pdusan\SimpleBlog\Models\SBlogPost');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}