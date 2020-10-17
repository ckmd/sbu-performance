<div class="card card-outline card-primary" style="page-break-before: always;">
    <div class="card-header">Monthly Monitoring</div>

    <div class="card-body">
        <table class="table table-bordered text-center">
            <tbody>
                <tr>
                    <td rowspan="6">
                        <canvas id="monthlyChart"></canvas>
                    </td>
                    <th colspan="2">Realisasi KPI Secara Nasional</th>
                </tr>
                <tr>
                    <td>{{$realisasiBulananKpiNasional}}</td>
                    <td>{{$prcntBulananKpiNasional}}%</td>
                </tr>
                <tr>
                    <td>Menit</td>
                    <td>Percent</td>
                </tr>
                <tr>
                    <th colspan="2">Realisasi KPI {{ $sbu }}</th>
                </tr>
                <tr>
                    <td>{{$realisasiBulananKpiSBU}}</td>
                    <td>{{$prcntBulananKpiSBU}}%</td>
                </tr>
                <tr>
                    <td>Menit</td>
                    <td>Percent</td>                       
                </tr>
            </tbody>
        </table>
    </div>
</div>