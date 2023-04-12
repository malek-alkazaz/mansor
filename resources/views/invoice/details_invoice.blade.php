<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/table.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('assets/font/css/all.min.css') }}" >


@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
        @foreach( $invoice->items as $product)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $product['name'] }}</h5>
                    <div class="card-text d-flex justify-content-start "> 
                        ${{ $product['totalPrice'] }}
                        <form action="{{route('invoices.delete',$product['id'])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-table delete-color"><i class="fa-solid fa-trash"> حذف</i></button>
                        </form>

                        <form action="{{ route('invoices.edite', $product['id'] )}}" method="post">
                            @csrf
                            @method('put')
                            <input type="text" name="quantity" value={{ $product['quantity']}}>
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"> تعديل</i></button>
                        </form>

                    </div>
                </div>
            </div>
            @endforeach
            <p><strong>السعر الأجمالي : ${{ $invoice->totalPrice }}</strong></p>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <form action="{{route('invoices.store')}}" method="post">
                    @csrf
                    اسم الزبون : <input type="text" name="name" id="">
                    <div class="card-body">
                        <h3 class="card-titel">
                            Your Cart
                            <hr>
                        </h3>
                        <div class="card-text">
                            <p>
                                أجمالي الفاتورة ${{ $invoice->totalPrice }}
                                <input type="hidden" name="price" id="" value={{ $invoice->totalPrice }}>
                            </p>
                            <p>
                                Total Quantities is {{ $invoice->totalQty }}
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection