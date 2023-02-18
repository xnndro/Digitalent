@extends('admin.layouts.default')

@section('content')
<div>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Order To Take</h4>
               </div>
            </div>
            <div class="card-body px-0">
               @if($count == 0)
                  <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                     <div class="text-center">
                           <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_vq4vpefh.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player> 
                           <h5 class="mt-n5">No Order Added by Users</h5>
                     </div>
                  </div>
               @else
                  <div class="table-responsive">
                     <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                        <thead>
                            <tr class="ligth">
                                <th>Order ID</th>
                                <th>Details</th>
                                <th>Total Price</th>
                                <th style="min-width: 100px">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $o)
                                <tr>
                                    <td>{{$o->order_transaction_id}}</td>
                                    <td>
                                        <ul>
                                            @foreach($o->order_details as $item)
                                                <li>{{$item->qty}} {{$item->product}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$order->total_price}}</td>
                                    <td>
                                        <a href="{{ route('shopping.toTakeOrder', $o->id) }}" class="btn btn-primary">Take</a>
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
</div>
@endsection