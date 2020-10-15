<div class="card card-outline card-primary">
    <div class="card-header">Year to date Monitoring</div>

    <div class="card-body">
        <table class="table table-bordered text-center" style="width:100%;">
            <tbody>
                <tr>
                    <td colspan="{{ count($ytdBulanKe)+1 }}">
                        <canvas id="yearToDateChart" style="width: 100%; padding:20px;"></canvas>
                    </td>
                </tr>
                <tr>
                    <th>&ensp;</th>
                    @foreach($ytdBulanKe as $key => $value)
                    <th>{{$value}}</th>
                    @endforeach
                </tr>
                <tr>
                    <td>Nasional</td>
                    @foreach($ytdNasionalVal as $key => $value)
                    <td>{{$value}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>{{$sbu}}</td>
                    @foreach($ytdSBUVal as $key => $value)
                    <td>{{$value}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>KPI</td>
                    @foreach($kpiVal as $key => $value)
                    <td>{{$value}}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>