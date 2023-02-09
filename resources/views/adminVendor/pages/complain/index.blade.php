@extends('adminVendor.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12 mt-2 mb-3">
        <h3>Complains</h3>
    </div>
    @if($count == 0)
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_0owih56n.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                        <h5 class="mt-n5">No Complain Added from Penghuni RTB</h5>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach($complains as $c)
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
                    </div>
                    <div class="card-footer text-end">
                        @if($c->status == 'pending')
                            <a href="{{route('complains.adminProceed', $c->id)}}" class="btn btn-primary">Proceed</a>
                        @elseif($c->status == 'proceed')
                            <a href="{{route('complains.adminFinish', $c->id)}}" class="btn btn-primary">Close Complain</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach


    @endif
</div>
@endsection