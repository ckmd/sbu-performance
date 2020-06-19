@extends('adminlte::page')
@section('title', 'Dashboard - Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Data Ditampilkan Dari {{$firstData}} Hingga {{$lastData}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
