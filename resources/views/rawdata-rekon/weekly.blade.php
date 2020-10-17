<div class="card card-outline card-primary">
    <div class="card-header">Weekly Monitoring</div>

    <div class="card-body">
        <table class="table table-bordered text-center">
            <tbody>
                <tr>
                    <td rowspan="6">
                        <canvas id="weeklyChart"></canvas>
                    </td>
                    <th colspan="2">Realisasi KPI Secara Nasional</th>
                </tr>
                <tr>
                    <td>{{$realisasiMingguanKpiNasional}}</td>
                    <td>{{$prcntMingguanKpiNasional}}%</td>
                </tr>
                <tr>
                    <td>Menit</td>
                    <td>Percent</td>
                </tr>
                <tr>
                    <th colspan="2">Realisasi KPI {{ $sbu }}</th>
                </tr>
                <tr>
                    <td>{{$realisasiMingguanKpiSBU}}</td>
                    <td>{{$prcntMingguanKpiSBU}}%</td>
                </tr>
                <tr>
                    <td>Menit</td>
                    <td>Percent</td>                       
                </tr>
            </tbody>
        </table>
    </div>
</div>