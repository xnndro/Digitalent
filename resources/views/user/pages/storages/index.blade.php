@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Yours products</h4> 
                </div>
            </div>
            <div class="p-0 card-body">
                @if($count == 0)
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_9ycwmgb9.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-3">No Products Added</h5>
                        </div>
                    </div>
                @else
                    <div class="mt-4 table-responsive">
                        <table id="basic-table" class="table mb-0 table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>Products Name</th>
                                    <th>Type of Products</th>
                                    <th>Date in</th>
                                    <th>Date out</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($storages as $storage)
                                <tr>
                                    <td>
                                        <h6>{{$storage->namaBarang}}</h6>
                                    </td>
                                    <td>{{$storage->typeOfStorage_id}}</td>
                                    <td>
                                        {{$storage->tanggalMasuk}}
                                    </td>
                                    <td>
                                        {{$storage->tanggalKeluar}}
                                    </td>
                                    <td>
                                        @if($storage->status == 'available')
                                            <span class="badge badge bg-success">Available</span>
                                        @else
                                            <span class="badge badge bg-danger">Expired</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('storages.edit', $storage->id)}}" class="btn btn-primary">Edit</a>
                                        <form action="{{route('storages.destroy', $storage->id)}}" method="post" class="d-inline">
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