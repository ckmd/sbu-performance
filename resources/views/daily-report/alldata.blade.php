@extends('adminlte::page')
@section('title', 'All Data Daily Report')

@section('css')
    <link href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $('#table').DataTable({
            processing: true,
            serverSide: true,
            "scrollX": true,
            ajax: '{{ url('alldata-daily-report-list') }}',
            columns: [
                { data: 'ticket_id', name: 'ticket_id' },
                { data: 'incident_id', name: 'incident_id' },
                { data: 'interference_time', name: 'interference_time' },
                { data: 'region_sbu', name: 'region_sbu' },
                { data: 'service_id', name: 'service_id' },
                { data: 'customer', name: 'customer' },
                { data: 'product', name: 'product' },
                { data: 'address_terminating', name: 'address_terminating' },
                { data: 'summary_problem', name: 'summary_problem' },
                { data: 'status_reason', name: 'status_reason' },
                { data: 'team_issue', name: 'team_issue' },
                { data: 'stop_clock_duration', name: 'stop_clock_duration' },
                { data: 'created_on', name: 'created_on' },
                { data: 'close_date', name: 'close_date' },
                { data: 'interference_net_duration', name: 'interference_net_duration' },
                { data: 'address', name: 'address' },
                { data: 'province', name: 'province' },
                { data: 'state', name: 'state' },
                { data: 'total_amount', name: 'total_amount' },
                { data: 'service_id_status', name: 'service_id_status' },
                { data: 'bandwidth', name: 'bandwidth' },
            ]
        });
    });
    </script>
@stop

@section('content')

<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">View All Data Daily Report</div>

            <div class="card-body">
                <a href="" class="btn btn-success disabled"><i class="fa fa-download"></i><span> Download</span></a>
                <a href="{{route('daily-report.delete')}}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus semua rawdata daily report ?');"><i class="fa fa-trash"></i><span> Hapus Data</span></a>
                <br> <br>
                <table class="table table-hover table-bordered" id="table" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Incident ID</th>
                        <th>Interference Time</th>
                        <th>Region SBU</th>
                        <th>Service ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Address Terminating</th>
                        <th>Summary Problem</th>
                        <th>Status Reason</th>
                        <th>Team Issue</th>
                        <th>Stop Clock Duration</th>
                        <th>Created On</th>
                        <th>Close Date</th>
                        <th>Interference Net Duration</th>
                        <th>Address</th>
                        <th>Province</th>
                        <th>State</th>
                        <th>Total Amount</th>
                        <th>Service ID Status</th>
                        <th>Bandwith</th>
                    </tr>
                </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop