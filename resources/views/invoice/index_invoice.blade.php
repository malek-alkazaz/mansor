<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/table.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('assets/font/css/all.min.css') }}" >


@extends('layouts.app')
@section('content')

<div class="table">
        <div class="table_header">
            <p>الفواتير</p>
            <form action="{{route('search')}}" method="post">
                @csrf
                <input type="text" name="search" class="form-control" id="search" placeholder="بحث">
                <!-- <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button> -->
            </form>
            <div>
                <a href="{{route('invoices.create')}}" class="add_new">+ أضافة فاتورة</a>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>الأسم</th>
                        <th>السعر</th>
                        <th>الأجراء</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($invoices) && $invoices->count() >0)
                    @foreach ( $invoices as $invoice)
                    <tr>
                        <td>1</td>
                        <td>{{$invoice->client_name}}</td>
                        <td>{{$invoice->total_price}}</td>
                        <td class="action-td">
                            <a href="{{route('invoices.show',$invoice->id)}}" class="btn-table show-color"><i class="fa fa-eye" aria-hidden="true"> عرض</i></a>
                            <a href="{{route('invoices.edit',$invoice->id)}}" class="btn-table edit-color"><i class="fa-solid fa-pen-to-square"> تعديل</i></a>
                            <form action="{{route('invoices.destroy',$invoice->id)}}" method="post" style="display:contents">
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

@endsection
