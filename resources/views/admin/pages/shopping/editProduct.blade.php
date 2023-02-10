@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Edit Products</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img src="{{ asset('storage/uploads/products/'.$product->fotoBarang) }}" alt="" width="250px" class="img-fluid"><br>
                        <label for="image">Products Image</label>
                        <input type="file" name="fotoBarang" id="image" class="form-control" value="{{$product->fotoBarang}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Products Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Products Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" value="{{$product->stock}}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" id="price" cols="30" rows="10" class="form-control" value="{{$product->price}}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection