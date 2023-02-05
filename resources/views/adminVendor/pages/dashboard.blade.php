@extends('adminVendor.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <h3>Order Today</h3>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
               <div class="text-center">Total Order Today</div>
               <div class="d-flex align-items-center justify-content-between mt-3">
                  <div>
                     <h3 class="counter">{{$order_today}} bags</h3>
                  </div>
                  <div class="bg-primary text-white p-3 rounded">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                     </svg>
                 </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
               <div class="text-center">Total Revenue Today</div>
               <div class="d-flex align-items-center justify-content-between mt-3">
                  <div>
                     <h3 class="counter">Rp {{$total_price}}</h3>
                  </div>
                  <div class="bg-warning text-white p-3 rounded">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                     </svg>
                  </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6"></div>

    <div class="col-lg-12 mb-3">
      <h3>Conclusion</h3>
    </div>

   <div class="col-lg-4">
      <div class="card">
         <div class="card-body">
            <div class="text-center">Total Order</div>
            <div class="d-flex align-items-center justify-content-between mt-3">
               <div>
                  <h3 class="counter">{{$total_order}} bags</h3>
               </div>
               <div class="bg-primary text-white p-3 rounded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
              </div>
            </div>
         </div>
     </div>
   </div>
   <div class="col-lg-4">
      <div class="card">
         <div class="card-body">
            <div class="text-center">Total Revenue</div>
            <div class="d-flex align-items-center justify-content-between mt-3">
               <div>
                  <h3 class="counter">Rp {{$total_revenue}}</h3>
               </div>
               <div class="bg-warning text-white p-3 rounded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                  </svg>
               </div>
            </div>
         </div>
     </div>
   </div>
    <div class="col-lg-4">
      <div class="card">
         <div class="card-body">
            <div class="text-center">Total User</div>
            <div class="d-flex align-items-center justify-content-between mt-3">
               <div>
                  <h3 class="counter">{{$count_user}} person</h3>
               </div>
               <div class="p-3 rounded bg-soft-primary">
                 <svg xmlns="http://www.w3.org/2000/svg" width="30px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                 </svg>
              </div>
            </div>
         </div>
     </div>
   </div>

   <div class="col-lg-12 mb-3">
      <h3>Incoming Order</h3>
      @if($total_incoming_order != 0)
         <p>at {{$nearest_inputted_date->tanggalVendor}}</p>
      @endif
   </div>
   @if($total_incoming_order == 0)
      <div class="card">
         <div class="card-body">
            <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
               <div class="text-center">
                  <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_k10ku8at.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                   <h5 class="mt-3">You do not have Incoming Transactions</h5>
               </div>
           </div> 
         </div>
      </div>
   @else
      <div class="col-lg-3">
         <div class="card">
            <div class="card-body">
               <div class="text-center">Total Incoming Order</div>
               <div class="d-flex align-items-center justify-content-between mt-3">
                  <div>
                     <h3 class="counter">{{$total_incoming_order}} bags</h3>
                  </div>
                  <div class="bg-primary text-white p-3 rounded">
                     <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                     </svg>
                 </div>
               </div>
            </div>
      </div>
      </div>
      <div class="col-lg-3">
         <div class="card">
            <div class="card-body">
               <div class="text-center">Total Incoming Revenue</div>
               <div class="d-flex align-items-center justify-content-between mt-3">
                  <div>
                     <h3 class="counter">Rp {{$total_incoming_revenue}}</h3>
                  </div>
                  <div class="rounded p-3 bg-soft-danger">
                     <svg width="24px" height="24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11.19,2.25C11.97,2.26 12.71,2.73 13,3.5L18,15.45C18.09,15.71 18.14,16 18.13,16.25C18.11,17 17.65,17.74 16.9,18.05L9.53,21.1C9.27,21.22 9,21.25 8.74,21.25C7.97,21.23 7.24,20.77 6.93,20L1.97,8.05C1.55,7.04 2.04,5.87 3.06,5.45L10.42,2.4C10.67,2.31 10.93,2.25 11.19,2.25M14.67,2.25H16.12A2,2 0 0,1 18.12,4.25V10.6L14.67,2.25M20.13,3.79L21.47,4.36C22.5,4.78 22.97,5.94 22.56,6.96L20.13,12.82V3.79M11.19,4.22L3.8,7.29L8.77,19.3L16.17,16.24L11.19,4.22M8.65,8.54L11.88,10.95L11.44,14.96L8.21,12.54L8.65,8.54Z" />
                     </svg>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">

      </div>
   @endif


</div>
@endsection