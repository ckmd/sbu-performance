@extends('adminlte::page')
@section('title', 'Performa Regional')

@section('header')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Trend Performa RSPS Regional"
        },
        data: [{
            type: "line",
            yValueFormatString: "#,##0.00\"%\"",
            dataPoints: <?php echo json_encode($chartArray, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    // var rootCauseChart = new CanvasJS.Chart("rootCauseChart", {
    //     theme: "light2", // "light1", "dark1", "dark2"
    //     animationEnabled: true, 		
    //     title:{
    //         text: "Kategori Gangguan"
    //     },
    //     data: [{
    //         type: "column",
    //         yValueFormatString: "#,##0.00\"%\"",
    //         // indexLabel: "{label} ({y})",
    //         dataPoints: <?php echo json_encode($urcdArray, JSON_NUMERIC_CHECK); ?>
    //     }]
    // });
    // rootCauseChart.render();

// Category
var catChart = new CanvasJS.Chart("catChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Category"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
            indexLabelFontSize: 12,
            // showInLegend: "true",
			// legendText: "{label}",
            indexLabel: "{label} (#percent%)",
            type: "pie",
            dataPoints: <?php echo json_encode($category, JSON_NUMERIC_CHECK); ?>
        }]
    });
    catChart.render();

// Chart FOC
    @if($arrayUrc["FOC"][0]["label"]!="tidak ada gangguan")
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
    @endif

// Chart FOT
    @if($arrayUrc["FOT/Perangkat"][0]["label"]!="tidak ada gangguan")
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
    @endif

// Chart Bukan Gangguan
    @if($arrayUrc["Bukan Gangguan"][0]["label"]!="tidak ada gangguan" && $arrayUrc["Software"][0]["label"]!="tidak ada gangguan")
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
    @endif

// PS Chart
    @if($arrayUrc["PS"][0]["label"]!="tidak ada gangguan")
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
    @endif

// TerminasiChart
var terminasiChart = new CanvasJS.Chart("terminasiChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "Top 10 POP Terminasi Work Order"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
            indexLabelFontSize: 12,
            type: "column",
            yValueFormatString: "#",
            indexLabel: "{y} [{presentase}%]",
            dataPoints: <?php echo json_encode($countPop, JSON_NUMERIC_CHECK); ?>
        }]
    });
    terminasiChart.render();
    
// Kendala Chart
    var kendalaChart = new CanvasJS.Chart("kendalaChart", {
        theme: "light2", // "light1", "dark1", "dark2"
        animationEnabled: true, 		
        title:{
            text: "List Kendala Work Order"
        },
        axisX:{
            labelFontSize: 12,
            interval: 1,
            labelAngle: 0
        },
        data: [{
            indexLabelFontSize: 12,
            type: "column",
            dataPoints: <?php echo json_encode($ukArray, JSON_NUMERIC_CHECK); ?>
        }]
    });
    kendalaChart.render();
}
</script>
@endsection

@if($dbAvgExcel!=null)
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
    @section('chart')
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
    <br>
    <?php
    $awal = $pAwal;
    $akhir = $pAkhir;
    if($pAkhir==null && $pAwal==null){
        $awal = '*';
        $akhir = '*';
    }else if($pAkhir==null){
        $akhir = '*';
    }else if($pAwal==null){
        $awal = '*';
    }
    ?>
    <!-- Chart untuk persebaran category -->
    <div class="table table-responsive table-hover" >
        <table style="float: left" width="47%">
            <thead class="thead-dark">
                <tr>
                    <th>Category Name</th>
                    <th>Total Work Order</th>
                    <th>Rata-rata Durasi (menit)</th>
                </tr>
            </thead>
                @foreach($category as $c)
                <tr>
                    <td>{{$c['label']}}</td>
                    <td>{{$c['y']}}</td>
                    <td>{{$c['durasi']}}</td>
                </tr>
                @endforeach
        </table>
        <table style="float: right" width="47%">
            <tr><td>
                <div id="catChart" style="height: 280px;width: 100%;"></div>
            </td></tr>
        </table>
    </div>
    <div id="terminasiChart" style="height: 300px;width: 100%;"></div><br>
    <div>
    <table class="table table-center table-hover table-bordered" style="text-align:center;">
        <thead class="thead-dark">
            <tr>
                <th rowspan="2">Kode POP</th>
                <th rowspan="2">Nama POP</th>
                <th rowspan="2">Total Work Order</th>
                <th colspan="5">Kategori Gangguan</th>
            </tr>
            <tr>
                <th>Bukan Gangguan</th>
                <th>FOC</th>
                <th>FOT / Perangkat</th>
                <th>Power Supply</th>
                <th>Software</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countPop as $cp)
                <tr>
                    <td>{{$cp['label']}}</td>
                    <td style="text-align:left;">{{$cp['desc']}}</td>
                    <td>{{$cp['y']}}</td>
                    <td>{{$cp['bukangg']}}</td>
                    <td>{{$cp['foc']}}</td>
                    <td>{{$cp['fot']}}</td>
                    <td>{{$cp['ps']}}</td>
                    <td>{{$cp['software']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Chart untuk menampilkan Root cause Gangguan dan Kendala -->
    @if($arrayUrc["FOC"][0]["label"]!="tidak ada gangguan")
    <div id="focChart" style="height: 300px;width: 100%;"></div><br>
    @endif
    @if($arrayUrc["FOT/Perangkat"][0]["label"]!="tidak ada gangguan")
    <div id="fotChart" style="height: 300px;width: 100%;"></div><br>
    @endif
    @if($arrayUrc["PS"][0]["label"]!="tidak ada gangguan")
    <div id="psChart" style="height: 300px;width: 100%;"></div><br>
    @endif
    @if($arrayUrc["Bukan Gangguan"][0]["label"]!="tidak ada gangguan" && $arrayUrc["Software"][0]["label"]!="tidak ada gangguan")
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
    </div>
    @endif
    <br>
    <div id="kendalaChart" style="height: 400px;width: 100%;"></div>
    @endsection
@endif

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center">
                <h1 class="display-6">Performa Serpo Regional</h1>
            </div>
            <form method="post" action="{{route('home')}}">
            {{csrf_field()}}
                <div class="row">
                    <div class="col">
                    <label for="reg">Region / Wilayah</label>
                    <select name="region" class="form-control" id="reg">
                        <option value="">-- Pilih Region --</option>
                        @foreach($unique as $u)
                            <option value="{{$u}}">{{$u}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col">
                        <label for="awal">Periode Awal</label>
                        <input type="date" class="form-control" id="awal" name="pawal">
                    </div>
                    <div class="col">
                        <label for="akhir">Periode Akhir</label>
                        <input type="date" class="form-control" id="akhir" name="pakhir">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i><span> Filter</span></button>
                    </div>
                        </form>
                        <br>
                        @if($dbAvgExcel!=null)
                </div>
        </div>
    </div>
</div>

                <blockquote class="blockquote text-center">
                <h3>
                    <small class="text-muted">Filtered by SBU </small>
                Region {{$regionLongName}}
                </h3>
                @if(($pAwal==null) && ($pAkhir==null))
                    <p class="mb-0">Data All Time</p>
                @elseif($pAwal==null)
                    <p class="mb-0">Data Sampai Dengan {{$pAkhir}}</p>
                @elseif($pAkhir==null)
                    <p class="mb-0">Data Mulai Dari {{$pAwal}}</p>
                @else
                    <p class="mb-0">Periode {{$pAwal}} s.d. {{$pAkhir}}</p>
                @endif
                <!-- <footer class="blockquote-footer">avg (rata rata) waktu dalam satuan menit</footer> -->
                <p style="color:blue">Berdasarkan Data FSM oleh Divisi Quality Performance <br/> Cetak {{$currentDate}}</p>
            </blockquote>
            <br>
            @yield('card')
            @yield('chart')
            <br>
            <div class="text-center">
                <h3>Data Performa Rata - Rata Serpo Region {{$regionLongName}}</h3>
            </div>
            <form method="post" action="{{route('allData.store')}}">
                    {{csrf_field()}}
                        <input type="hidden" name="awal" value="{{$pAwal}}">
                        <input type="hidden" name="akhir" value="{{$pAkhir}}">
                        <input type="hidden" name="region" value="{{$regionName}}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-download"></i><span> Download</span></button>
            </form>
            <br>
            <table class="table table-striped table-hover table-bordered" >
                <thead valign="middle" class="thead-light" style="text-align: center;">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Basecamp</th>
                        <th rowspan="2">Service Point</th>
                        <th rowspan="2">Jumlah Work Order</th>
                        <th colspan="6">Average (Dalam Satuan Menit)</th>
                    </tr>
                    <tr>
                        <th>Durasi SBU</th>
                        <th>Total Durasi Serpo (A+B+C)</th>
                        <th>A.Prep Time</th>
                        <th>B.Travel Time</th>
                        <th>C.Working Time</th>
                        <th>RSPS</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                <?php $i = 1; ?>
            @foreach($dbAvgExcel as $data)
                    <tr>
                        <th>{{$i}}</th>
                        <td class="text-left">{{$data->basecamp}}</td>
                        <td class="text-left">{{$data->serpo}}</td>
                        <td>{{$data->jumlah_wo}}</td>
                        <td>{{round($data->durasi_sbu,2)}}</td>
                        @if($data->total_durasi!=null)
                        <td>{{round($data->total_durasi,2)}}</td>
                        @else
                        <td>n.a</td>
                        @endif
                        @if($data->prep_time!=null)
                        <td>{{round($data->prep_time,2)}}</td>
                        @else
                        <td>n.a</td>
                        @endif
                        @if($data->travel_time!=null)
                        <td>{{round($data->travel_time,2)}}</td>
                        @else
                        <td>n.a</td>
                        @endif
                        @if($data->work_time!=null)
                        <td>{{round($data->work_time,2)}}</td>
                        @else
                        <td>n.a</td>
                        @endif
                        <td>{{$data->rsps*100}}%</td>
                    </tr>
                    <?php $i++; ?>
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
