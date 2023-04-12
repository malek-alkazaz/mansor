@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <h1>Create Product</h1>
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="name" class="form-label">name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="name">
                </div>

                <div class="col">
                    <label for="price" class="form-label">price</label>
                    <input type="text" name="price" class="form-control" id="peice" placeholder="price">
                </div>
            </row>

            <div class="row">
                <div class="col">
                    <label for="quantity" class="form-label">quantity</label>
                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="quantity">
                </div>

                <div class="col">
                    <label for="category" class="form-label">category</label>
                    <input type="text" name="category_id" class="form-control" id="category" placeholder="category">
                </div>
            </row>
            

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="input-group mb-3">
                <input type="file" class="form-control" name="image[]" id="image" multiple>
            </div>

            <button type="submit">Add</button>
        </form>

    </div>
</div>
@endsection