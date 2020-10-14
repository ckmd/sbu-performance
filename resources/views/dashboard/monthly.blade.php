<div class="card card-outline card-primary">
    <div class="card-header">Monthly Monitoring</div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <canvas id="monthlyChart"></canvas>
            </div>
            <div class="col-md-3 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
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
                                <td>{{$realisasiBulananKpiSBU}}</td>
                                <td>{{$prcntBulananKpiSBU}}%</td>
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