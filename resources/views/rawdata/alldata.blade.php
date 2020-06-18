@extends('adminlte::page')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center">
                <h4 class="display-6">View All Data SBU</h4>
                <!-- <footer class="blockquote-footer">*Durasi dalam satuan menit</footer> -->
            </div>
            <a href="{{route('rawdata.create')}}" class="btn btn-success disabled"><i class="fa fa-download"></i><span> Download</span></a>
            <a href="deleteExcel" class="btn btn-danger disabled"><i class="fa fa-trash"></i><span> Hapus Data</span></a>
            <br>
            <br>
            <table class="table table-responsive table-hover table-bordered table-striped" style="text-align: center;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ticket ID</th>
                        <th>Incident ID</th>
                        <!-- <th>Kode_WO</th>
                        <th>WO_Date</th>
                        <th>Region</th>
                        <th>Basecamp</th>
                        <th>Service_Point</th>
                        <th>Durasi_SBU</th>
                        <th>Preparation_Time</th>
                        <th>Travel_Time</th>
                        <th>Working_Time</th>
                        <th>Total_Durasi_WO</th>
                        <th>RSPS</th>
                        <th>WO_Complete</th>
                        <th>Total_Durasi_SC</th>
                        <th>Category</th>
                        <th>Root_Cause</th>
                        <th>Kendala</th>
                        <th>Terminasi POP</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $id = $datas->firstItem()?>
                    @foreach($datas as $cat)
                    <tr>
                        <th>{{$id}}</th>
                        <td>{{$cat["Ticket ID"]}}</td>
                        <td>{{$cat["Incident ID"]}}</td>
                        <!-- <td>{{$cat->kode_wo}}</td>
                        <td nowrap="nowrap">{{$cat->wo_date}}</td>
                        <td>{{$cat->region}}</td>
                        <td nowrap="nowrap" class="text-left">{{$cat->basecamp}}</td>
                        <td nowrap="nowrap" class="text-left">{{$cat->serpo}}</td>
                        <td>{{$cat->durasi_sbu}}</td>
                        <td>{{$cat->prep_time}}</td>
                        <td>{{$cat->travel_time}}</td>
                        <td>{{$cat->work_time}}</td>
                        <td>{{$cat->total_durasi_wo}}</td>
                        <td>{{$cat->rsps*100}}%</td>
                        <td nowrap="nowrap">{{$cat->wo_complete}}</td>
                        <td>{{$cat->total_durasi_sc}}</td>
                        <td nowrap="nowrap">{{$cat->category}}</td>
                        <td nowrap="nowrap">{{$cat->root_cause}}</td>
                        <td nowrap="nowrap">{{$cat->kendala}}</td>
                        <td nowrap="nowrap">{{$cat->terminasi_pop}}</td> -->
                    </tr>
                    <?php $id++?>
                    @endforeach
                </tbody>
            </table>
            {{$datas->links()}}
        </div>
    </div>
</div>

@stop