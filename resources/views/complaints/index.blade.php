@extends('admin.layout.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Complaints</h2>
            </div>
            <div class="pull-right">
                {{--                @can('permission-create')--}}
                <a class="btn btn-success" href="{{ route('complaints.create') }}"> Create New Complaint</a>
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
            <th>Medias</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($files as $file)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{$file->complaint->details }}</td>
                <td>
                    <a href="{{asset('files/'.$file->filenames)}}"> View Files</a>
                </td>
                <td>
                    <form action="{{ route('complaints.destroy',$file) }}" method="POST">

                        {{--                        @can('permission-edit')--}}
                        {{--                        <a class="btn btn-primary" href="{{route('files.edit',$permission)}}">Edit</a>--}}
                        {{--                        @endcan--}}


                        @csrf
                        @method('DELETE')
                        {{--                        @can('permission-delete')--}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {{--                        @endcan--}}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {!! $files->links() !!}



@endsection
