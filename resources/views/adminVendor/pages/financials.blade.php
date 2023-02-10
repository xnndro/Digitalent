@extends('adminVendor.layouts.default')

@section('content')
@if($count == 0)
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_ty7s7zry.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-n3">You Don't Have Any Transaction Yet</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        @foreach($financials as $f)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="fs-italic">
                            <h5> {{$f->name}}</h5>
                        </div>	
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h2 class="mb-0 counter text-success">{{$f->total_transaction}}</h2>
                                <div>Total Transaction</div>
                            </div>
                            <div>
                                <h2 class="mb-0 counter text-success fw-bold">{{$f->total_amount}}</h2>
                                <div>Total Revenue</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection