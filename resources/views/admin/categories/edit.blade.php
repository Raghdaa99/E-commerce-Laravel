@extends('admin.layout.master')
@section('content')

    <!-- Main content -->
    <section class="content">
        <section class="content">
            <form action="{{route('category.update',$category)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Category Title</label>
                                    <input type="text" id="title" name="title" value="{{$category->title}}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Category Description</label>
                                    <textarea id="description" name="description"
                                              class="form-control" rows="4">{{$category->description}}</textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Update Post" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </section>
    </section>
    <!-- /.content -->
@endsection
@section('title')
    Update Category
@endsection
@section('title_page')
    Update Category Page
@endsection
