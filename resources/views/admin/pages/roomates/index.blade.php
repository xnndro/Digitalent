@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Roomates Request</h4>
                        </div>
                    
                    </div>
                    <div class="p-0 card-body">
                    @if($count == 0)
                        <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                            <div class="text-center">
                                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_DYkRIb.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                                <h5 class="mt-n2">There are no roommate requests at this time</h5>
                            </div>
                        </div> 
                    @else
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Request</th>
                                        <th>User Requested</th>
                                        <th>Class</th>
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
                                            <h6>{{ $r->user_name }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $r->requested_user_name }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $r->class_name}}</h6>
                                        </td>
                                        <td>
                                            <a href="{{ route('roommates.details', $r->id) }}" class="btn btn-primary">Accept</a>
                                            <a href="{{ route('roommates.reject', $r->id) }}" class="btn btn-danger">Reject</a>
                                            
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