<?php
namespace Pdusan\SimpleBlog\Services;

use Pdusan\SimpleBlog\Models\SBlogPost;

class SBlogPostService {

    public static function getAllPost() {
        $data = SBlogPost::orderBy('id', 'ASC')
            ->get();
        return $data;
    }

}