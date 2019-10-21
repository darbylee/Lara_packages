<?php

namespace Pdusan\SimpleBlog\Models;

use Illuminate\Database\Eloquent\Model;

class SBlogCategory extends Model
{
    public $table = 'category';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function posts()
    {
        return $this->hasMany('Pdusan\SimpleBlog\Models\Posts');
    }

}