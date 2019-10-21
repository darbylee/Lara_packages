@extends(config('sblog.config_namespace') . '::layouts.sblog', ['title'=>"Show " . $post->title])

@section('content')

    <section class="section">
        <div class="container">
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <p class="level-item">
                        <strong>Detail</strong>
                    </p>
                </div>

                @auth
                    <!-- Right side -->
                    <div class="level-right">
                        @can('update', $post)
                            <p class="level-item">
                                <a href="{{ route(config('sblog.route_name_prefix') . '.post.edit', ['id'=>$post->id]) }}" class="button">Edit</a>
                            </p>
                        @endcan
                        @can('delete', $post)
                            <p class="level-item">
                                <a href="#" delete_index="{{ $post->id }}" class="button is-danger delete-post">Delete</a>
                                <form id="frm_post_delete_{{ $post->id }}" action="{{ route(config('sblog.route_name_prefix') . '.post.destroy', ['id'=>$post->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </p>
                        @endcan
                    </div>
                @endauth

            </nav>
            <hr />
            <div class="content">
                {{ $post->body }}
            </div>
        </div>
    </section>

    <section class="comments">
        <div class="container">
            <h2 class="subtitle is-5"><strong>{{ $post->comments->count() }}</strong> Comments</h2>
            @foreach($post->comments as $comment)
                <div class="box">
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <strong>{{ $comment->title }}</strong>
                                <div class="detail" style="white-space: pre-line">
                                    {{ $comment->body }}
                                </div>
                                <br>
                                <div class="columns">
                                    <div class="author level-left column is-one-quarter">
                                        {{ $comment->created_at }}
                                    </div>
                                    <div class="column is-half"></div>
                                    <div class="author level-right column is-one-quarter text-right">
                                        created by {{ '@'.$comment->user->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                            @can('delete', $comment)
                                <a href="#" delete_index="{{ $comment->id }}" class="button is-danger delete-comment">Delete</a>
                                <form id="frm_comment_delete_{{ $comment->id }}" action="{{ route(config('sblog.route_name_prefix') . '.comment.destroy', ['post_id'=>$post->id, 'id'=>$comment->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            @endcan
                        @endauth
                  </article>
                </div>
            @endforeach

            @auth
                @can('canCreateComment', $post)
                    <div class="comment-form">
                        <hr />
                        <h3 class="subtitle is-3">Leave a reply</h3>
                        <form id="frm_new_comment" action="{{ route(config('sblog.route_name_prefix') . '.comment.store', ['post_id'=>$post->id]) }}" method="POST">
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
                                    <label class="string optional label" for="body">Comment</label>
                                    <textarea class="text optional textarea" name="body" id="body" value="{{ old('body') }}"></textarea>
                                    @error('body')
                                    <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <input type="submit" class="button is-primary">
                        </form>
                    </div>
                @endcan
            @endauth
        </div>
    </section>
    <br>
    <br>
@endsection

@section('page_css')
@endsection

@section('page_js')
  <script>
      $(document).ready(function () {
          $(".delete-post").click(function(e){
              e.preventDefault();
              var delete_id = $(this).attr('delete_index');
              var result = confirm("Want to delete this post?");
              if (result) {
                  var frm_id = "#frm_post_delete_" + delete_id;
                  $(frm_id).submit();
              }
          });
          $(".delete-comment").click(function(e){
              e.preventDefault();
              var delete_id = $(this).attr('delete_index');
              var result = confirm("Want to delete this comment?");
              if (result) {
                  var frm_id = "#frm_comment_delete_" + delete_id;
                  $(frm_id).submit();
              }
          });
      } );
  </script>
@endsection