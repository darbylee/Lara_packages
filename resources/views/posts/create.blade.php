@extends(config('sblog.config_namespace') . '::layouts.sblog', ['title'=>"Create New Post"])

@section('content')
    <div class="section">
        <form id="frm_new_post" action="{{ route(config('sblog.route_name_prefix') . '.post.store') }}" method="POST">
            @csrf
            <div class="field">
                <div class="control">
                    <label class="string optional label" for="title">Title</label>
                    <input class="string optional input" type="text" name="title" id="title" value="{{ old('title') }}">
                    @error('title')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <label class="text optional label" for="category_id">Category</label>
                    <div class="select">
                        <select id="category_id" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }} ">{{ $category['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <label class="string optional label" for="body">Detail</label>
                    <textarea class="text optional textarea" name="body" id="body" value="{{ old('body') }}"></textarea>
                    @error('body')
                     <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <label class="string optional label" for="tags">Tags</label>
                    <input class="string optional input" type="text" name="tags" id="tags" value="{{ old('tags') }}">
                    @error('tags')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <input type="submit" name="commit" value="Create Post" class="btn button is-primary" data-disable-with="Create Post">
        </form>
    </div>
  @endsection