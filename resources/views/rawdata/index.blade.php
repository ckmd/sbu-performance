@extends('adminlte::page')
@section('title', 'Dashboard - raw data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard - Raw Data</div>

                <div class="card-body">
                    <div class="text-center">
                        <img src="{{asset('images/excel.png')}}"  alt="Upload Excel File">

                        <h3>Upload Raw Data SBU</h3>
                        <form action="{{route('rawdata.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="file" class="btn btn-secondary btn-md" name="file">
                            <button type="submit" class="ml-2 btn btn-secondary"><i class="fa fa-upload"></i><span> Upload</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
