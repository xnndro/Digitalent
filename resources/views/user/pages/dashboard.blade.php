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
                        <h2 class="counter">Rp {{number_format($user_total_price,0, "," , ".")}}</h2>
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
                        <h2 class="counter">Rp {{number_format($total_shopping,0, "," , ".")}}</h2>
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
                        <h2 class="counter">Rp {{number_format($total_transaction,0, "," , ".")}}</h2>
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
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
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
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="800">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Your Lastest Shopping</h4>
                </div>
            </div>
            <div class="p-0 card-body">
                @if($orders_done_count == 0)
                    <div class="d-flex justify-content-center align-items-center flex-wrap mt-n4 mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets4.lottiefiles.com/private_files/lf30_x2lzmtdl.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-n5">No Transaction added</h5>
                        </div>
                    </div>
                @else
                    <div class="mt-4 table-responsive">
                        <table id="basic-table" class="table mb-0 table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>ID Transaction</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders_done as $order_done)
                                    <tr>
                                        <td>{{$order_done->invoice_name}}</td>
                                        <td>{{$order_done->created_at}}</td>
                                        <td>
                                            <span class="badge bg-success">Success</span>
                                        </td>
                                        <td>
                                            {{-- <a href="{{route('user.order.show', $order_done->id)}}" class="btn btn-primary btn-sm">Detail</a> --}}
                                            <a href="{{ route('history') }}" class="btn btn-primary btn-sm">Detail</a>
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
    <!-- End Upcoming -->

    <div class="col-lg-4">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="850">
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
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="900">
            <div class="card-header">
                <div class="header-title">
                    <h4 class="card-title">Transaction To Pay</h4>
                </div>
            </div>
            <div class="card-body">
                @if($orders_count == 0)
                    <div class="d-flex justify-content-center align-items-center flex-wrap mt-n5">
                        <div class="text-center">
                            <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_c8zlc8qn.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-n5">You Don't Have Transaction to Pay</h5>
                        </div>
                    </div>
                @else
                @foreach($orders as $o)
                    {{-- <form action="{{route('toPay',$o->id)}}" method="POST"> --}}
                        @csrf
                    <div class="twit-feed">
                        <div class="d-flex justify-content-between mb-1">
                            <div class="">
                                <h3>Rp {{$o->total_price}}</h3>
                                <h6>TRX-{{$o->number}}</h6> <p>on {{$o->created_at}}</p>   
                            </div>
                            <div class="">
                                <div class="badge bg-success p-3">
                                    <a class="text-white" href="{{route('toPay',$o->id)}}">
                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z" fill="currentColor"></path>
                                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079ZM6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003ZM7.02539 21.5683C7.17139 21.7153 7.36339 21.7883 7.55539 21.7883C7.74739 21.7883 7.93939 21.7153 8.08539 21.5683L9.45139 20.2033C9.74339 19.9103 9.74339 19.4353 9.45139 19.1423C9.15839 18.8503 8.68339 18.8503 8.39039 19.1423L7.02539 20.5083C6.73239 20.8013 6.73239 21.2753 7.02539 21.5683Z" fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="">
                                <form action="{{route('order.cancel', $o->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <hr class="my-4 mt-n2">
                    {{-- </form> --}}
                @endforeach
                @endif
            </div>
        </div>
    </div>

</div>
@endsection