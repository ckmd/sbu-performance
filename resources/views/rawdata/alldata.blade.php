@extends('adminlte::page')
@section('title', 'Dashboard - All Data SBU')

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
               ajax: '{{ url('alldata-list') }}',
               columns: [
                        { data: 'Ticket ID', name: 'Ticket ID' },
                        { data: 'Incident ID', name: 'Incident ID' },
                        { data: 'Service ID', name: 'Service ID' },
                        { data: 'Customer', name: 'Customer' },
                        { data: 'Region SBU (Terminating) (Address)', name: 'Region SBU (Terminating) (Address)' },
                        { data: 'Created On', name: 'Created On' },
                        { data: 'Close Date', name: 'Close Date' },
                        { data: 'Interference Time', name: 'Interference Time' },
                        { data: 'Service ID Status', name: 'Service ID Status' },
                        { data: 'Product', name: 'Product' },
                        { data: 'Bulan', name: 'Bulan' },
                        { data: 'Minggu', name: 'Minggu' },
                        { data: 'Hari', name: 'Hari' },
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
         <div class="card-header">View All Data SBU</div>

         <div class="card-body">
            <a href="{{route('rawdata.create')}}" class="btn btn-success disabled"><i class="fa fa-download"></i><span> Download</span></a>
            <a href="deleteExcel" class="btn btn-danger disabled"><i class="fa fa-trash"></i><span> Hapus Data</span></a>
            <br> <br>
            <table class="table table-hover table-bordered" id="table" style="white-space: nowrap;">
               <thead>
                  <tr>
                     <th>Ticket ID</th>
                     <th>Incident ID</th>
                     <th>Service ID</th>
                     <th>Customer</th>
                     <th>Region SBU (Terminating) (Address)</th>
                     <th>Created On</th>
                     <th>Close Date</th>
                     <th>Interference Time</th>
                     <th>Service ID Status</th>
                     <th>Product</th>
                     <th>Bulan</th>
                     <th>Minggu</th>
                     <th>Hari</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </div>
</div>
@stop