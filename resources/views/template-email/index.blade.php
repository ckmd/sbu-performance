@extends('adminlte::page')
@section('title', 'Template Email')
@section('js')
    <!-- Javascript for handling ajax request -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- javascript for handling chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <!-- Chart untuk Year to date -->
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@stop
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">Set Template Email</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('mail.update')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{ $templateMail->id }}">
                        <div class="form-group">
                            <label for="subject" class="col-form-label">Subject * :</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ $templateMail->subject }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description-text" class="col-form-label">Description * :</label>
                            <textarea class="form-control" id="description-text" name="description" required>{{ $templateMail->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update this template Mail ?');">Update Template Mail</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
