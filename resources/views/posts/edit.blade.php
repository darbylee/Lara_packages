@extends(config('sblog.config_namespace') . '::layouts.sblog', ['title'=>"Update " . $post->title])

@section('content')
    <div class="section">
        <form id="frm_new_post" action="{{ route(config('sblog.route_name_prefix') . '.post.update', ['id'=>$post->id]) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="field">
                <div class="control">
                    <label class="string optional label" for="title">Title</label>
                    <input class="string optional input" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
                    @error('title')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <label class="text optional label" for="body">Category</label>
                    <div class="select">
                        <select  id="category_id" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}" {{ old('category_id', $post->category_id) == $category['id'] ? "selected" : "" }} >{{ $category['title'] }}</option>
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
                    <label class="text optional label" for="body">Detail</label>
                    <textarea class="text optional textarea" name="body" id="body">{{ old('body', $post->body) }}</textarea>
                    @error('body')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <label class="string optional label" for="tags">Tags</label>
                    <input class="string optional input" type="text" name="tags" id="tags" value="{{ old('tags', $post->tags) }}">
                    @error('tags')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <input type="submit" name="commit" value="Update Post" class="btn button is-primary" data-disable-with="Update Post">
        </form>
    </div>
@endsection