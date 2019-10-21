<?php

namespace Pdusan\SimpleBlog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pdusan\SimpleBlog\Http\Requests\SBlogPostRequest;
use Pdusan\SimpleBlog\Models\SBlogPost;

use Pdusan\SimpleBlog\Services\SBlogCategoryService;

class SBlogPostController extends SBlogBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }

    public function index(SBlogPostRequest $request)
    {
        $posts = SBlogPost::with('user')->paginate($this->per_page);
        return view("{$this->view_prefix}posts.index", ['posts'=>$posts]);
    }

    public function create(SBlogPostRequest $request)
    {
        $categories = SBlogCategoryService::getAllCategory();
        return view("{$this->view_prefix}posts.create", ['categories'=>$categories]);
    }

    public function store(SBlogPostRequest $request)
    {
        $validateMesaages = [];
        $post_model = new SBlogPost();
        $post_model->fill($request->except(['body']));
        $post_model->body = filter_var($request->input("body"), FILTER_SANITIZE_STRING);
        $post_model->user_id = Auth::user()->id;
        if($post_model->save()) {
            $request->session()->flash('success', 'Post has been created successfully');
            return redirect()->route('sblog.post.index');
        }
        return redirect()->back()->withErrors($validateMesaages)->withInput($request->all());
    }

    public function edit(SBlogPostRequest $request, $id)
    {
        $categories = SBlogCategoryService::getAllCategory();
        $post = SBlogPost::find($id);
        return view("{$this->view_prefix}posts.edit", ['post'=>$post, 'categories'=>$categories]);
    }

    public function update(SBlogPostRequest $request, SBlogPost $post)
    {
        $validateMesaages = [];
        $post->fill($request->except(['body']));
        $post->body = filter_var($request->input("body"), FILTER_SANITIZE_STRING);
        $post->user_id = Auth::user()->id;
        if($post->save()) {
            $request->session()->flash('success', 'Post has been created successfully');
            return redirect()->route('sblog.post.index');
        } else {
            return redirect()->back()->withErrors($validateMesaages)->withInput($request->all());
        }
    }

    public function show(SBlogPostRequest $request, $id)
    {
        $categories = SBlogCategoryService::getAllCategory();
        $post = SBlogPost::with('comments')->find($id);
        return view("{$this->view_prefix}posts.show", ['post'=>$post, 'categories'=>$categories]);
    }

    public function destroy(SBlogPostRequest $request, SBlogPost $post)
    {
        if ($post->delete()) {
            $request->session()->flash('success', 'Post has been deleted successfully');
        } else {
            $request->session()->flash('fail', 'Some error occurred while deleting Post');
        }
        return redirect()->route('sblog.post.index');
    }
}
