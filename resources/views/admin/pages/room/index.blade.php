@extends('admin.layouts.default')

@section('content')
<div class="row">
    @if($count == 0)
        <div class="col-lg-12">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_vgumtcs7.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-n2">No rooms available at this time</h5>
                    </div>
                </div> 
            </div>
        </div>
    @else
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="bg-info text-white rounded p-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                     </svg>
                  </div>
                  <div class="text-end">
                    Total Room Available
                        <h2 class="counter">{{$count}}</h2>
                  </div>
               </div>
            </div>
         </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="bg-danger text-white rounded p-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                     </svg>
                  </div>
                  <div class="text-end">
                    Total Room Used
                        <h2 class="counter">{{$count_not}}</h2>
                  </div>
               </div>
            </div>
         </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Room Available</h4>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Room Name</th>
                                        <th>Room Floor</th>
                                        <th>Room Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($room as $r)
                                    <tr>
                                        <td>
                                            <h6>{{ $no }}</h6>
                                        </td>
                                        @php
                                            $no++;
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
                                        <td>
                                            <a class="btn btn-warning" href="{{route('rooms.edit', $r->id)}}">Edit</a>
                                            {{-- delete --}}
                                            <form action="{{ route('rooms.destroy', $r->id) }}" method="post" class="d-inline">
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
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection