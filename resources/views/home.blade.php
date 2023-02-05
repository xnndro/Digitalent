@extends('user.layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row row-cols-1">
            <div class="overflow-hidden d-slider1 ">
                <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-01"
                                    class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                    data-min-value="0" data-max-value="100" data-value="90"
                                    data-type="percent">
                                    <svg class="card-slie-arrow " width="24" height="24px"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p class="mb-2">Total Laundry</p>
                                    <h4 class="counter">$560K</h4>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-02"
                                    class="text-center circle-progress-01 circle-progress circle-progress-info"
                                    data-min-value="0" data-max-value="100" data-value="80"
                                    data-type="percent">
                                    <svg class="card-slie-arrow " width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p class="mb-2">Total Shopping</p>
                                    <h4 class="counter">$185K</h4>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-03"
                                    class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                    data-min-value="0" data-max-value="100" data-value="70"
                                    data-type="percent">
                                    <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p class="mb-2">Total Cost</p>
                                    <h4 class="counter">$375K</h4>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Your Laundry Status</h4>
                        </div>
                    
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>COMPANIES</th>
                                        <th>Date</th>
                                        <th>ORDER</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                    src="../../assets/images/shapes/01.png" alt="profile">
                                                <h6>Femme</h6>
                                            </div>
                                        </td>
                                        <td>Saturday,12/12/2021</td>
                                        <td>$14,000</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12ZM17.7366 6.04606C19.4439 7.36485 20.8976 9.29455 21.9415 11.7091C22.0195 11.8933 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8933 2.05854 11.7091C4.14634 6.88 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM12.0012 14.4124C13.3378 14.4124 14.4304 13.3264 14.4304 11.9979C14.4304 10.6597 13.3378 9.57362 12.0012 9.57362C11.8841 9.57362 11.767 9.58332 11.6597 9.60272C11.6207 10.6694 10.7426 11.5227 9.65971 11.5227H9.61093C9.58166 11.6779 9.56215 11.833 9.56215 11.9979C9.56215 13.3264 10.6548 14.4124 12.0012 14.4124Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shopping Status -->
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Your Shopping Status</h4>
                        </div>
                       
                    
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>ID Transaction</th>
                                        <th>Date</th>
                                        <th>ORDER</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>TRX-123456</h6>
                                        </td>
                                        <td>Saturday,12/12/2021</td>
                                        <td>$14,000</td>
                                        <td>
                                            <!-- status with filled -->
                                            <div class="d-flex align-items-center">
                                                <div class="badge bg-success me-5">Paid</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12ZM17.7366 6.04606C19.4439 7.36485 20.8976 9.29455 21.9415 11.7091C22.0195 11.8933 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8933 2.05854 11.7091C4.14634 6.88 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM12.0012 14.4124C13.3378 14.4124 14.4304 13.3264 14.4304 11.9979C14.4304 10.6597 13.3378 9.57362 12.0012 9.57362C11.8841 9.57362 11.767 9.58332 11.6597 9.60272C11.6207 10.6694 10.7426 11.5227 9.65971 11.5227H9.61093C9.58166 11.6779 9.56215 11.833 9.56215 11.9979C9.56215 13.3264 10.6548 14.4124 12.0012 14.4124Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection