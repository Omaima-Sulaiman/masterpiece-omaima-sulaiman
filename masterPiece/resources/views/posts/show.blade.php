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
        <form method="POST" action="{{route('comment.store') }}">


                        <div class="comment-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-body">
                                    <hr>
                           
                                    <ul class="media-list">
                                        @foreach($comment as $comments)
                                            <li class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="{{asset('storage').'/'.$comments->user->user_image}}" alt="" class="img-circle">
                                                </a>
                                                <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-muted">{{$comments->created_at}} </small>
                                </span>
                                                    <strong class="text-success">@ {{$comments->user->name}}</strong>
                                                    <p>
                                                        {{$comments->description}}                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>


                @csrf
                <div class="form-group">
                    <input type="text" style="height: 100px" name="description"  class="form-control" placeholder="Add comment"/>
                    <input type="hidden" name="post_id" value="{{$post->id}}"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add Comment" />
                </div>
            </form>
        <div class="col-md-4">
            @include('posts.sidebar')
        </div>
    </div>
</div>
@endsection
