@extends('admin.layouts.default')

@section('content')
<div class="row">
    @if($count == 0)
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets3.lottiefiles.com/private_files/lf30_noq8b0i9.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-n5">No Threads Added by Penghuni RTB</h5>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach($forums as $f)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="user-post-data">
                        <div class="d-flex flex-wrap">
                            <div class="media-support-user-img me-3">
                                <img class="rounded-circle p-1 bg-soft-danger img-fluid avatar-60" src="../../assets/images/avatars/02.png" alt="">
                            </div>
                            <div class="media-support-info mt-2">
                                <h5 class="mb-0 d-inline-block">{{$f->judul}}</h5>
                                <p class="mb-0 text-primary">{{$f->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>{{$f->deskripsi}}</p>
                    </div>
                    <div class="comment-area mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="like-block position-relative d-flex align-items-center">
                                <div class="d-flex align-items-center">                                    
                                    <p class="mb-0">
                                        <i class="ri-heart-fill">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06 7.78 7.78 7.78-7.78 1.06-1.06a5.48 5.48 0 0 0 0-7.78z"></path>
                                            </svg>
                                        </i>
                                        
                                        {{$f->likes}} Likes</p>
                                    </p>   
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- {{$forums->links()}} --}}
    @endif

    


</div>
@endsection