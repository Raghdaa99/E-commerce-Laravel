@extends('admin.layout.master')


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="description"
                              placeholder="Detail">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label> <span>Category  :</span>
                        <select name="category">
                            @foreach($categories as $category)

                                <option
                                    value="{{$category->id}}"

                                    {{$product->category_id==$category->id?'selected' : ' '}}>

                                    {{$category->title}}</option>

                        @endforeach
                        <!--                                    <option value="0">No Category Found</option>-->
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="inputDescription">Product Price</label>
                    <input type="text" name="price" value="{{ $product->price }}" class="form-control"
                           placeholder="Price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label> <span>Image1</span> <img src="{{asset('product_images/'.$product->image)}}"
                                                     width="100px" height="90px"/> </label>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label> <span>Image1</span>
                        <input type="file"
                               name="img" accept=".jpg, .jpeg,.png"/>
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>


    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
