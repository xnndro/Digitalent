@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Laundry Vendors</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('laundries.storeVendor',$vendor->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Laundry Vendor Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$vendor->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Laundry Vendor Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$vendor->email}}">
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Laundry Vendor Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{$vendor->password}}">
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Laundry Vendor Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{$vendor->phone}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection