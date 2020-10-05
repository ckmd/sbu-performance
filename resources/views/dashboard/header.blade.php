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
        <button class="btn btn-success" onclick="window.print()"><i class="fa fa-download"></i> <span> Download to PDF</span></button>
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalMail"><i class="fa fa-envelope"></i> <span> Send PDF to SBU</span></button>
    </div>
</div>

<!-- Modal Send Mail -->
<div class="modal fade bd-example-modal-lg" id="modalMail" tabindex="-1" role="dialog" aria-labelledby="modalMailTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Mail to {{ $sbu }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('mail.send')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-form-label">Recipient List :</label>
                        @for($i = 0; $i < 5; $i++)
                        <div class="form-check">
                            <input class="form-check-input" name="penerima[]" type="checkbox" id="inlineCheckbox{{ $i }}" value="option{{ $i }}">
                            <label class="form-check-label" for="inlineCheckbox{{ $i }}">Penerima {{ $i }}</label>
                        </div>
                        @endfor
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-form-label">Subject* :</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message* :</label>
                        <textarea class="form-control" id="message-text" name="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="attachment" class="col-form-label">Attachment* :</label>
                        <input type="file" class="form-control" id="attachment" name="attachment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">View PDF</button>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to send this Mail ?');">Send Mail</button>
                </div>
            </form>
        </div>
    </div>
</div>