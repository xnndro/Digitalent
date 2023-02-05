@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Laundry Transaction</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('laundries.bridge') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="class">Kelas</label>
                        <select name="class" id="class" class="form-control" required>
                            @if($count == 0)
                                <option value="Gada kelas">No Class Added</option>
                            @else
                                @foreach ($class as $c)
                                    <option value="{{ $c->id }}">{{ $c->namaKelas }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Laundry Type</label>
                        <select name="type" id="type" class="form-control" required>
                            @foreach ($type as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Next</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection