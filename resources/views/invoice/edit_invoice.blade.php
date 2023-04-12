@extends('layouts.app')


@section('content')
<div class="container">
    <form action="{{route('invoices.update',$invoice_content->id)}}" method="post">
        @csrf    
        @method('PATCH')
        <input type="text" value={{$invoice_content->client_name}} name="client_name"><br>
        {{$invoice_content->total_price}}<br>
        <button type="submit" class="btn btn-secondary btn-sm">Update</button>
    </form>
    <div class="row">
        @foreach ($result as $product)
            <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-start "> 
                            <form action="{{route('invoiceDetails.update',$product->id)}}" method="post">
                                @csrf    
                                @method('PUT')
                                <input type="hidden" value="{{$invoice_content->id}}" name="invoice_id">
                                <input type="text" value={{$product->quantity}} name="quantity">
                                <button type="submit" class="btn btn-secondary btn-sm">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

