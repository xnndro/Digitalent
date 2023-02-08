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
                <form action="{{ route('complains.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tipe</label>
                        <select name="name" id="name" class="form-control" required>
                            <option value="">Choose one complains type</option>
                            <option value="Kehilangan">Kehilangan</option>
                            <option value="Pakaian Kotor">Pakaian Kotor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi barang</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Foto barang</label>
                        <input type="file" name="fotoBarang" id="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="transaction">Select Transaction</label>
                        <select name="transaction" id="transaction">
                            <option value="">Choose one transaction</option>
                            @foreach ($laundries as $l)
                                <option value="{{ $l->id }}">{{ $l->laundry_transaction_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlahBarang">Jumlah Barang</label>
                        <input type="number" name="jumlahBarang" id="jumlahBarang" class="form-control" required>
                    </div>

                    <input type="hidden" name="type" value="Laundry">
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection