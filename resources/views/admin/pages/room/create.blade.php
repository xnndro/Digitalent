@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Rooms</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('rooms.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Rooms Name</label>
                        <input type="text" class="form-control" name="name">

                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="floor">Rooms Floor</label>
                        <input type="text" class="form-control" name="lantai">

                        @if ($errors->has('lantai'))
                            <span class="text-danger">{{ $errors->first('lantai') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="gender">Rooms Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>

                        @if($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection