<?php
namespace Pdusan\SimpleBlog\Services;

use Pdusan\SimpleBlog\Models\SBlogComment;

class SBlogCommentService {

    public static function getAlComment() {
        $data = SBlogComment::orderBy('id', 'ASC')
            ->get();
        return $data;
    }

}