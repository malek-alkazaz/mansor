@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1>Create Category</h1>
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="col">
                <label for="name" class="form-label">name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="name">
            </div>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="image" id="image" multiple>
            </div>
            <button type="submit">Add</button>
        </form>
    </div>
</div>
@endsection