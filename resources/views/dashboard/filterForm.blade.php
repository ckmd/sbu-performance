<!-- <form id="queryForm" action=""> -->
<form action="{{route('home.post')}}" id="" method="POST"  enctype="multipart/form-data">
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
                <!-- <input class="form-control" type="date" name="" id=""> -->
            </div>
        </div>
    <!-- </div>
    <div class="row input-daterange datepicker align-items-center">
        <div class="col">
            <div class="form-group">
                <label for="tanggal_awal">Tanggal Awal <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control" name="start" id="tanggal_awal" placeholder="Tanggal Awal" type="text" required>
                    @error('tanggal_awal')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="tanggal_akhir">Tanggal Akhir <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control" placeholder="Tanggal Akhir" type="text" name="end" id="tanggal_akhir" required>
                    @error('tanggal_akhir')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div> -->

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