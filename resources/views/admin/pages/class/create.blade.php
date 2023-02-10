@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Class</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('class.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Class Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('class.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection