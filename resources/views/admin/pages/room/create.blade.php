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
                        <label class="form-label" for="name">Room Number</label>
                        <input type="text" class="form-control" name="name">

                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="floor">Room Floor</label>
                        {{-- <input type="text" class="form-control" name="lantai"> --}}
                        <select name="lantai" class="form-control" required>
                            <option value="">Choose one</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                        </select>

                        @if ($errors->has('lantai'))
                            <span class="text-danger">{{ $errors->first('lantai') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="gender">Room Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">-- Choose Gender --</option>
                            <option value="Pria">Male</option>
                            <option value="Wanita">Female</option>
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