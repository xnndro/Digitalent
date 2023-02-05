@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Threads</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('forum.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Title</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Description</label>
                        <textarea name="deskripsi" rows="5" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('forum.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection