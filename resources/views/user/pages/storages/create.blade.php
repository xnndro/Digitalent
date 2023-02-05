@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Product</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('storages.store') }}" method="post">
                    @csrf
                    <div class="form-group{{ $errors->has('namaBarang') ? ' has-error' : '' }}">
                        <label for="namaBarang" class="col-lg-12 control-label">Nama Barang</label>
                    
                        <div class="col-lg-12">
                            <input id="namaBarang" type="text" class="form-control" name="namaBarang" value="{{ old('namaBarang') }}" required>
                    
                            @if ($errors->has('namaBarang'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('namaBarang') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('typeOfStorage_id') ? ' has-error' : '' }}">
                        <label for="typeOfStorage_id" class="col-lg-12 control-label">Jenis Barang</label>

                        <div class="col-lg-12">
                            <select id="typeOfStorage_id" class="form-control" name="typeOfStorage_id" required>
                                @foreach($typeOfStorages as $typeOfStorage)
                                    <option value="{{ $typeOfStorage->id }}">{{ $typeOfStorage->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('typeOfStorage_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('typeOfStorage_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('lantai') ? ' has-error' : '' }}">
                        <label for="lantai" class="col-lg-12 control-label">Lantai</label>

                        <div class="col-lg-12">
                            <input id="lantai" type="number" class="form-control" name="lantai" value="{{ $lantai }}" readonly>

                            @if ($errors->has('lantai'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lantai') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tanggalMasuk') ? ' has-error' : '' }}">
                        <label for="tanggalMasuk" class="col-lg-12 control-label">Tanggal Masuk</label>
                    
                        <div class="col-lg-12">
                            <input id="tanggalMasuk" type="date" class="form-control" name="tanggalMasuk" value="{{ old('tanggalMasuk') }}" required>
                    
                            @if ($errors->has('tanggalMasuk'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggalMasuk') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection