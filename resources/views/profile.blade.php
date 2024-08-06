@extends('adminlte::page')

@section('title', 'Profile User')

@section('content_header')
<h3>Profile User</h3>
@stop


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Profil</h3>
            </div>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{ $data->id }}">
                @csrf
                <div class="card-body">
                    <form role="form">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input value="{{ $data->name }}" type="text" class="form-control" name="name" placeholder="Nama User">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" value="{{ $data->username }}" class="form-control" name="username" placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password (isi hanya apabila ingin diganti)</label>
                                    <div class="input-group mb-3"id="show_hide_password">
                                        <input class="form-control" type="password" name="password1">
                                        <div class="input-group-append">
                                        <span class="input-group-text">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ulangi Password (isi hanya apabila ingin diganti)</label>
                                    <div class="input-group mb-3"id="show_hide_password">
                                        <input class="form-control" type="password" name="password2">
                                        <div class="input-group-append">
                                        <span class="input-group-text">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="action_button" class="btn btn-primary">Rubah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop


@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    a, a:hover{
    color:#333
    }
</style>
@stop

@section('js')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<script>
	function hanyaAngka(evt)
    {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
	    return true;
	}

    $(function () {
        $('.select2').select2()
        $('.select2bs4').select2
        ({
            theme: 'bootstrap4'
        })
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4', modal: true, header: true
        });

    $('#sample_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
        url:"{{ route('profilesave') }}",
        method:"POST",
        data: new FormData(this),
        contentType: false,
        cache:false,
        processData: false,
        dataType:"json",
    beforeSend:function(){
        $('#action_button').html('<i class="fa fa-spinner fa-spin"></i>');
    },
        success:function(data)
        {
        var html = '';
        if(data.errors)
        {
        html = '';
        for(var count = 0; count < data.errors.length; count++)
        {
        html += data.errors[count];
        }
        toastr["error"](html);
        $('#action_button').html("Rubah Data");
        }
        if(data.duplicate)
        {
            toastr["error"](data.duplicate);
            $('#action_button').html("Rubah Data");
        }
        if(data.success)
        {
        window.location.href = 'logout';
        $('#sample_form')[0].reset();
        toastr["success"](data.success);
        }
        }
    })
    });
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
    });
</script>
@stop

@section('footer')
this
@stop
