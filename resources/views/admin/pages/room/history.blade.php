@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Room History</h4>
                        </div>
                    
                    </div>
                    <div class="p-0 card-body">
                    @if($count == 0)
                        <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                            <div class="text-center">
                                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_vgumtcs7.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                                <h5 class="mt-n2">No occupied rooms at this time</h5>
                            </div>
                        </div> 
                    @else
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Room Name</th>
                                        <th>Room Floor</th>
                                        <th>Room Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($rooms as $r)
                                    <tr>
                                        <td>
                                            <h6>{{ $i }}</h6>
                                        </td>
                                        @php
                                            $i++;
                                        @endphp
                                        <td>
                                            <h6>{{ $r->name }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $r->lantai }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$r->gender}}</h6>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection