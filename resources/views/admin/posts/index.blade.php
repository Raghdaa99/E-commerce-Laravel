@extends('admin.layout.master')
@section('content')
    <!-- Main content -->
    <section class="content">
    @include('admin.layout.messages')
    <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Post title
                        </th>
                        <th style="width:10%">
                            Image
                        </th>
                        <th>
                            description
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                <a>
                                    {{$post->title}}
                                </a>
                                <br/>
                                <small>
                                    Created {{$post->created_at}}
                                </small>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar"
                                             src="{{asset('post_images/'.$post->image)}}">
                                    </li>
                                </ul>
                            </td>
                            <td class="project_progress">
                                {{$post->description}}
                            </td>
                            @can('action-posts')
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{route('post.edit',$post)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <form method="post" action="{{route('post.destroy',$post)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
        {{$posts->links()}}
    </section>

    <!-- /.content -->
@endsection
@section('title')
    Posts
@endsection
@section('title_page')
    Posts Page
@endsection
