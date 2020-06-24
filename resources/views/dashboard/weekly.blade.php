<div class="card">
    <div class="card-header">Weekly Monitoring - {{$sbu}}</div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <canvas id="weeklyChart"></canvas>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <p>Realisasi KPI Nasional</p>
                    <div class="col-md-6">
                        <p>{{$realisasiMingguanKpiNasional}}</p>
                        <p>Menit</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{$prcntMingguanKpiNasional}}%</p>
                        <p>Percent</p>
                    </div>
                </div>
                <div class="row">
                    <p>Realisasi KPI {{$sbu}}</p>                                
                    <div class="col-md-6">
                        <p>{{$realisasiMingguanKpiSBU}}</p>
                        <p>Menit</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{$prcntMingguanKpiSBU}}%</p>
                        <p>Percent</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>