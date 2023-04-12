<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/table.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('assets/font/css/all.min.css') }}" >



@extends('layouts.app')

@section('content')

    <div class="table">
        <div class="table_header">
            <p>product details</p>
            <form action="{{route('search')}}" method="post">
                @csrf
                <input type="text" name="search" class="form-control" id="search" placeholder="بحث">
                <!-- <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button> -->
            </form>
            <div>
                <a href="{{route('invoices.index')}}" class="add_new" style="background-color: #ffe000 !important">الفواتير</a>
                <a href="{{route('product.create')}}" class="add_new">+ أضافة</a>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>الأسم</th>
                        <th>النوع</th>
                        <th>السعر الأفرادي</th>
                        <th>العدد</th>
                        <th>الأجراء</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($products) && $products->count() >0)
                    @foreach ($products as $product)
                    <tr>
                        <td>1</td>
                        <td>{{$product->name}}</td>
                        <td>                    
                            @foreach ($product->image as $img)
                            <img src="{{asset('storage/product/image/'.$img)}}" alt="" hight="75px" width="75px">
                            @endforeach
                        </td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td class="action-td">
                            <a href="{{route('product.show',$product->id)}}" class="btn-table show-color"><i class="fa fa-eye" aria-hidden="true"> عرض</i></a>
                            <a href="{{route('product.edit',$product->id)}}" class="btn-table edit-color"><i class="fa-solid fa-pen-to-square"> تعديل</i></a>
                            <form action="{{route('product.destroy',$product->id)}}" method="post" style="display:contents">
                                @method('DELETE')
                                @csrf
                                <button class="btn-table delete-color"><i class="fa-solid fa-trash"> حذف</i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>




<!-- <form action="{{route('getProductByCategory')}}" method="post">
    @csrf
    <div class="row">
        <div class="col">
            <label for="search" class="form-label">search</label>
            <input type="text" name="search" class="form-control" id="search" placeholder="search">
        </div>
    </div>
    <button type="submit">Get Products</button>
</form> -->


@endsection


