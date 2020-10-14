<div class="card card-outline card-primary">
    <div class="card-header">Year to date Monitoring</div>

    <div class="card-body">
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
                    @foreach($ytdBulanKe as $key => $value)
                    <th>{{$value}}</th>
                    @endforeach
                </tr>
            </thead>
            <tr>
                <td style="text-align:left">Nasional</td>
                @foreach($ytdNasionalVal as $key => $value)
                <td>{{$value}}</td>
                @endforeach
            </tr>
            <tr>
                <td style="text-align:left">{{$sbu}}</td>
                @foreach($ytdSBUVal as $key => $value)
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
    </div>
</div>