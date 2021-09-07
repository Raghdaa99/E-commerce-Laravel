@extends('admin.layout.master')
@section('content')
    <!-- Main content -->
    <section class="content">
    @include('admin.layout.messages')
    <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="pull-right">
                {{--                @can('permission-create')--}}
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a>
                {{--                @endcan--}}
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Category title
                        </th>
                        <th>
                            description
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                <a>
                                    {{$category->title}}
                                </a>
                                <br/>
                                <small>
                                    Created {{$category->created_at}}
                                </small>
                            </td>

                            <td class="project_progress">
                                {{$category->description}}
                            </td>
{{--                            @can('action-posts')--}}
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{route('category.edit',$category)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <form method="post" action="{{route('category.destroy',$category)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </td>
{{--                            @endcan--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
{{--        {{$categories->links()}}--}}
    </section>

    <!-- /.content -->
@endsection
@section('title')
    Categories
@endsection
@section('title_page')
    Categories Page
@endsection
