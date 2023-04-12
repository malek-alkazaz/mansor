@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1>Show Category {{$category->name}}</h1>
        <img src="{{asset('storage/category/image/'.$category->image)}}" alt="" hight="75px" width="75px"><br>
    </div>
</div>
@endsection