<!-- <form id="queryForm" action=""> -->
    <form action="{{route('dashboard-rekon.post')}}" id="" method="POST"  enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">SBU Region</label>
                        <select class="custom-select" id="sbu" name="sbu">
                            <option selected value="">Choose...</option>
                            @foreach($sbuRegion as $key => $value)
                                <option value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
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