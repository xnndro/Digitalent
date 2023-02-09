@extends('adminVendor.layouts.default')

@section('content')
<div class="row">
@if($count == 0)   
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_b4jgnk3h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-3">You Don't Have Laundry Transactions</h5>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@else
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Laundries History</h4>
               </div>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                        <thead>
                            <tr class="ligth">
                                <th>Transaction ID</th>
                                <th>End Date</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laundry as $l)
                            <tr>
                                <td>{{$l->laundry_transaction_id}}</td>
                                <td>{{$l->tanggalAmbil}}</td>
                                <td>Rp. {{number_format($l->total_price, 0, ',', '.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>
@endif
@endsection