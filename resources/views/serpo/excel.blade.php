@extends('adminlte::page')
@section('title', 'Upload Raw Data Serpo')

@section('content')
<!-- Upload Files Start Here -->
<!-- <form action="/excel" method="POST" enctype="multipart/form-data"> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <img src="{{asset('images/excel.png')}}"  alt="Upload Excel File">

                <h3>Upload Raw Data Serpo File</h3>
                <form action="{{route('excel.store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="file" class="btn btn-secondary btn-md" name="excelFile">
                    <button type="submit" class="btn btn-secondary"><i class="fa fa-upload"></i><span> Upload</span></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Upload Files Ends Here -->
<!-- PHP for uploading Files -->
@endsection