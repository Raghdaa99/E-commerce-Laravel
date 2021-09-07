
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" style="background-color: #0a9d11;color: #ffffff ; padding: 15px ;border-radius: 20px">
        <h5 style="color: #ffffff"><i class="icon fas fa-check"></i> Success</h5>
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-success alert-dismissible" style="background-color: #c40512;color: #ffffff ; padding: 15px ;">
        <h5 style="color: #ffffff"><i class="icon fas fa-check"></i> Error</h5>
        {{Session::get('error')}}
    </div>
@endif
