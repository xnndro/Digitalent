@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Complains</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('complains.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Fasilitas</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Keluhan</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                    </div>

                    <input type="hidden" name="type" value="Fasilitas">
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection