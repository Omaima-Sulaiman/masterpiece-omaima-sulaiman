@extends('layouts.app')

@section('content')
<form action="{{route('create.post')}}" method="post">
    @csrf
    <div>
        <label for="model">title</label>
        <input type="text" name="model" id="model">
    </div>
    <div>
        <label for="brand">Brand</label>
        <input type="text" name="brand" id="brand">
    </div>
    <div>
        <label for="img">Image</label>
        <input type="text" name="img" id="img">
    </div>
    <div>
        <label for="carName">Car Name</label>
        <input type="text" name="carName" id="carName">
    </div>
    <div>
        <input type="submit" name="create" value="Create!">
    </div>
</form>
@endsection
