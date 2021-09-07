
@extends('admin.layout.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container lst">


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <form method="post" action="{{route('complaints.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
{{--                @csrf--}}

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Detail:</strong>
                        <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="input-group hdtuto control-group lst increment" >
                    <input type="file" name="filenames[]" class="myfrm form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                    </div>
                </div>
                <div class="clone hide">
                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                        <input type="file" name="filenames[]" class="myfrm form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                    </div>
                </div>
                </div>


                <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>


            </form>
        </div>
    </section>

    <!-- /.content -->
@endsection
@section('title')
    Complaints
@endsection
@section('title_page')
    Complaints Page
@endsection
