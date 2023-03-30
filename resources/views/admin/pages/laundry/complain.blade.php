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
                    <h1>{{$total_kehilangan}}</h1>
                     <p class="mb-0">Total Kehilangan (pcs)</p>
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
                     <h1 class="text-success counter">{{$total_pakaian_kotor}}</h1>
                     <p class="text-success mb-0">Total Pakaian Kotor (pcs)</p>
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
                    <h1>{{$total_complain}}</h1>
                     <p class="mb-0">Total Complain</p>
                  </div>
               </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Complain History</h4>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Complain ID</th>
                                        <th>User Complain</th>
                                        <th>Complain Type</th>
                                        <th>Jumlah Barang</th>
                                        <th>Status</th>
                                        <th>Tanggal Complain</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($complains as $c)
                                    <tr>
                                        <td>
                                            <h6>{{ $no }}</h6>
                                        </td>
                                        @php
                                            $no++;
                                        @endphp
                                        <td>
                                            <h6>{{ $c->complain_id }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $c->user_name }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $c->complain_name }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $c->jumlahBarang }} pcs</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $c->status }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ date('d-m-Y', strtotime($c->created_at)) }}</h6>
                                        </td>
                                    </tr>
                                    @endforeach
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