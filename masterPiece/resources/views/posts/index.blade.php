@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Newest post</div>

                <div class="card-body">

                    @forelse ($posts as $post)
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $post->getFirstMediaUrl('main_images', 'thumb') }}" />
                        </div>
                        <div class="col-md-8">
                            <a href="{{ route('posts.show', $post->id) }}"><h2>{{ $post->title }}</h2></a>
                            <p>
                                <b>User:</b> {{ $post->author->name }}
                            </p>
                            <p>
                                <b>Categories:</b>
                                {!! $post->categories_links !!}
                            </p>
                            <p>
                                <b>Tags:</b>
                                {!! $article->tags_links !!}
                            </p>
                            <p>{{ substr($article->article_text, 0, 200) }}...
                                <a href="{{ route('posts.show', $post->id) }}">Read full article</a></p>
                        </div>
                    </div>
                    <hr />
                    @empty
                        No post yet.
                    @endforelse

                    {{ $posts->links() }}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('posts.sidebar')
        </div>
    </div>
</div>
@endsection
