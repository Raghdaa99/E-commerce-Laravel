@extends('admin.layout.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
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
                                <input type="text" id="title" name="title" value="{{old('title')}}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Category Description</label>
                                <textarea id="description" name="description"
                                          class="form-control" rows="4">{{old('description')}}</textarea>
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
                    <input type="submit" value="Create new Category" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('title')
    Add Category
@endsection
@section('title_page')
    Add Categories Page
@endsection
