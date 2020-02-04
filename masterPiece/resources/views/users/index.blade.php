@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>
<style>
    .image-container {
        position: relative;
    }
    .image {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }
    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }
    .image-container:hover .image {
        opacity: 0.3;
    }
    .image-container:hover .middle {
        opacity: 1;
    }
</style>
<div class="container">

    <div class="row mb-5">
        <div class="col-md-7 text-left border-primary">
            <h2 class="font-weight-light text-primary">My Post</h2>
        </div>
    </div>
    @foreach($posts as $post)
    <div class="row mt-5">
        <div class="col-lg-6">

            <div class="d-block d-md-flex listing">
                <!-- <a href="listings-single.html" class="img d-block" style="background-image: url('images/img_2.jpg')"></a> -->
                <a class="img d-block">
                    {{-- <img src="{{ $post->getFirstMediaUrl('main_images', 'thumb') }}" /></a> --}}
                    <img  width="200" src="/storage/images/{{$post->image}}" />
                
                    <div class="lh-content">
                    <span class="category"></span>
                    <a href="#" class="bookmark"><span class="icon-heart"></span></a>
                   
                        <p>
                            <b>User:</b> {{ $post->author->name }}
                        </p>
                   
                  
                        <p>
                            <b>Title:</b> {{ $post->title }}
                        </p>
                    
                    <address>{{$post->city}}</address>
                    <a href="/users/{{$post->id}}/edit" class="btn btn-primary">edit</a>
                    <form method="POST" action="/users/{{$post->id}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>

                </div>
            </div>
        </div>
        <hr />
    </div>
    @endforeach

</div>

@endsection