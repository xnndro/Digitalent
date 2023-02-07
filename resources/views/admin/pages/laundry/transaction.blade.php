@extends('admin.layouts.default')

@section('content')
<div class="row">
    @if($count == 0)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_b4jgnk3h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-3">You haven't added a laundry transaction yet</h5>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    @else
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="bg-warning text-white rounded p-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                     </svg>
                  </div>
                  <div class="text-end">
                     Order to Femme
                        <h2 class="counter">{{$femme}}</h2>
                  </div>
               </div>
            </div>
         </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="bg-success text-white rounded p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div class="text-end">
                    Order to BClean
                        <h2 class="counter">{{$bclean}}</h2>
                  </div>
               </div>
            </div>
         </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="bg-danger text-white rounded p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div class="text-end">
                    Order to Mills
                        <h2 class="counter">{{$mills}}</h2>
                  </div>
               </div>
            </div>
         </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Laundries</h4>
                </div>
            </div>
            <div class="p-0 card-body">
            
                <div class="mt-4 table-responsive">
                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                        <thead>
                            <tr>
                                <th>Laundry ID</th>
                                <th>Name</th>
                                <th>Tanggal Vendor Ambil</th>
                                <th>Vendor</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laundries as $l)
                            <tr>
                                <td>
                                    <h6>{{ $l->laundry_transaction_id }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $l->user }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $l->tanggalVendor }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $l->vendor }}</h6>
                                </td>
                                <td>
                                    <h6>
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
                                    </h6>
                                </td>
                                <td>
                                    {{-- button to change status to done --}}
                                    <a href="{{route('laundries.edit',$l->id)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('laundries.done', $l->id) }}" class="btn btn-primary">Taked by User</a>
                                    {{-- <a href="{{ route('laundries.destroy', $l->id) }}" class="btn btn-danger">Delete</a> --}}
                                    {{-- form delete --}}
                                    <form action="{{ route('laundries.destroy', $l->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
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