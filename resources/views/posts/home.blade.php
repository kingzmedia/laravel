@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        Bienvenue sur la page des posts ;)
                    </div>
                </div>
            </div>
        </div>
        @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $post->title }}</div>

                    <div class="panel-body">
                        {{ $post->content }}
                        <p><a href="{{ route("posts_view", array("slug" => $post->slug, "id" => $post->id)) }}">Voir plus</a></p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
