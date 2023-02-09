@extends('user.layouts.default')

@push('after-style')
<style>
.cards{

    transition: all 0.2s ease;
    cursor: pointer;


}

.cards:hover{

    box-shadow: 5px 6px 6px 2px #e9ecef;
    transform: scale(1.05);
}

</style>
@endpush
@section('content')
<div class="row">
    @if($status == 2)
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_ty7s7zry.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-n3">You dont have any transaction yet</h5>
                    </div>
                </div>
            </div>
        </div>
    @else
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
                            number_format($laundry_this_month_total, 0, ',', '.')
                            }}</h2>
                        
                        @if($status_laundry == 0)
                            <div>
                                <span>
                                    
                                    {{$laundry_percentage}}
                                </span>
                                <span>Data from Previous Month </span>
                            </div>
                        @else
                            @if($laundry_percentage < 0)
                                <div>
                                    <span class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px"  viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    {{$laundry_percentage}}%
                                    </span>
                                    <span>Decreased</span>
                                </div>
                            @else
                                <div>
                                    <span class="text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="10" height="10"  viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    {{$laundry_percentage}}%
                                    </span>
                                    <span>Increased</span>
                                </div>
                            @endif
                        @endif
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
                            number_format($shopping_this_month_total, 0, ',', '.')
                            }}</h2>
                        
                        @if($status == 0)
                            <div>
                                <span>
                                    {{$shopping_percentage}}
                                </span>
                                <span>Data from Previous Month</span>
                            </div>
                        @else
                            @if($shopping_percentage < 0)
                            <div>
                                <span class="text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px"  viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                {{$shopping_percentage}}%
                                </span>
                                <span>Decreased</span>
                            </div>
                            @else
                            <div>
                                <span class="text-success">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="10" height="10"  viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                {{$shopping_percentage}}%
                                </span>
                                <span>Increased</span>
                            </div>
                            @endif
                        @endif
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
                        
                        @if($total_data_transaction == 0)
                            <div>
                                <span>
                                    {{$total_data_transaction}}
                                </span>
                                <span>Data</span>
                            </div>
                        @else
                            <div>
                                <span class="text-success">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="10" height="10"  viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                {{$total_data_transaction}}
                                </span>
                                <span>Transaction Total</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <h3>History</h3>
        </div>

        @if($financial_count == 0)
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_QGHiAw.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-n3">You Don't Have any Transaction History yet</h5>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @foreach($financial as $fi)
            <div class="col-lg-4">
                <a href="{{route('user.financial_show',$fi->id)}}" class="">
                    <div class="card cards">
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class=" bg-soft-success rounded p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-success counter">Rp {{$fi->transaction_amount}}</h1>
                                <p class="text-success mb-0">Total Transaction on {{$fi->name}}</p>

                            </div>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @endif
        

    



    </div>
    @endif
</div>
@endsection