@extends('adminlte::page')
@section('title', 'Upload Raw Data Daily report')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Upload Raw Data Daily Report</div>

                <div class="card-body">
                    <div class="text-center">
                        <img src="{{asset('images/excel.png')}}"  alt="Upload Excel File">

                        <h3>Upload Raw Data Daily Report</h3>
                        <form action="{{route('daily-report.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="file" class="btn btn-secondary btn-md" name="file" required>
                            <button type="submit" class="ml-2 btn btn-secondary"><i class="fa fa-upload"></i><span> Upload</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
