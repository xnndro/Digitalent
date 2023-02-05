@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Accept Roomates Request</h4>
                </div>
            </div>
            <div class="card-body">
                @foreach ($roommates as $roommates)
                <form action="{{ route('roommates.store_details', $roommates->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">User Request</label>
                        <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $roommates->user_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="user_id">User Requested</label>
                        <input type="text" name="requested_user_id" id="requested_user_id" class="form-control" value="{{ $roommates->requested_user_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Class</label>
                        <input type="text" name="class_id" id="class_id" class="form-control" value="{{ $roommates->gender }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="room_id">Select Room</label>
                        <select name="room_id" id="room_id" class="form-control" required>
                            @if($count == 0)
                                <option value="">No Room Added</option>
                            @else
                                @foreach ($room as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Next</button>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection