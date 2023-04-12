<h1> Show All Categories </h1>

<table>
    <th>Name</th>
    <th>image</th>
    <th>Action</th>
    @foreach ($categories as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>
                <img src="{{asset('storage/category/image/'.$category->image)}}" alt="" hight="75px" width="75px">
            </td>
            <td>
                <a href="{{route('category.show',$category->id)}}">Show</a><br>
                <a href="{{route('category.create')}}">Add</a><br>
                <a href="{{route('category.edit',$category->id)}}">Edite</a><br>
                <form action="{{route('category.destroy',$category->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>