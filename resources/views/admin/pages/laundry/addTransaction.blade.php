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
                <form action="{{ route('laundries.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Student Name</label>
                        <select name="nama" class="form-control" required>
                            @if($count == 0)
                                <option value="">No Student Added</option>
                            @else
                                @foreach($username as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('nama'))
                            <span class="text-danger">{{ $errors->first('nama') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="total_pcs">Total Pieces</label>
                        <input type="number" name="total_pcs" class="form-control" value="{{ old('total_pcs') }}" required>

                        @if ($errors->has('total_pcs'))
                            <span class="text-danger">{{ $errors->first('total_pcs') }}</span>
                        @endif
                    </div>
                    @if($type == '1')
                        <div class="form-group">
                            <label for="total_kg">Total Weight</label>
                            <input type="number" name="total_kg" class="form-control" value="{{ old('total_kg') }}" required>
                            
                            @if ($errors->has('total_kg'))
                                <span class="text-danger">{{ $errors->first('total_kg') }}</span>
                            @endif
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="vendor">Choose Vendor</label>
                        <select name="vendor" class="form-control" required>
                            <option value="">Choose one</option>
                            @foreach($vendors as $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('vendor'))
                            <span class="text-danger">{{ $errors->first('vendor') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="tanggalMasuk">Date of Entry</label>
                        <input type="date" name="tanggalMasuk" class="form-control" value="{{ old('tanggalMasuk') }}" required>

                        @if ($errors->has('tanggalMasuk'))
                            <span class="text-danger">{{ $errors->first('tanggalMasuk') }}</span>
                        @endif

                    </div>

                    @if($visible == 'hidden')
                        <input type="hidden" name="type_id" value="{{ $type }}">
                        @if($type == '2' || $type == '3')
                            <input type="hidden" name="total_kg" value="0">
                        @endif
                    @endif


                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection