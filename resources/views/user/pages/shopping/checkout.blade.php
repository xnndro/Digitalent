@extends('user.layouts.default')
@push('after-style')
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{config('midtrans.client_key')}}"></script>
@endpush
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="p-2 rounded bg-warning disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg> 
                        </div>
                        <h4 class="px-3">Checkout</h4>
                    </div> 
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center mb-0" for="OrderID">Order ID: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="OrderID" value="{{$order->number}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center mb-0" for="total_harga">Total Price: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_harga" value="Rp {{
                            number_format($order->total_price, 0, ',', '.')
                        }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 align-self-center mb-0" for="status">Payment Status: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="status" value="{{$order->payment_status}}" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    @if ($order->payment_status == 1)
                    <button class="btn btn-primary" id="pay-button">Pay Now</button>
                    @else
                    Pembayaran berhasil
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay(
        '{{$snapToken}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
        //   alert("payment success!"); console.log(result);
            console.log("coba");
            swal({
                title: "Success!",
                text: "Payment Success",
                icon: "success",
                button: "OK",
            }).then(function() {
                window.location = "{{route('dashboard')}}";
            });
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
@endpush