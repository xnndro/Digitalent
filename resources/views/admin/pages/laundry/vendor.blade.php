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
                            <h5 class="mt-3">You Haven't Added a Laundry Vendor Yet</h5>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    @else
    <div class="col-md-12 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Laundries vendor</h4>
                </div>
                <a href="{{ route('laundries.addVendor') }}" class="btn btn-primary">Add Laundry Vendor</a>
            </div>
            <div class="p-0 card-body">
                <div class="mt-4 table-responsive">
                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $v)
                            <tr>
                                <td>
                                    <h6>{{ $l->name }}</h6>
                                </td>
                                <td>
                                    {{-- button to change status to done --}}
                                    <a href="{{route('laundries.editVendor',$l->id)}}" class="btn btn-warning">Edit</a>
                                    {{-- form delete --}}
                                    <form action="{{ route('laundries.deleteVendor', $l->id) }}" method="post" class="d-inline">
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