@extends('layouts.app')

@section('content')
    <div class="container">
    @foreach($allCars as $car)
        <div style="border: 1px solid black; margin-bottom: 20px">

{{--            <h1>{{$car->brand}}</h1>--}}
{{--            <h2>{{$car->model}}</h2>--}}
{{--            <h3>{{$car->carName}}</h3>--}}
{{--            <h4>{{$car->status}}</h4>--}}
{{--            <div class="card" style="width: 18rem;">--}}
            <div class="card-body">
                <img name="img" src="{{asset('storage').'/'.$car->img}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Company Name:</h5>
                    <p class="card-text"> {{$car->owner_id}} {{--{{ posts->companyName }}--}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" >Brand: {{$car->brand}}</li>
                    <li class="list-group-item">name: {{$car->carName}}</li>
                    <li class="list-group-item">Model: {{$car->model}}</li>

                </ul>
                <form method="POST" action="/posts/{{$car->id}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">delete</button>
                </form>
            </div>
        </div>


    @endforeach
    </div>
@endsection
