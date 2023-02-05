@extends('admin.layouts.default')

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
                <form action="{{ route('laundries.update', $laundry->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <select name="nama" class="form-control">
                            @foreach ($username as $u)
                                <option value="{{ $u->id }}" {{ $laundry->user_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_pcs">Jumlah pcs</label>
                        <input type="number" name="total_pcs" class="form-control" value="{{ $laundry->total_pcs }}">
                    </div>
                    @if($laundry->laundry_type_id == '1')
                        <div class="form-group">
                            <label for="total_kg">Jumlah kg</label>
                            <input type="number" name="total_kg" class="form-control" value="{{ $laundry->total_kg }}">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="vendor">Pilih vendor</label>
                        <select name="vendor" class="form-control">
                            @foreach($vendors as $v)
                                <option value="{{ $v->id }}" {{ $laundry->laundry_vendor_id == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggalMasuk">Tanggal Masuk</label>
                        <input type="date" name="tanggalMasuk" class="form-control" value="{{ $laundry->tanggalMasuk }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Laundry Type</label>
                        <select name="type" id="type" class="form-control">
                            @foreach ($type as $t)
                                <option value="{{ $t->id }}" {{ $laundry->type_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($visible == 'hidden')
                        @if($laundry->laundry_type_id == '2' || $laundry->laundry_type_id == '3')
                            <input type="hidden" name="total_kg" value="0">
                        @endif
                    @endif
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection