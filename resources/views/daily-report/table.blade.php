<div class="card">
    <div class="card-header">REGION SBU : {{ $sbu }}</div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-12" style="width: 100%;">
                <font size="1">
                <table class="table table-bordered text-center table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Incident ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Created On</th>
                            <th>Status Reason</th>
                            <th>Team Issue</th>
                            <th>Summary Problem</th>
                            <th>Address (Terminating Address)</th>
                            <th>Durasi (Total)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyReportFilteredBySBUdanTanggal as $item)
                            <tr>
                                <th>{{ $item->ticket_id }}</th>
                                <td>{{ $item->incident_id }}</td>
                                <td>{{ $item->customer }}</td>
                                <td>{{ $item->product }}</td>
                                <td>{{ $item->created_on }}</td>
                                <td>{{ $item->status_reason }}</td>
                                <td>{{ $item->team_issue }}</td>
                                <td>{{ $item->summary_problem }}</td>
                                <td>{{ $item->address_terminating }}</td>
                                <td>{{ $item->interference_net_duration }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </font>
            </div>
        </div>
    </div>
</div>