@extends('user.layouts.default')
@section('content')
<div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="bg-soft-warning rounded p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <span>Laundry Transaction</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="counter">Rp {{
                            number_format($total_laundry, 0, ',', '.')
                            }}</h2>
                        
                        <div>
                            <span>
                                {{$total_laundry_transaction}}
                            </span>
                            <span>Transaction</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="bg-soft-warning rounded p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <span>Shopping Transaction</span>
                    </div>
                </div>
                <div class="text-center">
                        <h2 class="counter">Rp {{
                            number_format($total_shopping, 0, ',', '.')
                            }}</h2>
                        
                        <div>
                            <span>
                                {{$total_shopping_transaction}}
                            </span>
                            <span>Transaction</span>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="bg-soft-warning rounded p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <span>Total Transaction</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="counter">{{
                            $total_transaction
                            }}</h2>
                        
                        <div>
                            <span>
                                {{$total_data_transaction}}
                            </span>
                            <span>Data</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <h3>Details on {{$name}}</h3>
        </div>

        <div class="col-md-12 col-lg-6">
            <div class="card" data-aos="fade-up" data-aos-delay="600">
                <div class="flex-wrap card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="mb-2 card-title">Laundry Transaction</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($laundry_on_the_month) == 0)
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_b4jgnk3h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-2">You dont have any transaction history yet</h5>
                        </div>
                    </div>
                    @else
                        @foreach($laundry_on_the_month as $lm)
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 text-danger ">Rp {{number_format($lm->total_price, 0, ',', '.')}}, Purchased</h6>
                                    <span class="mb-0">{{$lm->laundry_transaction_id}} | {{$lm->created_at}}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="card" data-aos="fade-up" data-aos-delay="600">
                <div class="flex-wrap card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="mb-2 card-title">Shopping Transaction</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if($total_shopping_transaction == 0)
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_b4jgnk3h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-2">You dont have any transaction history yet</h5>
                        </div>
                    </div>
                    @else
                        @foreach($shopping_on_the_month as $sm)
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 text-danger ">Rp {{number_format($sm->total_price, 0, ',', '.')}}, Purchased</h6>
                                    <span class="mb-0">{{$sm->order_transaction_id}} | {{$sm->created_at}}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
       
    



    </div>
</div>
@endsection