@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{ $post->title }}</h1></div>

                <div class="card-body">

                    <p>
                        <img src="{{ $post->getFirstMediaUrl('main_images', 'main') }}" />
                    </p>

                    <p>
                        <b>Author:</b> {{ $post->author->name }}
                    </p>
                    <p>
                        <b>Categories:</b>
                        {!! $post->categories_links !!}
                    </p>
                    <p>
                        <b>Tags:</b>
                        {!! $post->tags_links !!}
                    </p>

                    <p>{!! nl2br($post->post_text) !!}</p>

                </div>
          
            </div> 
        </div>
        @endsection