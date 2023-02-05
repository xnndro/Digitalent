@extends('adminVendor.layouts.default')

@section('content')
<div class="col-md-12 col-lg-12">
    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
        <div class="flex-wrap card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="mb-2 card-title">Laundries History</h4>
            </div>
        
        </div>
        <div class="p-0 card-body">
            @if($count == 0)    
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_b4jgnk3h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-3">You do not have Laundry Transactions</h5>
                    </div>
                </div> 
            @else
                <div class="mt-4 table-responsive">
                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>End Date</th>
                                <th>Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($laundry as $l)
                            <tr>
                                <td>{{$l->laundry_transaction_id}}</td>
                                <td>{{$l->tanggalAmbil}}</td>
                                <td>{{$l->total_price}}</td>
                            </tr>
                            @endforeach

                            {{-- sum row --}}
                            <tr>
                                <td colspan="2" class="text-right">Total</td>
                                <td>{{$total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection