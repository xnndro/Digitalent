@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Edit Product</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('storages.update', $storage->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group{{ $errors->has('namaBarang') ? ' has-error' : '' }}">
                        <label for="namaBarang" class="col-lg-12 control-label">Nama Barang</label>
                    
                        <div class="col-lg-12">
                            <input id="namaBarang" type="text" class="form-control" name="namaBarang" value="{{ $storage->namaBarang }}" required>
                    
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
                            <select name="typeOfStorage_id" id="typeOfStorage_id" class="form-control">
                                <option value="">Pilih Jenis Barang</option>
                                @foreach ($typeOfStorages as $typeOfStorage)
                                    <option value="{{ $typeOfStorage->id }}" {{ $storage->typeOfStorage_id == $typeOfStorage->id ? 'selected' : '' }}>{{ $typeOfStorage->name }}</option>
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
                            <input id="lantai" type="number" class="form-control" name="lantai" value="{{ $storage->lantai }}" readonly>

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
                            <input id="tanggalMasuk" type="date" class="form-control" name="tanggalMasuk" value="{{ $storage->tanggalMasuk }}" required>
                    
                            @if ($errors->has('tanggalMasuk'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggalMasuk') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection