@extends('adminlte::page')
@section('title', 'KPI')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Set Nilai KPI</div>

                <div class="card-body">
                    <p>Nilai KPI saat ini : {{$latestKpi}}</p>
                    <form action="{{route('kpi.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="nilaikpi">Masukkan nilai KPI baru</label>
                            <input type="number" class="form-control" name="nilaikpi" value="{{$latestKpi}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-pen"></i><span> Perbarui</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
