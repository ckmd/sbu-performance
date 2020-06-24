<h3>Year to date Monitoring - {{$sbu}}</h3>
<div class="row">
    <div class="col-md-12">
        <canvas id="yearToDateChart"></canvas>
    </div>
</div>
<br>
<table class="table table-hover table-bordered text-center">
    <thead bgcolor="#eee">
        <tr>
            <th>&ensp;</th>
            @foreach($bulanKe as $key => $value)
            <th>{{$value}}</th>
            @endforeach
        </tr>
    </thead>
    <tr>
        <td style="text-align:left">Nasional</td>
        @foreach($nationalBulanVal as $key => $value)
        <td>{{$value}}</td>
        @endforeach
    </tr>
    <tr>
        <td style="text-align:left">{{$sbu}}</td>
        @foreach($bulanVal as $key => $value)
        <td>{{$value}}</td>
        @endforeach
    </tr>
    <tr>
        <td style="text-align:left">KPI</td>
        @foreach($kpiVal as $key => $value)
        <td>{{$value}}</td>
        @endforeach
    </tr>
</table>
<br>