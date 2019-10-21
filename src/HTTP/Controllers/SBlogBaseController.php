<?php

namespace Pdusan\SimpleBlog\Http\Controllers;

use Illuminate\Routing\Controller;

class SBlogBaseController extends Controller
{

    protected $view_prefix;
    protected  $per_page = 10;

    public function __construct()
    {
        $this->view_prefix = config('sblog.view_namespace') . '::';
    }
}
