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
    <script src="{{ asset('js/profile.js') }}"></script>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">

                                <form method="POST" action="{{route('users.update',$post->id)}}">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                    </div>



                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab"
                                           href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Edit </a>
                                    </li>

                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                         aria-labelledby="basicInfo-tab">


                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-6">
                                                <label style="font-weight:bold;">Name Post</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <input value="{{$post->title}}" type="text" name="title"
                                                       class="form-control" id="name" aria-describedby="emailHelp"
                                                       placeholder="Edit Name">

                                            </div>

                                            
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-6">
                                                <label style="font-weight:bold;">type</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <input value="{{$post->type}}" type="text" name="type"
                                                       class="form-control" id="name" aria-describedby="emailHelp"
                                                       placeholder="Edit Name">

                                            </div>


                                        </div>


                                        <hr/>

                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-6">
                                                <label style="font-weight:bold;">description</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <input value="{{$post->post_text}}" type="text" name="post_text"
                                                       class="form-control" id="description" aria-describedby="emailHelp"
                                                       placeholder="Edit description">
                                            </div>

                                        </div>
                                        <hr/>

                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-6">
                                                <label style="font-weight:bold;">city</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <input value="{{$post->city}}" type="text" name="city"
                                                       class="form-control" id="description" aria-describedby="emailHelp"
                                                       placeholder="Edit description">
                                            </div>

                                        </div>

                                        </div>
                        
                                        <hr/>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
