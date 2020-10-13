@extends('adminlte::page')
@section('title', 'Dashboard - Daily Report')
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <!-- Chart untuk Year to date -->
    <script>
        var ctx = document.getElementById('ticketChart').getContext('2d');
        var ticketOpenToday = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['Progress', 'Stop Clock'],
                datasets: [
                    {
                        backgroundColor: 'rgba(113, 168, 217, 0.2)',
                        borderColor: 'rgba(113, 168, 217, 0.6)',
                        borderWidth: 2,
                        label: 'Total',
                        data : [
                            <?php echo json_encode($progress ?? '');?>, <?php echo json_encode($stopClock ?? '');?>
                        ]
                    }],
                // labels: <?php echo json_encode($ytdBulanKe ?? '');?>,
                // datasets: [
                // {
                //     label: 'Nasional',
                //     lineTension: 0,
                //     backgroundColor: 'transparent',
                //     borderColor: 'rgb(255, 99, 132)',
                //     data: <?php echo json_encode($ytdNasionalVal ?? ''); ?>,
                // }, 
                // {
                //     label: <?php echo json_encode($sbu ?? ''); ?>,
                //     lineTension: 0,
                //     backgroundColor: 'transparent',
                //     borderColor: 'rgb(99, 255, 132)',
                //     data: <?php echo json_encode($ytdSBUVal ?? ''); ?>
                // },
                // {
                //     label: 'KPI',
                //     lineTension: 0,
                //     backgroundColor: 'transparent',
                //     borderColor: 'rgb(99, 132, 255)',
                //     data: <?php echo json_encode($kpiVal ?? ''); ?>
                // },
                // ],
            },

            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Ticket Open Today',
                    fontSize: 15
                },
                legend:{
                    position: 'right',
                },
                responsive: true,
                    scales: {
                    yAxes: [{
                        afterDataLimits(scale) {
                            scale.max += 20;
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: Math.round,
                        font: {
                        weight: 'bold'
                        }
                    }
                    }
            }
        });
    </script>
    {{-- Issue Team Chart --}}
    <script>
        var ctx = document.getElementById('issueTeam').getContext('2d');
        var issueTeamChart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($teamIssueCategory ?? ''); ?>,
                datasets: [
                    {
                        backgroundColor: 'rgba(113, 168, 217, 0.5)',
                        borderColor: 'rgba(113, 168, 217, 0.6)',
                        borderWidth: 2,
                        label: 'Issue Team',
                        data : <?php echo json_encode($teamIssueValue ?? ''); ?>,
                    }],
            },

            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Issue Team',
                    fontSize: 15
                },
                legend:{
                    position: 'right',
                },
                responsive: true,
                    scales: {
                    yAxes: [{
                        afterDataLimits(scale) {
                            scale.max += 20;
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: Math.round,
                        font: {
                        weight: 'bold'
                        }
                    }
                    }
            }
        });
    </script>
    {{-- stacked bar chart --}}
    <script>
        var ctx = document.getElementById('top3Product').getContext('2d');
        var top3ProductChart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($top3ProductCategory ?? ''); ?>,
                datasets: [
                    {
                        backgroundColor: 'rgba(113, 168, 217, 0.2)',
                        borderColor: 'rgba(113, 168, 217, 0.6)',
                        borderWidth: 2,
                        label: 'Progress',
                        data : <?php echo json_encode($top3ProductValueProgress ?? ''); ?>,
                    },
                    {
                        backgroundColor: 'rgba(238, 142, 78, 0.2)',
                        borderColor: 'rgba(238, 142, 78, 0.6)',
                        borderWidth: 2,
                        label: 'Stop Clock',
                        data : <?php echo json_encode($top3ProductValueStopClock ?? ''); ?>,
                    }
                ],
            },

            // Configuration options go here
            options: {
                barRadius: 0,
                title: {
                    display: true,
                    text: 'Top 3 Product',
                    fontSize: 15
                },
                legend:{
                    position: 'right',
                },
                responsive: true,
                plugins: {
                    datalabels: {
                        anchor: 'center',
                        align: 'center',
                        formatter: Math.round,
                        font: {
                            weight: 'bold'
                        },
                        formatter: function(value, index, values) {
                            if(value >0 ){
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                value = value.join(',');
                                return value;
                            }else{
                                value = "";
                                return value;
                            }
                        },
                    }
                },
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true,
                        afterDataLimits(scale) {
                            scale.max += 20;
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
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
                <div class="card-header">Daily Report - Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id='loader' style='display: none;'>
                        <p>Please Wait ...</p>
                    </div>
                    <p>Rawdata Daily Report yang telah diupload dari {{$firstData}} hingga {{$lastData}}</p>

                    @include('daily-report.filterForm')
                </div>
            </div>
            @if($showChart == true)
                @include('daily-report.header')
                @include('daily-report.chart')
                @include('daily-report.table')
            @endif
        </div>
    </div>
</div>
@stop
