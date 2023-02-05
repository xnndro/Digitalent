@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Your Laundry Status</h4>
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
                                <th>Laundry ID</th>
                                <th>Laundry Vendor</th>
                                <th>Date in</th>
                                <th>Date take</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laundry as $item)
                            <tr>
                                <td>
                                    {{$item->laundry_transaction_id}}
                                </td>
                                <td>
                                    {{$item->vendor_name}}
                                </td>
                                <td>{{$item->tanggalMasuk}}</td>
                                <td>{{$item->tanggalAmbil}}</td>
                                <td>{{$item->total_price}}</td>
                                <td>
                                    @if ($item->status == 'Inputed')
                                        <span class="badge bg-warning">Inputed</span>
                                    @elseif($item->status == 'Taked')
                                        <span class="badge bg-info">Taked by Vendor</span>
                                    @elseif($item->status == 'Procesed')
                                        <span class="badge bg-info">Procesed</span>
                                    @elseif($item->status == 'Delivered')
                                        <span class="badge bg-info">Delivered</span>
                                    @elseif($item->status == 'Done')
                                        <span class="badge bg-success">Success</span>
                                    @endif
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
</div>
@endsection