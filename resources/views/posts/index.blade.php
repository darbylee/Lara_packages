@extends(config('sblog.config_namespace') . '::layouts.sblog', ['title'=>"Blog List"])

@section('content')
    <section class="section">
        <div class="container">
            @foreach($posts as $post)
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4">
                                    <a href="{{ route(config('sblog.route_name_prefix') . '.post.show', ['id'=>$post->id]) }}">{{$post->title}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="content">
                            <div class="detail" style="white-space: pre-line">
                                {{ $post->body }}
                            </div>
                            <br>
                            <div class="columns">
                                <div class="author level-left column is-one-quarter">
                                    {{ $post->created_at }}
                                </div>
                                <div class="column is-half"></div>
                                <div class="author level-right column is-one-quarter text-right">
                                    created by {{ "@". $post->user->name }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection