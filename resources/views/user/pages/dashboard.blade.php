@extends('user.layouts.default')

@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <div>
                     <span><b>Total Laundry</b></span>
                     <div class="mt-2">
                        <h2 class="counter">Rp {{$user_total_price}}</h2>
                     </div>
                  </div>
                  <div>
                     <span class="badge bg-primary">Monthly</span>
                  </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <div>
                     <span><b>Total Shopping</b></span>
                     <div class="mt-2">
                        <h2 class="counter">Rp {{$user_total_price}}</h2>
                     </div>
                  </div>
                  <div>
                     <span class="badge bg-primary">Monthly</span>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <div>
                     <span><b>Total Transaction</b></span>
                     <div class="mt-2">
                        <h2 class="counter">Rp {{$user_total_price}}</h2>
                     </div>
                  </div>
                  <div>
                     <span class="badge bg-primary">Monthly</span>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- upcoming Remainder --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Upcoming</h4>
               </div>
            </div>
            <div class="card-body">
                @if($count_events == 0)
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="text-center">
                            <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_W4M8Pi.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-n5">No Upcoming Remainder</h5>
                        </div>
                    </div>
                @else
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                    <div>
                        <h5>Psychology Exam</h5>
                        <p>carry out writing exam in school</p>
                    </div>
                    <div>
                        <span class="text-danger">19 jan</span>
                        <p>45 Minutes</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Your Shopping Status</h4>
                </div>
            </div>
            <div class="p-0 card-body">
                <div class="mt-4 table-responsive">
                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                        <thead>
                            <tr>
                                <th>ID Transaction</th>
                                <th>Date</th>
                                <th>ORDER</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6>TRX-123456</h6>
                                </td>
                                <td>Saturday,12/12/2021</td>
                                <td>$14,000</td>
                                <td>
                                    <!-- status with filled -->
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-success me-5">Paid</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12ZM17.7366 6.04606C19.4439 7.36485 20.8976 9.29455 21.9415 11.7091C22.0195 11.8933 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8933 2.05854 11.7091C4.14634 6.88 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM12.0012 14.4124C13.3378 14.4124 14.4304 13.3264 14.4304 11.9979C14.4304 10.6597 13.3378 9.57362 12.0012 9.57362C11.8841 9.57362 11.767 9.58332 11.6597 9.60272C11.6207 10.6694 10.7426 11.5227 9.65971 11.5227H9.61093C9.58166 11.6779 9.56215 11.833 9.56215 11.9979C9.56215 13.3264 10.6548 14.4124 12.0012 14.4124Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Upcoming -->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="header-title">
                    <h4 class="card-title">New Threads</h4>
                </div>
            </div>
            <div class="card-body">
                @if($count_forums == 0)
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="text-center">
                        <lottie-player src="https://assets3.lottiefiles.com/private_files/lf30_noq8b0i9.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-n5">No Threads Added</h5>
                    </div>
                </div>
                @else
                @foreach($forums as $forum)
                <div class="twit-feed">
                    <div class="d-flex align-items-center mb-4">
                        <img class="rounded-pill p-1 bg-soft-primary img-fluid avatar-60 me-3" src="../../assets/images/avatars/03.png" alt="">
                        <div class="media-support-info">
                        <h6 class="mb-0">
                            {{ $forum->judul }}
                        </h6>
                        <p class="mb-0">@penghunirtb 
                            <span class="text-primary">
                                <svg width="15" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M10,17L5,12L6.41,10.58L10,14.17L17.59,6.58L19,8M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                                </svg>
                            </span>
                        </p>
                        </div>
                    </div>
                    <div class="media-support-body">
                        <p>{{$forum->deskripsi}}</p>
                        <div class="twit-date">{{$forum->created_at}}</div>
                    </div>
                </div>
                <hr class="my-4">
                @endforeach
                @endif
            </div>
        </div>
    </div>

</div>
@endsection