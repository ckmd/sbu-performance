@extends('adminlte::page')
@section('title', 'Dashboard - Home')
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Nasional',
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45]
                }, {
                    label: 'SBU xxx',
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(99, 255, 132)',
                    data: [12, 5, 4, 11, 25, 20, 35]
                }, {
                    label: 'KPI',
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(132, 99, 255)',
                    data: [20, 20, 20, 20, 20, 20, 20]
                }],
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
                    <p>Data Ditampilkan Dari {{$firstData}} Hingga {{$lastData}}</p>
                    <h3>Year to date Monitoring</h3>
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">SBU Region</label>
                                    <select class="custom-select" id="inputGroupSelect04">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <!-- <input class="form-control" type="date" name="" id=""> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input class="form-control" type="date" name="" id="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input class="form-control" type="date" name="" id="">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-10">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="col-md-2">
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
                                <p>Realisasi KPI SBU xxx </p>
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
