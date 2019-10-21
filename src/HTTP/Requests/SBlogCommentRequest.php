<?php

namespace Pdusan\SimpleBlog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

use Pdusan\SimpleBlog\Models\SBlogPost;
use Pdusan\SimpleBlog\Models\SBlogComment;

class SBlogCommentRequest extends FormRequest
{
    protected $action;

    public function __construct(Request $request, Factory $factory)
    {
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
                case 'sblog.comment.store':
                    return auth()->check() &&  auth()->user()->can('canCreateComment', SBlogPost::find($this->route('post_id')));
                case 'sblog.comment.delete':
                    return auth()->check() &&  auth()->user()->can('delete', SBlogComment::find($this->route('id')));
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
        if (!empty($this->action) && ($this->action == 'sblog.comment.store' || $this->action == 'sblog.post.update')) {
            $rules['title'] = ['required', 'string', 'max:191'];
            $rules['body'] = ['required', 'string'];
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
        return $attributes;
    }

}
