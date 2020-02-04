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
                            <img  width="200" src="/storage/images/{{$post->image}}" />
                        </div>
                        <div class="col-md-8">
                            
                            <a href="{{ route('posts.show', $post->id) }}">
                                <h2>{{ $post->title }}</h2>
                            </a>
                            <p>
                                <b>User:</b> {{ $post->author->name }}
                            </p>
                            <p>
                                <b>City:</b> {{ $post->city }}
                            </p>

                            <p>
                                <b>Categories:</b>
                                {!! $post->categories_links !!}
                            </p>
                            <p>
                                <b>Tags:</b>
                                {!! $post->tags_links !!}
                            </p>
                            <p>{{ substr($post->post_text, 0, 200) }}...
                                <a href="{{ route('posts.show', $post->id) }}">Read full Post</a></p>
                        </div>
                    </div>
                    <hr />
                    @empty
                    No post yet.
                    @endforelse

                    {{ $posts->links() }}

                </div>
                {{-- <a class="nav-link" href="{{ route('') }}">{{ __('Register') }}</a> --}}
            </div>
        </div>
        <div class="col-md-4">
            @include('posts.sidebar')
        </div>
    </div>
</div>
@endsection