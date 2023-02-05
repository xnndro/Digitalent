@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">You have roomed with</h4>
                        </div>
                    
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date of Birth</th>
                                        <th>Class</th>
                                        <th>Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                    src="../../assets/images/shapes/01.png" alt="profile">
                                                <h6>Mikel Ganteng pake banget</h6>
                                            </div>
                                        </td>
                                        <td>February, 31 February 2055</td>
                                        <td>PPTI 11</td>
                                        <td>
                                            B511
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">You're a good fit for roommates with</h4>
                        </div>
                    
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date of Birth</th>
                                        <th>Class</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="rounded bg-soft-primary img-fluid avatar-40 me-3"
                                                    src="../../assets/images/shapes/01.png" alt="profile">
                                                <h6>Mikel Ganteng pake banget</h6>
                                            </div>
                                        </td>
                                        <td>February, 31 February 2055</td>
                                        <td>
                                            B511
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Room with</a>
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
