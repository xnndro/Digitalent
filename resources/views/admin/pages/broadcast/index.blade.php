@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{route('broadcast.create')}}" class="btn btn-primary">Add Broadcast</a>
        </div>
    </div>
    @if($count == 0)
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets5.lottiefiles.com/private_files/lf30_ms08pknf.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-n3">No Broadcast Added</h5>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach($broadcast as $b)
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="user-post-data">
                        <div class="d-flex flex-wrap">
                            <div class="media-support-info mt-2">
                                @if($b->status == 'unbroadcasted')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-primary">BroadCasted</span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="media-support-info mt-2">
                                <p class="mb-1">Judul Broadcast: </p>
                                <h5 class="mb-2 d-inline-block">{{$b->title}}</h5>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="media-support-info mt-2">
                                <p class="mb-1">Tanggal: </p>
                                <p class="mb-0 text-primary fs-6">{{$b->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-1">Pesan: </p>
                        <p>{{$b->message}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{$broadcast->links()}}
    @endif

    


</div>
@endsection