@extends('adminVendor.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Edit Laundry Transaction</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('laundry_vendor.update', $laundry->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="total_pcs">Jumlah pcs</label>
                        <input type="number" name="total_pcs" class="form-control" value="{{ $laundry->total_pcs }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection