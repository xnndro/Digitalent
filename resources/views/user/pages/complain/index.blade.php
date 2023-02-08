@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-5 mt-3">
        <div class="dropdown d-flex justify-content-end">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Add Complain
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('complains.create')}}">Facility</a></li>
              <li><a class="dropdown-item" href="{{route('complains.laundry')}}">Laundry</a></li>
            </ul>
          </div>
    </div>


    <div class="col-lg-12 mt-2 mb-2">
        <h3>Your Complains</h3>
    </div>
    @if($complains_count == 0)
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_0owih56n.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                        <h5 class="mt-n5">No Complain Added</h5>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach($complains as $c)
            <div class="col-lg-4">
                <div class="card">
                    <img height="100px" src="{{asset(
                    'storage/uploads/complain/'.$c->fotoBarang 
                    )}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="user-post-data">
                            <div class="d-flex flex-wrap">
                                <div class="media-support-info mt-2">
                                    @if($c->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-primary">Closed</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div class="media-support-info mt-2">
                                    <p class="mb-1">ComplainID: </p>
                                    <h5 class="mb-2 d-inline-block">{{$c->complain_id}}</h5>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div class="media-support-info mt-2">
                                    <p class="mb-1">Tanggal: </p>
                                    <p class="mb-0 text-primary fs-6">{{$c->created_at}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-1">Complain Type: {{$c->complain_type}}</p>
                            <p>{{$c->complain_type}} | {{$c->jumlahBarang}} pcs</p>
                        </div>
                        <div class="mt-3">
                            {{-- <p class="mb-1">Complain Type: {{$c->complain_type}}</p> --}}
                            <p>{{$c->complain_name}} | {{$c->jumlahBarang}} pcs</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    @endif
</div>
@endsection