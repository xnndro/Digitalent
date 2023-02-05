@extends('admin.layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between align-itmes-center">
                  <div>
                     <div class="p-3 rounded bg-soft-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                     </div>
                  </div>
                  <div>
                    <h1>{{$count_request}}</h1>
                     <p class="mb-0">Total Roomates Request</p>
                  </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-center justify-content-between">
                  <div class=" bg-soft-success rounded p-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="35px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                     </svg>
                  </div>
                  <div>
                     <h1 class="text-success counter">Rp {{$total_price}}</h1>
                     <p class="text-success mb-0">Total Earning</p>
                  </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between align-itmes-center">
                  <div>
                     <div class="p-3 rounded bg-soft-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                     </div>
                  </div>
                  <div>
                    <h1>{{$count_laundry}}</h1>
                     <p class="mb-0">Total Laundry to Vendor today</p>
                  </div>
               </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 mb-3">
        <h3>Laundry Today</h3>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex flex-column align-items-between">
                  <div>
                     <div class="d-flex">
                        <div class="bg-warning text-white p-3 rounded">
                           <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                           </svg>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3">
                     <span>Femme</span>
                     <div>
                        <h3 class="counter">{{$femme}} bags</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex flex-column align-items-between">
                  <div>
                     <div class="d-flex">
                        <div class="bg-success text-white p-3 rounded">
                           <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                           </svg>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3">
                     <span>Bclean</span>
                     <div>
                        <h3 class="counter">{{$bclean}} bags</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex flex-column align-items-between">
                  <div>
                     <div class="d-flex">
                        <div class="bg-danger text-white p-3 rounded">
                           <svg xmlns="http://www.w3.org/2000/svg" width="25px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                           </svg>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3">
                     <span>Mills</span>
                     <div>
                        <h3 class="counter">{{$mills}} bags</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>

    <div class="col-lg-12 mb-3">
        <h3>Most Liked Posts</h3>
    </div>

    @foreach($forums as $forum)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="twit-feed">
                    <div class="d-flex align-items-center mb-4">
                        <img class="rounded-pill p-1 bg-soft-primary img-fluid avatar-60 me-3" src="../../assets/images/avatars/03.png" alt="">
                        <div class="media-support-info">
                        <h6 class="mb-0">
                            {{ $forum->judul }}
                        </h6>
                        <p class="mb-0">@penghunirtb 
                            <span class="text-primary">
                                <svg width="15" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M10,17L5,12L6.41,10.58L10,14.17L17.59,6.58L19,8M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                                </svg>
                            </span>
                        </p>
                        </div>
                    </div>
                    <div class="media-support-body">
                        <p>{{$forum->deskripsi}}</p>
                        <div class="twit-date">{{$forum->created_at}}</div>
                    </div>
                </div>
                <hr class="my-4">
            </div>
        </div>
    </div>
    @endforeach

    

    
</div>
@endsection