<div class="card card-outline card-primary">
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
                        <td>
                            @if(is_null($start))
                                All Data
                            @else 
                                {{ $start }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>
                            @if(is_null( $end ))
                                All Data
                            @else 
                                {{ $end }}
                            @endif                        
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <form action="{{route('rawdata.export')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="sbu" value="{{ $sbu }}">
                <input type="hidden" name="start" value="{{ $start }}">
                <input type="hidden" name="end" value="{{ $end }}">
                <button type="submit" class="btn btn-success mx-1" ><i class="fa fa-table"></i> <span> Download to Excel</span></button>
            </form>
            <button class="btn btn-success mx-1" onclick="window.print()"><i class="fa fa-download"></i> <span> Download to PDF</span></button>
            <button class="btn btn-primary mx-1" type="button" data-toggle="modal" data-target="#modalMail"><i class="fa fa-envelope"></i> <span> Send PDF to SBU</span></button>
        </div>
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
                        @foreach ($recipients as $item)
                        <div class="form-check">
                            <input class="form-check-input" name="penerima[]" type="checkbox" id="inlineCheckbox{{ $item->id }}" value="{{ $item->email }}" checked>
                            <label class="form-check-label" for="inlineCheckbox{{ $item->id }}">{{ $item->email }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-form-label">Subject* :</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="{{ $templateMail->subject }}" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message* :</label>
                        <textarea class="form-control" id="message-text" name="message" required>{{ $templateMail->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="attachment" class="col-form-label">Attachment* :</label>
                        <input type="file" class="form-control" id="attachment" name="attachment[]" required multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to send this Mail ?');">Send Mail</button>
                </div>
            </form>
        </div>
    </div>
</div>