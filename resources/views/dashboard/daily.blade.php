<div class="card">
    <div class="card-header">Daily Monitoring - {{$sbu}}</div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <canvas id="dailyChart"></canvas>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <p>Realisasi KPI Nasional</p>
                    <div class="col-md-6">
                        <p>{{$realisasiHarianKpiNasional}}</p>
                        <p>Menit</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{$prcntHarianKpiNasional}}%</p>
                        <p>Percent</p>
                    </div>
                </div>
                <div class="row">
                    <p>Realisasi KPI {{$sbu}}</p>                                
                    <div class="col-md-6">
                        <p>{{$realisasiHarianKpiSBU}}</p>
                        <p>Menit</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{$prcntHarianKpiSBU}}%</p>
                        <p>Percent</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>