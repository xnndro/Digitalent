@extends('user.layouts.default')

@section('content')



<div class="row">
    <!-- card in lg-12 is 4 for products shopping-->
    <div class="col-md-12 col-lg-12">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 col-lg-3">
                    <div class="card" style="border-radius: 15px;">
                        <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                          data-mdb-ripple-color="light">
                          <img src="{{asset('storage/uploads/products/'.$product->fotoBarang) }}"
                            style="border-top-left-radius: 15px; border-top-right-radius: 15px;" class="img-fluid"
                             />
                        </div>
                        <div class="card-body pb-0">
                          <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-dark fs-5">{{ $product->name }}</p>
                                <p class="small text-muted mt-n3">Stock: {{ $product->stock }}</p>
                                <h4 class="text-danger fw-bold mt-n2">Rp {{ number_format($product->price, 0, ",", ".") }}</h4>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer pb-0 justify-content-end align-items-center d-flex">
                            {{-- <hr class="my-0 mb-3" /> --}}
                            <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                                <a href="{{ route('addtocart', [$product->id, $product->name, $product->price]) }}" class="btn btn-primary">
                                    <!-- icon cart -->
                                    <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.1213 11.2331H16.8891C17.3088 11.2331 17.6386 10.8861 17.6386 10.4677C17.6386 10.0391 17.3088 9.70236 16.8891 9.70236H14.1213C13.7016 9.70236 13.3719 10.0391 13.3719 10.4677C13.3719 10.8861 13.7016 11.2331 14.1213 11.2331ZM20.1766 5.92749C20.7861 5.92749 21.1858 6.1418 21.5855 6.61123C21.9852 7.08067 22.0551 7.7542 21.9652 8.36549L21.0159 15.06C20.8361 16.3469 19.7569 17.2949 18.4879 17.2949H7.58639C6.25742 17.2949 5.15828 16.255 5.04837 14.908L4.12908 3.7834L2.62026 3.51807C2.22057 3.44664 1.94079 3.04864 2.01073 2.64043C2.08068 2.22305 2.47038 1.94649 2.88006 2.00874L5.2632 2.3751C5.60293 2.43735 5.85274 2.72207 5.88272 3.06905L6.07257 5.35499C6.10254 5.68257 6.36234 5.92749 6.68209 5.92749H20.1766ZM7.42631 18.9079C6.58697 18.9079 5.9075 19.6018 5.9075 20.459C5.9075 21.3061 6.58697 22 7.42631 22C8.25567 22 8.93514 21.3061 8.93514 20.459C8.93514 19.6018 8.25567 18.9079 7.42631 18.9079ZM18.6676 18.9079C17.8282 18.9079 17.1487 19.6018 17.1487 20.459C17.1487 21.3061 17.8282 22 18.6676 22C19.4969 22 20.1764 21.3061 20.1764 20.459C20.1764 19.6018 19.4969 18.9079 18.6676 18.9079Z"
                                            fill="currentColor">
                                        </path>
                                    </svg>                        
                                    Add to Cart</a> 
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card" style="width:16rem;height:26rem;">
                        <!-- img -->
                        <img src="{{asset('storage/uploads/products/'.$product->fotoBarang) }}" alt="User-Profile" class="card-img-top img-fluid img-responsive">
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="media-support-info mt-2">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div class="media-support-info">
                                    <p class="card-text h4"><strong>Rp. {{ number_format($product->price, 0, ",", ".") }}</strong></p>
                                    <p class="card-text h6">Stock: {{ $product->stock }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
