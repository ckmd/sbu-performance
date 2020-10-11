<div class="card">
    <div class="card-header">MONITORNG (DAILY) - OPEN TICKET LAYANAN PUBLIK : {{ $sbu }} &ensp; {{ $now }}</div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-12" style="width: 100%;">
                <table class="table table-bordered text-center table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Ticket status</th>
                            <th>Jumlah Ticket</th>
                            <th>Average of duration [Menit]</th>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <th>Progress</th>
                            <td>{{ $progress }}</td>
                            <td>{{ $rataProgress }}</td>
                        </tr>
                        <tr>
                            <th>Stop Clock</th>
                            <td>{{ $stopClock }}</td>
                            <td>{{ $rataStopClock }}</td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <td>{{ $grandTotal }}</td>
                            <td>{{ $rataGrandTotal }}</td>
                        </tr>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>