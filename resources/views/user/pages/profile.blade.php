@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
               <div class="d-flex flex-wrap align-items-center justify-content-between">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1">
                        <img src="../../assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                        <img src="../../assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid rounded-pill avatar-100">
                        <img src="../../assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid rounded-pill avatar-100">
                        <img src="../../assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid rounded-pill avatar-100">
                        <img src="../../assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-pill avatar-100">
                        <img src="../../assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid rounded-pill avatar-100">
                     </div>
                     <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                        <h4 class="me-2 h4">Austin Robertson</h4>
                     </div>
                  </div>
               </div>
            </div>
       </div>
    </div>
    <div class="col-lg-3">
       <div class="card">
         <div class="card-header">
            <div class="header-title">
               <h4 class="card-title">Reminder</h4>
            </div>
         </div>
         <div class="card-body">
            <ul class="list-inline m-0 p-0">
               <li class="d-flex mb-2">
                  <div class="news-icon me-3">
                     <svg width="20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4C22,2.89 21.1,2 20,2Z" />
                     </svg>
                  </div>
                  <p class="news-detail mb-0">your bangor will be taken out on February 31, 2055</p>
               </li>
               <li class="d-flex">
                  <div class="news-icon me-3">
                     <svg width="20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4C22,2.89 21.1,2 20,2Z" />
                     </svg>
                  </div>
                  <p class="news-detail mb-0">your bangor will be taken out on February 31, 2055</p>
               </li>
            </ul>
         </div>
       </div>
    </div>
    <div class="col-lg-6">
       <div class="profile-content tab-content">
         <div id="profile-profile" class="tab-pane fade active show">
            <div class="card">
               <div class="card-header">
                  <div class="header-title">
                     <h4 class="card-title">Profile</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="text-center">
                     <div class="user-profile">
                        <img src="../../assets/images/avatars/01.png" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                     </div>
                     <div class="mt-3">
                        <h3 class="d-inline-block">Austin Robertson</h3>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <div class="header-title">
                     <h4 class="card-title">About User</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="user-bio">
                     <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes. Topping cake wafer.</p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">Joined:</h6>
                  <p>Feb 15, 2021</p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">Lives:</h6>
                  <p>United States of America</p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">Email:</h6>
                  <p><a href="#" class="text-body"> austin@gmail.com</a></p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">Url:</h6>
                  <p><a href="#" class="text-body" target="_blank"> www.bootstrap.com </a></p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">Contact:</h6>
                  <p><a href="#" class="text-body">(001) 4544 565 456</a></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>
    <div class="col-lg-3">
       <div class="card">
         <div class="card-header">
            <div class="header-title">
               <h4 class="card-title">Contact</h4>
            </div>
         </div>
         <div class="card-body">
            <p>Lorem ipsum dolor sit amet, contur adipiscing elit.</p>
            <div class="mb-1">Email: <a href="#" class="ms-3">nikjone@demoo.com</a></div>
            <div class="mb-1">Phone: <a href="#" class="ms-3">001 2351 256 12</a></div>
            <div>Location: <span class="ms-3">USA</span></div>
         </div>
       </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom share-offcanvas" tabindex="-1" id="share-btn" aria-labelledby="shareBottomLabel">
   <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="shareBottomLabel">Share</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
   </div>
   <div class="offcanvas-body small">
      <div class="d-flex flex-wrap align-items-center">
         <div class="text-center me-3 mb-3">
            <img src="../../assets/images/brands/08.png" class="img-fluid rounded mb-2" alt="">
            <h6>Facebook</h6>
         </div>
         <div class="text-center me-3 mb-3">
            <img src="../../assets/images/brands/09.png" class="img-fluid rounded mb-2" alt="">
            <h6>Twitter</h6>
         </div>
         <div class="text-center me-3 mb-3">
            <img src="../../assets/images/brands/10.png" class="img-fluid rounded mb-2" alt="">
            <h6>Instagram</h6>
         </div>
         <div class="text-center me-3 mb-3">
            <img src="../../assets/images/brands/11.png" class="img-fluid rounded mb-2" alt="">
            <h6>Google Plus</h6>
         </div>
         <div class="text-center me-3 mb-3">
            <img src="../../assets/images/brands/13.png" class="img-fluid rounded mb-2" alt="">
            <h6>In</h6>
         </div>
         <div class="text-center me-3 mb-3">
            <img src="../../assets/images/brands/12.png" class="img-fluid rounded mb-2" alt="">
            <h6>YouTube</h6>
         </div>
      </div>
   </div>
</div>  
@endsection