<div class="card">
    <div class="card-header">Query information</div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Query Date</th>
                        <td>{{$now}}</td>
                    </tr>
                    <tr>
                        <th>SBU Region</th>
                        <td>{{$sbu}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Start Date</th>
                        <td>{{$start}}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{$end}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <button class="btn btn-success" disabled="disabled"><i class="fa fa-download"></i> <span> Download to PDF</span></button>
        <button class="btn btn-primary" disabled="disabled"><i class="fa fa-envelope"></i> <span> Send PDF to SBU</span></button>
    </div>
</div>