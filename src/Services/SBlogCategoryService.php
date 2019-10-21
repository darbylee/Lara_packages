<?php
namespace Pdusan\SimpleBlog\Services;

use Pdusan\SimpleBlog\Models\SBlogCategory;

class SBlogCategoryService {

    public static function getAllCategory() {
        $data = SBlogCategory::orderBy('id', 'ASC')
            ->get();
        return $data;
    }

}