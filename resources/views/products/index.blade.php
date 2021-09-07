@extends('admin.layout.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
{{--                @can('product-create')--}}
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
{{--                @endcan--}}
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category Name</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->description }}</td>
	        <td>{{ $product->price }}</td>
	        <td>{{ $product->category->title }}</td>
            <td>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <img width="200px" height="200px" alt="Avatar" class="table-avatar"
                             src="{{asset('product_images/'.$product->image)}}">
                    </li>
                </ul>
            </td>
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
{{--                    @can('product-edit')--}}
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
{{--                    @endcan--}}


                    @csrf
                    @method('DELETE')
{{--                    @can('product-delete')--}}
                    <button type="submit" class="btn btn-danger">Delete</button>
{{--                    @endcan--}}
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $products->links() !!}



@endsection
