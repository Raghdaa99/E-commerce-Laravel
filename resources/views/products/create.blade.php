@extends('admin.layout.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
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


    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="inputDescription">Product Description</label>
                    <textarea id="description" name="description"
                              class="form-control" rows="4">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label> <span>Category  :</span>
                        <select name="category">
                            @foreach($categories as $category)
                                <option
                                    value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach

                        <!--                                    <option value="0">No Category Found</option>-->
                        </select>
                    </label>
                </div>
                <!-- ##### Single Widget ##### -->
                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    {{-- {{$brands}} --}}

                    <select name="brand_id" class="form-control">
                        <option value="">--Select Brand--</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label> <span>Active :</span> <input type="radio" name="active" value="Yes" checked>
                        Yes
                        <input type="radio" name="active" value="No"> No
                    </label>
                </div>
                <div class="form-group">
                    <label for="inputDescription">Product Price</label>
                    <input type="text" name="price" class="form-control" placeholder="Price">
                </div>
                <div class="form-group">
                    <label for="inputName">Upload Image 1</label>
                    <input type="file" name="img" class="form-control" placeholder="Post"/>

                </div>
                <div class="form-group">
                    <label for="inputName">Upload Image 2</label>
                    <input type="file" name="img2" class="form-control" placeholder="Post"/>

                </div>
                <div class="form-group">
                    <label for="inputName">Upload Image 3</label>
                    <input type="file" name="img3" class="form-control" placeholder="Post"/>

                </div>
                <div class="form-group">
                    <label for="inputName">Upload Image 4</label>
                    <input type="file" name="img4" class="form-control" placeholder="Post"/>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>


@endsection
