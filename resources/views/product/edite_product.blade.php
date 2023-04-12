@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <h1>Update Product</h1>
        <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col">
                    <label for="name" class="form-label">name</label>
                    <input type="text" name="name" value={{$product->name}} class="form-control" id="name" placeholder="name">
                </div>

                <div class="col">
                    <label for="price" class="form-label">price</label>
                    <input type="text" name="price" value={{$product->price}} class="form-control" id="peice" placeholder="price">
                </div>
            </row>

            <div class="row">
                <div class="col">
                    <label for="quantity" class="form-label">quantity</label>
                    <input type="text" name="quantity" value={{$product->quantity}} class="form-control" id="quantity" placeholder="quantity">
                </div>

                <div class="col">
                    <label for="category" class="form-label">category</label>
                    <input type="text" name="category_id" value={{$product->category_id}} class="form-control" id="category" placeholder="category">
                </div>
            </row>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3">
                {{$product->description}}
                </textarea>
            </div>

            <div class="input-group mb-3">
                <input type="file" class="form-control" name="image[]" id="image" multiple>
            </div>

            <button type="submit">Update</button>
        </form>

    </div>
</div>
@endsection