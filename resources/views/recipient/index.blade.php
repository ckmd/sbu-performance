@extends('adminlte::page')
@section('title', 'All Recipient')

@section('css')
    <link href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/dataTables.bootstrap.css">
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript" src="assets/DataTables/media/js/jquery.js"></script>
	<script type="text/javascript" src="assets/DataTables/media/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.data').DataTable();
        });
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

        <div class="card">
            <div class="card-header">All Recipient</div>

            <div class="card-body">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalRecipient"><i class="fa fa-plus"></i> <span> Add New Recipient</span></button>
                <br> <br>
                <table class="table table-hover table-bordered data" id="table" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>SBU</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($recipients as $item)                    
                    <tr>
                        <td> {{ $i }}</td>
                        <td>{{ $item->sbu->nama }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', $item->id ) }}" class="btn btn-warning" style="color: white">
                                <i class="fa fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('user.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this User ?');">
                                <i class="fa fa-trash"></i>
                                <span>Delete</span>
                            </a>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('recipient.create')
@stop