@extends('adminlte::page')
@section('title', 'Performa Nasional')

@section('header')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function() {
// Chart for Wo per Region
    var woChart = new CanvasJS.Chart("woChart", {
        theme: "light2",
        animationEnabled: true,
        title: {
            text: "Total Work Order"
        },
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($woArray, JSON_NUMERIC_CHECK); ?>
        }]
    });
    woChart.render();
// Chart for Average RSPS
    var rspsChart = new CanvasJS.Chart("rspsChart", {
        theme: "light2",
    	animationEnabled: true,
        title: {
            text: "Performa RSPS per SBU"
        },
        data: [{
			indexLabelPlacement: "outside",
            type: "column",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{y}",
            dataPoints: <?php echo json_encode($rspsArray, JSON_NUMERIC_CHECK); ?>
        }]
    });
    rspsChart.render();

    var trendChart = new CanvasJS.Chart("chartContainer", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Trend Performa RSPS Nasional"
        },
        data: [{
            type: "line",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($chartArray, JSON_NUMERIC_CHECK); ?>
        }]
    });
    trendChart.render();

    var categoryChart = new CanvasJS.Chart("categoryChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Kategori Gangguan"
        },
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($category, JSON_NUMERIC_CHECK); ?>
        }]
    });
    categoryChart.render();

// Chart FOC
var focChart = new CanvasJS.Chart("focChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Root Cause Category FOC"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
			indexLabelPlacement: "outside",
            indexLabelFontSize: 12,
            type: "column",
            dataPoints: <?php echo json_encode($arrayUrc["FOC"], JSON_NUMERIC_CHECK); ?>
        }]
    });
    focChart.render();

// Chart FOT
var fotChart = new CanvasJS.Chart("fotChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Root Cause Category FOT / Perangkat"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
			indexLabelPlacement: "outside",
            indexLabelFontSize: 12,
            type: "column",
            yValueFormatString: "#",
            dataPoints: <?php echo json_encode($arrayUrc["FOT/Perangkat"], JSON_NUMERIC_CHECK); ?>
        }]
    });
    fotChart.render();

// Chart Bukan Gangguan
    var bgChart = new CanvasJS.Chart("bgChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Kategori Bukan Gangguan"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
			indexLabelPlacement: "outside",
            indexLabelFontSize: 12,
            type: "column",
            yValueFormatString: "#",
            dataPoints: <?php echo json_encode($arrayUrc["Bukan Gangguan"], JSON_NUMERIC_CHECK); ?>
        }]
    });
    bgChart.render();

// PS Chart
    var psChart = new CanvasJS.Chart("psChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Root Cause Category Power Supply"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
			indexLabelPlacement: "outside",
            indexLabelFontSize: 12,
            type: "column",
            yValueFormatString: "#",
            dataPoints: <?php echo json_encode($arrayUrc["PS"], JSON_NUMERIC_CHECK); ?>
        }]
    });
    psChart.render();

// Software Chart
var swChart = new CanvasJS.Chart("swChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Root Cause Category Software"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
			indexLabelPlacement: "outside",
            indexLabelFontSize: 12,
            type: "column",
            yValueFormatString: "#",
            dataPoints: <?php echo json_encode($arrayUrc["Software"], JSON_NUMERIC_CHECK); ?>
        }]
    });
    swChart.render();

    var kendalaChart = new CanvasJS.Chart("kendalaChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Kategori Kendala"
        },
        axisX:{
            labelAutoFit: true,
            labelFontSize: 12,
            labelAngle: 0,
            interval: 1,
        },
        data: [{
			indexLabelPlacement: "outside",
            indexLabelFontSize: 12,
            type: "column",
            yValueFormatString: "#",
            indexLabel: "{y} [{presentase}%]",
            dataPoints: <?php echo json_encode($ukArray, JSON_NUMERIC_CHECK); ?>
        }]
    });
    kendalaChart.render();
}
</script>
@endsection

@section('card')
<div class="card-deck text-center">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <span class="info-box-text">Jumlah Work Order</span>
                <h3>{{$cardArray['regionSum']}}</h3>
                <!-- <p class="card-text">Work Order</p> -->
            </div>
        </div>
        <div class="card text-white bg-primary">
            <div class="card-body">
                <span class="info-box-text">Durasi Work Order <br/> (A+B+C+D)</span>
                <h3>{{$cardArray['totalDurasiWO']}}</h3>
                <span class="info-box-text">Menit</span>
                <!-- <p>Menit</p> -->
            </div>
        </div>
        <div class="card text-white bg-primary">
            <div class="card-body">
                <span class="info-box-text">Durasi Serpo <br/> (B+C+D)</span>
                <h3>{{$cardArray['avgTotalDurasi']}}</h3>
                <span class="info-box-text">Menit</span>
                <!-- <p>Menit</p> -->
            </div>
        </div>
        <div class="card text-white bg-primary">
            <div class="card-body">
                <span class="info-box-text">Performa RSPS</span>
                <!-- <h3 class="info-box-number">{{$cardArray['avgRSPS']*100}} %</h3> -->
                <!-- <p class="card-text">Performa RSPS</p>-->
                <h3>{{$cardArray['avgRSPS']*100}} %</h3> 
            </div>
        </div>
    </div>
    <br>
    <div class="card-deck text-center">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <span class="info-box-text">A. Durasi SBU</span>
                <!-- <span class="info-box-number">{{$cardArray['avgDurasiSBU']}}</span> -->
                <h3>{{$cardArray['avgDurasiSBU']}}</h3>
                <span class="info-box-text">Menit</span>
                <!-- <p class="card-text">A.Durasi SBU</p>
                <p>(Menit)</p> -->
            </div>
        </div>
        <div class="card text-white bg-success">
            <div class="card-body">
                <span class="info-box-text">B. Preparation Time</span>
                <h3>{{$cardArray['avgPrepTime']}}</h3>
                <!-- <span class="info-box-number">{{$cardArray['avgPrepTime']}}</span> -->
                <span class="info-box-text">Menit</span>
                <!-- <p class="card-text">B.Preparation Time</p>
                <p class="card-text">Menit</p> -->
            </div>
        </div>
        <div class="card text-white bg-danger">
            <div class="card-body">
                <span class="info-box-text">C. Travel Time</span>
                <h3 >{{$cardArray['avgTravelTime']}}</h3>
                <span class="info-box-text">Menit</span>
                <!-- <h5 class="card-title"> Menit</h5>
                <p class="card-text"></p> -->
            </div>
        </div>
        <div class="card text-white bg-yellow">
            <div class="card-body">
                <span class="info-box-text">D. Work Time</span>
                <h3>{{$cardArray['avgWorkTime']}}</h3>
                <span class="info-box-text">Menit</span>             
                <!-- <h5 class="card-title">{{$cardArray['avgWorkTime']}} Menit</h5>
                <p class="card-text">Work Time</p> -->
            </div>
        </div>
    </div>
    <br>
    <p style="color:blue">Keterangan :<br/> a. Durasi : Waktu rata-rata per Work Order <br/> b. RSPS : Rata-rata Skor Pemakaian SBU Aplikasi FSM</p>
@endsection

@section('wochart')
@if($woArray!=null)
<div class="table table-responsive table-hover table-bordered" >
    <table style="float: right" width="47%">
        <tr>
            <td>
            <div id="woChart" style="height: 300px; width: 100%;"></div>
            </td>
        </tr>
    </table>
    <table style="float: left" width="47%">
        <thead class="thead-dark">
            <tr>
                <th>SBU Regional</th>
                <th>Total Work Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach($woArray as $w)
                <tr>
                    <td>{{$w['longLabel']}}</td>
                    <td>{{$w['value']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection

@section('category')
@if($category!=null)
<div class="table table-responsive table-hover" >
    <table style="float: left" width="47%">
        <thead class="thead-dark">
            <tr>
                <th>Category Name</th>
                <th>Total Work Order</th>
                <th>Rata-rata Durasi (Menit)</th>
            </tr>
        </thead>
            @foreach($category as $c)
            <tr>
                <td>{{$c['label']}}</td>
                <td>{{$c['value']}}</td>
                <td>{{$c['durasi']}}</td>
            </tr>
            @endforeach
    </table>
    <table style="float: right" width="47%">
        <tr>
            <td>
            <div id="categoryChart" style="height: 300px;width: 100%;"></div>
            </td>
        </tr>
    </table>
</div>
@endif
@endsection

@section('keaktifanchart')
<div class="table table-responsive table-hover" >
    <table style="float: left" width="47%">
        <tr>
            <td>
            <div id="rspsChart" style="height: 300px; width: 100%;"></div>
            </td>
        </tr>
    </table>
    <table style="float: right" width="47%">
        <tr>
            <td>
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
            </td>
        </tr>
    </table>
</div>
@endsection
@section('categoryAndKendalaChart')
<!-- Chart untuk menampilkan Root cause Gangguan dan Kendala -->
<div id="focChart" style="height: 300px;width: 100%;"></div><br>
<div id="fotChart" style="height: 300px;width: 100%;"></div><br>
<div id="psChart" style="height: 300px;width: 100%;"></div><br>
<div class="table table-responsive table-hover" >
    <table style="float: left" width="47%">
        <tr><td>
            <div id="swChart" style="height: 300px;width: 100%;"></div>
        </td></tr>
    </table>
    <table style="float: right" width="47%">
        <tr><td>
            <div id="bgChart" style="height: 300px;width: 100%;"></div>
        </td></tr>
    </table>
</div><br>
<table style="align: center; width: 100%;">
        <tbody>
            <tr>
                <td>
                <div id="kendalaChart" style="height: 400px;width: 100%;"></div>
                </td>
            </tr>
        </tbody>
</table>
@endsection

@section('content')
<blockquote class="blockquote text-center">
    <h1 class="display-6">Performa Serpo Nasional</h1>
    <!-- <h3>
        <small class="text-muted">Filtered </small>
    Nasional
    </h3> -->
</blockquote>
<form method="post" action="{{route('national.store')}}">
    {{csrf_field()}}
    <div class="row">
        <div class="col-3">
            <label for="awal">Periode Awal</label>
            <input type="date" class="form-control" id="awal" name="pawal">
        </div>
        <div class="col-3">
            <label for="akhir">Periode Akhir</label>
            <input type="date" class="form-control" id="akhir" name="pakhir">
        </div>
        <div class="col">
            <br>
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-filter"></i><span> Filter</span></button>

            <!-- <input type="submit" class="btn btn-primary btn-lg" value="Filter"> -->
        </div>
    </div>
</form>
<br>
@if($nationalDataForView!=null)
<blockquote class="blockquote text-center">
    @if(($pAwal==null) && ($pAkhir==null))
        <p class="mb-0">Data All Time</p>
    @elseif($pAwal==null)
        <p class="mb-0">Data Sampai Dengan {{$pAkhir}}</p>
    @elseif($pAkhir==null)
        <p class="mb-0">Data Mulai Dari {{$pAwal}}</p>
    @else
        <p class="mb-0">Periode {{$pAwal}} s.d. {{$pAkhir}}</p>
    @endif
    <p style="color:blue">Berdasarkan Data FSM oleh Divisi Quality Performance <br/> Cetak {{$currentDate}}</p>
</blockquote>
@yield('card')
@yield('keaktifanchart')
@yield('wochart')
@yield('category')
@yield('categoryAndKendalaChart')
<br>
<div class="text-center">
    <h4>Rata - Rata Data Nasional Berdasarkan Regional (Semua Work Order)</h4>
</div>
<a href="{{route('national.create')}}" class="btn btn-success"><i class="fa fa-download"></i><span> Download</span></a>
<br>
<br>

<table class="table table-bordered table-striped table-hover" style="text-align: center;">
    <thead class="thead-dark">
        <tr valign="top" >
            <th rowspan="2">Region</th>
            <th rowspan="2">Jumlah Work Order</th>
            <th colspan="6">Average (Dalam Satuan Menit)</th>
        </tr>
        <tr>
            <th>Durasi SBU</th>
            <th>Total Durasi Serpo (A+B+C)</th>
            <th>A.Preparation Time</th>
            <th>B.Travel Time</th>
            <th>C.Working Time</th>
            <th>RSPS</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nationalDataForView as $data)
        <tr>
            <td>{{$data->region}}</td>
            <td>{{$data->jumlah_wo}}</td>
            <td>{{$data->durasi_sbu}}</td>
            <td>{{$data->total_durasi}}</td>
            <td>{{$data->prep_time}}</td>
            <td>{{$data->travel_time}}</td>
            <td>{{$data->work_time}}</td>
            <td>{{$data->rsps*100}}%</td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Table for RSPS 100 -->
<br>
<div class="text-center">
    <h4>Rata - Rata Data Nasional Berdasarkan Regional (RSPS = 100)</h4>
</div>

<table class="table table-bordered table-striped table-hover" style="text-align: center;">
    <thead class="thead-dark">
        <tr valign="top" >
            <th rowspan="2">Region</th>
            <th rowspan="2">Jumlah Work Order</th>
            <th colspan="6">Average (Dalam Satuan Menit)</th>
        </tr>
        <tr>
            <th>Durasi SBU</th>
            <th>Total Durasi Serpo (A+B+C)</th>
            <th>A.Preparation Time</th>
            <th>B.Travel Time</th>
            <th>C.Working Time</th>
            <th>RSPS</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nationalDataRsps1 as $n)
        <tr>
            <td>{{$n['region']}}</td>
            <td>{{$n['jumlah_wo']}}</td>
            <td>{{$n['durasi_sbu']}}</td>
            <td>{{$n['total_durasi']}}</td>
            <td>{{$n['prep_time']}}</td>
            <td>{{$n['travel_time']}}</td>
            <td>{{$n['work_time']}}</td>
            <td>{{$n['rsps']*100}}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif
@endsection

@section('footer')
<script>
    $(".clickable-row").click(function() {
        window.location = $(this).data("gangguanhref");
    });

    $(".kendala-row").click(function() {
        window.location = $(this).data("kendalahref");
    });
</script>
@endsection
