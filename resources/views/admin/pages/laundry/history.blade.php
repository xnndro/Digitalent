@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
             <div class="header-title">
                <h4 class="card-title">Laundries History</h4>
             </div>
          </div>
          <div class="card-body px-0">
            @if($count == 0)
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_b4jgnk3h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-3">You Don't Have Laundry Transactions</h5>
                    </div>
                </div> 
            @else
                <div class="table-responsive">
                    <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                    <thead>
                        <tr class="ligth">
                            <th>Laundry ID</th>
                            <th>Name</th>
                            <th>Date End</th>
                            <th>Vendor</th>
                            <th>Status</th>
                            <th>Total Revenue</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($laundries as $l)
                            <tr>
                                <td>
                                    <h6>{{ $l->laundry_transaction_id }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $l->user }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $l->tanggalAmbil }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $l->vendor }}</h6>
                                </td>
                                <td>
                                    <h6>
                                        @if ($l->status == 'Inputed')
                                            <span class="badge bg-warning">Inputed</span>
                                        @elseif($l->status == 'Taked')
                                            <span class="badge bg-info">Taked by Vendor</span>
                                        @elseif($l->status == 'Procesed')
                                            <span class="badge bg-info">Procesed</span>
                                        @elseif($l->status == 'Done')
                                            <span class="badge bg-success">Success</span>
                                        @endif
                                    </h6>
                                </td>
                                <td>
                                    <h6>Rp. {{ 
                                    number_format($l->total_price, 0, ',', '.')
                                }}</h6>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
           @endif
        </div>
     </div>
  </div>
</div>
@endsection