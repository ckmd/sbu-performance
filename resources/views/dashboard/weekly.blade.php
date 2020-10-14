<div class="card card-outline card-primary">
    <div class="card-header">Weekly Monitoring</div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-9">
                <canvas id="weeklyChart"></canvas>
            </div>
            <div class="col-lg-3 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
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
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2">Realisasi KPI {{$sbu}}</th>
                            </tr>
                            <tr>
                                <td>{{$realisasiMingguanKpiSBU}}</td>
                                <td>{{$prcntMingguanKpiSBU}}%</td>
                            </tr>
                            <tr>
                                <td>Menit</td>
                                <td>Percent</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>