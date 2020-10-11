@extends('adminlte::page')
@section('title', 'Dashboard - SBU Performance')
@section('js')
    <!-- Javascript for handling ajax request -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
    $('#queryForm').on('submit',function(event){
        event.preventDefault();

        sbu = $('#sbu').val();
        start = $('#start').val();
        end = $('#end').val();
        $.ajax({
          url: "/home",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            sbu:sbu,
            start:start,
            end:end,
          },
          beforeSend: function(){
            // Show image container
            $("#loader").show();
        },
        success:function(response){
            // var json = $.parseJSON(response);
            $('#message').fadeOut('');
            // $("#msg").html(data.msg);
            console.log(response);
          },
          complete:function(data){
            // Hide image container
            $("#loader").hide();
        }
         });
        });
    </script>
    <!-- javascript for handling chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <!-- Chart untuk Year to date -->
    <script>
        var ctx = document.getElementById('yearToDateChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                labels: <?php echo json_encode($ytdBulanKe ?? '');?>,
                datasets: [
                {
                    label: 'Nasional',
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(255, 99, 132)',
                    data: <?php echo json_encode($ytdNasionalVal ?? ''); ?>,
                }, 
                {
                    label: <?php echo json_encode($sbu ?? ''); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(99, 255, 132)',
                    data: <?php echo json_encode($ytdSBUVal ?? ''); ?>
                },
                {
                    label: 'KPI',
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(99, 132, 255)',
                    data: <?php echo json_encode($kpiVal ?? ''); ?>
                },
                ],
            },

            // Configuration options go here
            options: {
            }
        });
    </script>
    <!-- Chart untuk Bulanan -->
    <script>
        var ctx = document.getElementById('monthlyChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                labels: <?php echo json_encode($bulanKe ?? '');?>,
                datasets: [
                {
                    label: 'Nasional',
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(255, 99, 132)',
                    data: <?php echo json_encode($nationalBulanVal ?? ''); ?>,
                }, 
                {
                    label: <?php echo json_encode($sbu ?? ''); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(99, 255, 132)',
                    data: <?php echo json_encode($bulanVal ?? ''); ?>
                },
                ],
            },

            // Configuration options go here
            options: {
            }
        });
    </script>
    <!-- Chart untuk mingguan -->
    <script>
        var ctx = document.getElementById('weeklyChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                labels: <?php echo json_encode($mingguKe ?? '');?>,
                datasets: [
                {
                    label: 'Nasional',
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(255, 99, 132)',
                    data: <?php echo json_encode($nationalMingguVal ?? ''); ?>,
                }, 
                {
                    label: <?php echo json_encode($sbu ?? ''); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(99, 255, 132)',
                    data: <?php echo json_encode($mingguVal ?? ''); ?>
                },
                ],
            },

            // Configuration options go here
            options: {
            }
        });
    </script>
    <!-- Chart untuk harian -->
    <script>
        var ctx = document.getElementById('dailyChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                labels: <?php echo json_encode($hariKe ?? '');?>,
                datasets: [
                {
                    label: 'Nasional',
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(255, 99, 132)',
                    data: <?php echo json_encode($nationalHariVal ?? ''); ?>,
                }, 
                {
                    label: <?php echo json_encode($sbu ?? ''); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(99, 255, 132)',
                    data: <?php echo json_encode($hariVal ?? ''); ?>
                },
                ],
            },

            // Configuration options go here
            options: {
            }
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'message' );
    </script>
@stop
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id='loader' style='display: none;'>
                        <p>Please Wait ...</p>
                    </div>
                    <!-- <div id = 'msg'>This message will be replaced using Ajax.</div> -->
                    <p>Rawdata SBU yang telah diupload dari {{$firstData}} hingga {{$lastData}}</p>

                    @include('dashboard.filterForm')
                </div>
            </div>
            @if($showChart == true)
            @include('dashboard.header')
            @include('dashboard.yearToDate')
            @include('dashboard.monthly')
            @include('dashboard.weekly')
            @include('dashboard.daily')
            @endif
        </div>
    </div>
</div>
@stop
