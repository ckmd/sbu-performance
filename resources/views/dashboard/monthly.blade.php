<h3>Monthly Monitoring - {{$sbu}}</h3>
<div class="row">
    <div class="col-md-9">
        <canvas id="monthlyChart"></canvas>
    </div>
    <div class="col-md-3">
        <div class="row">
            <p>Realisasi KPI Secara Nasional</p>
            <div class="col-md-6">
                <p>{{$realisasiBulananKpiNasional}}</p>
                <p>Menit</p>
            </div>
            <div class="col-md-6">
                <p>{{$prcntBulananKpiNasional}}%</p>
                <p>Percent</p>
            </div>
        </div>
        <div class="row">
            <p>Realisasi KPI {{$sbu}}</p>
            <!-- <div id = 'msg'>SBU ... &ensp;</div> -->
            
            <div class="col-md-6">
                <p>{{$realisasiBulananKpiSBU}}</p>
                <p>Menit</p>
            </div>
            <div class="col-md-6">
                <p>{{$prcntBulananKpiSBU}}%</p>
                <p>Percent</p>
            </div>
        </div>
    </div>
</div>
