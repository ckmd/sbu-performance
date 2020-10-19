@extends('adminlte::page')
@section('title', 'All Data SBU')

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
                  { data: 'ticket_id', name: 'ticket_id' },
                  { data: 'incident_id', name: 'incident_id' },
                  { data: 'service_id', name: 'service_id' },
                  { data: 'customer', name: 'customer' },
                  { data: 'created_on', name: 'created_on' },
                  { data: 'interference_net_duration', name: 'interference_net_duration' },
                  { data: 'region_sbu', name: 'region_sbu' },
                  { data: 'product', name: 'product' },
                  { data: 'interference', name: 'interference' },                        
                  { data: 'month', name: 'month' },
                  { data: 'week', name: 'week' },
                  { data: 'day', name: 'day' },
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
            <a href="{{route('rawdata.download')}}" class="btn btn-success disabled"><i class="fa fa-download"></i><span> Download</span></a>
            <a href="{{route('rawdata.delete')}}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus semua rawdata ?');"><i class="fa fa-trash"></i><span> Hapus Data</span></a>
            <br> <br>
            <table class="table table-hover table-bordered" id="table" style="white-space: nowrap;">
               <thead>
                  <tr>
                     <th>Ticket ID</th>
                     <th>Incident ID</th>
                     <th>Service ID</th>
                     <th>Customer</th>
                     <th>Created On</th>
                     <th>Interference Net Duration</th>
                     <th>Region SBU (Terminating) (Address)</th>
                     <th>Product</th>
                     <th>Interference</th>
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