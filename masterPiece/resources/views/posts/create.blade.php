@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new Post</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        Post title*:
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" />
                        <br />

                        Post text*:
                        <textarea name="post_text" class="form-control" rows="10">{{ old('post_text') }}</textarea>
                        <br />

                        Categories:
                        <br />
                        @foreach ($categories as $category)
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" /> {{ $category->name }}
                            <br />
                        @endforeach
                        <br />
                        Type:
                        
                        <input type="text" name="type" class="form-control" value="{{ old('type') }}" />

                        <br />
                         city:
                        <input type="text" name="city" class="form-control" value="{{ old('city') }}" />
                        <!-- <div class="dropdown">
                            <input class="btn btn-primary dropdown-toggle" type="button" name="type" data-toggle="dropdown"/>
                            <span class="caret"></span></input>
                            <ul class="dropdown-menu">
                                <li><a href="#">free</a></li>
                                <li><a href="#">rentr</a></li>
                                
                            </ul>
                        </div> -->

                        <!-- Tags (comma-separated):
                        <input type="text" name="tags" class="form-control" />
                        <br /> -->

                        Main image:
                        <br />
                        <input type="file" name="image" />
                        <br /><br />

                        <input type="submit" value=" Save Post " class="btn btn-primary" />

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
