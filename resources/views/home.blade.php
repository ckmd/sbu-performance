@extends('adminlte::page')
@section('title', 'Dashboard - Home')
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
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
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
                    data: <?php echo json_encode($nationalVal ?? ''); ?>,
                }, 
                {
                    label: <?php echo json_encode($sbu ?? ''); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(99, 255, 132)',
                    data: <?php echo json_encode($mingguVal ?? ''); ?>
                },
                // {
                //     label: 'KPI',
                //     backgroundColor: 'transparent',
                //     borderColor: 'rgb(132, 99, 255)',
                //     data: [200, 20, 20, 20, 20]
                // }
                ],
            },

            // Configuration options go here
            options: {
            }
        });
    </script>
@stop
@section('content')
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
                    <p>Data yang telah diupload dari {{$firstData}} hingga {{$lastData}}</p>
                    <h3>Year to date Monitoring</h3>
                    <!-- <form id="queryForm" action=""> -->
                    <form action="/home" id="" method="POST"  enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">SBU Region</label>
                                    <select class="custom-select" id="sbu" name="sbu">
                                        <option selected>Choose...</option>
                                        @foreach($sbuRegion as $key => $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input class="form-control" type="date" name="" id=""> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input class="form-control" type="date" name="start" id="start">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input class="form-control" type="date" name="end" id="end">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="submit">Submit</button>
                        </div>

                    </form>
                    <div class="row">
                        <div class="col-md-9">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <p>Realisasi KPI Nasional</p>
                                <div class="col-md-6">
                                    <p>600</p>
                                    <p>Menit</p>
                                </div>
                                <div class="col-md-6">
                                    <p>86</p>
                                    <p>Percent</p>
                                </div>
                            </div>
                            <div class="row">
                                <p>Realisasi KPI&nbsp;<div id = 'msg'>SBU ... &ensp;</div></p>
                                
                                <div class="col-md-6">
                                    <p>600</p>
                                    <p>Menit</p>
                                </div>
                                <div class="col-md-6">
                                    <p>86</p>
                                    <p>Percent</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Monthly Monitoring</h3>
                    <canvas id="myChart"></canvas>

                    <h3>Weekly Monitoring</h3>
                    <canvas id="myChart"></canvas>

                    <h3>Daily Monitoring</h3>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
