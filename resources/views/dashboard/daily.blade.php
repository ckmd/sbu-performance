<div class="card card-outline card-primary">
    <div class="card-header">Daily Monitoring Bulan {{ $latestMonth }}</div>

    <div class="card-body">
        <table class="table table-bordered text-center">
            <tbody>
                <tr>
                    <td rowspan="6">
                        <canvas id="dailyChart"></canvas>
                    </td>
                    <th colspan="2">Realisasi KPI Secara Nasional</th>
                </tr>
                <tr>
                    <td>{{$realisasiHarianKpiNasional}}</td>
                    <td>{{$prcntHarianKpiNasional}}%</td>
                </tr>
                <tr>
                    <td>Menit</td>
                    <td>Percent</td>
                </tr>
                <tr>
                    <th colspan="2">Realisasi KPI {{ $sbu }}</th>
                </tr>
                <tr>
                    <td>{{$realisasiHarianKpiSBU}}</td>
                    <td>{{$prcntHarianKpiSBU}}%</td>
                </tr>
                <tr>
                    <td>Menit</td>
                    <td>Percent</td>                       
                </tr>
            </tbody>
        </table>
    </div>
</div>