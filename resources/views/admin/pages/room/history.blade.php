@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Occupied Room</h4>
                        </div>
                    
                    </div>
                    <div class="p-0 card-body">
                    @if($count == 0)
                        <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                            <div class="text-center">
                                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_vgumtcs7.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                                <h5 class="mt-n2">No Occupied Rooms at This Time</h5>
                            </div>
                        </div> 
                    @else
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                        <thead>
                            <tr class="ligth">
                                <th>No</th>
                                <th>Room Number</th>
                                <th>Room Floor</th>
                                <th>Room Gender</th>
                                <th>User Name</th>
                                <th>User Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($roommates as $r)
                                <tr>
                                    <td>
                                        <h6>{{ $i }}</h6>
                                    </td>
                                    @php
                                        $i++;
                                    @endphp
                                    <td>
                                        <h6>{{ $r->room_name }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $r->lantai }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$r->gender}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$r->user_name}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$r->requested_user_name}}</h6>
                                    </td>
                                    <td>
                                        <form action="{{ route('rooms.delete', $r->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection