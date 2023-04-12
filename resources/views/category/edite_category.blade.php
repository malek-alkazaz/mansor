@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <h1>Edit Category</h1>
        <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
            @method('PATCH') 
            @csrf
            <input type="text" name="name" value={{$category->name}} id=""><br>
            <img src="{{asset('storage/category/image/'.$category->image)}}" alt="" class="img-fluid" hight="75px" width="75px"><br>
            <input type="file" name="image" id=""><br>
            <button type="submit">Update</button>
        </form>
    </div>
</div>
@endsection