@extends('layouts.app')


@section('content')
<div class="container">

    @if( session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif


    <div class="row">
    @foreach ($products as $product)
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="card-text d-flex justify-content-start "> 
                        <h5>{{$product->name}}</h5>
                        <form action="{{route('invoices.session',$product)}}" method="post">
                            @csrf
                            <input type="text" name="quantity" id="quantity">
                            <button type="submit" class="btn btn-secondary btn-sm">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <a href="{{route('invoices.view')}}" class="btn btn-secondary btn-sm">Show Session</a>
    </div>
</div>

@endsection