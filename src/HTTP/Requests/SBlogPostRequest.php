<?php

namespace Pdusan\SimpleBlog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

use Pdusan\SimpleBlog\Models\SBlogPost;


class SBlogPostRequest extends FormRequest
{
    protected $action;

    public function __construct(Request $request, Factory $factory)
    {
        parent::__construct();
        $this->action = !empty($request->route()->getName()) ? $request->route()->getName() : '';
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if (!empty($this->action)) {
            switch ($this->action) {
                case 'sblog.post.add':
                case 'sblog.post.store':
                    return auth()->check();
                case 'sblog.post.edit':
                case 'sblog.post.update':
                    return auth()->check() &&  auth()->user()->can('update', SBlogPost::find($this->route('id')));
                case 'sblog.post.delete':
                    return auth()->check() &&  auth()->user()->can('delete', SBlogPost::find($this->route('id')));
                case 'sblog.post.index':
                case 'sblog.post.show':
                    return true;
                default:
                    return true;
            }
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!empty($this->action) && ($this->action == 'sblog.post.store' || $this->action == 'sblog.post.update')) {
            $rules['title'] = ['required', 'string', 'max:191'];
            $rules['body'] = ['required', 'string'];
            $rules['category_id'] = ['required', 'numeric'];
            $rules['tags'] = ['nullable', 'string'];
            return $rules;
        } else {
            return [];
        }
    }

    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['title'] = 'Title';
        $attributes['body'] = 'Detail';
        $attributes['category_id'] = 'Category';
        $attributes['tags'] = 'Tags';
        return $attributes;
    }

}
