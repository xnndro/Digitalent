@extends('adminVendor.layouts.default')

@section('content')
<div class="col-md-12 col-lg-12">
    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
        <div class="flex-wrap card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="mb-2 card-title">Laundries</h4>
            </div>
        
        </div>
        <div class="p-0 card-body">
            @if($count == 0)     
            <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                <div class="text-center">
                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_b4jgnk3h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                    <h5 class="mt-3">You Don't Have Laundry Transactions</h5>
                </div>
            </div> 
            @else
            <div class="mt-4 table-responsive">
                <table id="basic-table" class="table mb-0 table-striped" role="grid">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Pick Up Date</th>
                            <th>Delivery Date</th>
                            <th>Total Pieces</th>
                            <th>Total Weight</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach ($laundry as $l)
                            <tr>
                                <td>{{$l->laundry_transaction_id}}</td>
                                <td>{{$l->tanggalVendor}}</td>
                                <td>{{$l->tanggalAmbil}}</td>
                                <td>{{$l->total_pcs}}</td>
                                <td>{{$l->total_kg}}</td>
                                <td>
                                    @if ($l->status == 'Inputed')
                                        <span class="badge bg-warning">Inputed</span>
                                    @elseif($l->status == 'Taked')
                                        <span class="badge bg-info">Taked by Vendor</span>
                                    @elseif($l->status == 'Procesed')
                                        <span class="badge bg-info">Procesed</span>
                                    @elseif($l->status == 'Delivered')
                                        <span class="badge bg-info">Delivered</span>
                                    @elseif($l->status == 'Done')
                                        <span class="badge bg-success">Success</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('laundry_vendor.edit',$l->id)}}" class="btn btn-warning">Edit</a>
                                    @if($l->status =='Procesed')
                                        <a href="{{ route('laundry_vendor.done', $l->id) }}" class="btn btn-primary">Done</a>
                                    @elseif($l->status == 'Taked')
                                        <a href="{{ route('laundry_vendor.process', $l->id) }}" class="btn btn-primary">Proceed</a>
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
@endsection