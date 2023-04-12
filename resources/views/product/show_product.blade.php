@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-4">
                <h1>Name: {{$product->name}}</h1>
                <h2>Price: {{$product->price}}</h2>
                <h3>Description: {{$product->description}}</h3>
                <h4>Quantity: {{$product->quantity}}</h4>
                <h4>Show Category: {{$product->category_id}}</h4>
            </div>
            <div class="col-6">
                @foreach ($product->image as $img)
                    <!-- <img src="..." class="rounded float-start" alt="..."> -->
                    <img src="{{asset('storage/product/image/'.$img)}}" class="img-fluid" alt="..." hight="200px" width="200px">
                @endforeach
            </div>
            <div class="col-2">
                <img src="{{asset('storage/product/image/'.$product->image_qr)}}" class="img-fluid" alt="..." hight="100px" width="100px">
            </div>
        </div>
    </div>
</div>
@endsection