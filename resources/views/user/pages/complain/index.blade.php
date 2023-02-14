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


    <div class="col-lg-12 mt-2 mb-4">
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
           @if($c->complain_type == 'Fasilitas')
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="user-post-data">
                                <div class="d-flex flex-wrap">
                                    <div class="media-support-info mt-2">
                                        @if($c->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($c->status == 'proceed')
                                            <span class="badge bg-soft-primary">Proceed</span>
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
                                <p class="mb-1">Kamar: <span class="text-primary">{{$c->room_name}}</span></p>
                                <p class="mb-1">Keluhan: {{$c->complain_name}}</p>
                                <p class="mb-1">Details: </p>
                                <p class="mb-0 fs-6">{{$c->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
           @else
            <div class="modal fade" id="gambar" aria-hidden="true" aria-labelledby="gambar" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="gambar">Picture</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{asset(
                                    'storage/uploads/complain/'.$c->fotoBarang 
                                    )}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="user-post-data">
                                <div class="d-flex flex-wrap">
                                    <div class="media-support-info mt-2">
                                        @if($c->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($c->status == 'proceed')
                                            <span class="badge bg-soft-primary">Proceed</span>
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
                                <p class="mb-1">No.Transaction: <span class="text-primary">{{$c->noTransaksi}}</span></p>
                                <p class="mb-1">Keluhan: {{$c->complain_name}}</p>
                                <p class="mb-1">Details: </p>
                                <p class="mb-0 fs-6">{{$c->description}}</p>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-soft-warning" data-bs-target="#gambar" data-bs-toggle="modal">See Picture</button>
                            </div>
                        </div>
                    </div>
                </div>

            @endif  


    @endforeach
    @endif
</div>
@endsection