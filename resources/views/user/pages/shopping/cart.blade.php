@extends('user.layouts.default')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card rounded overflow-hidden" data-aos="fade-up" data-aos-delay="600">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="mb-2">Don't Just Keep It!</h4>
                        <!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mt-4">
                        <div class="table-responsive-lg">
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Item</th>
                                            <th class="text-center" scope="col">Quantity</th>
                                            <th class="text-center" scope="col">Price</th>
                                            <th class="text-center" scope="col">Totals</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach (Cart::content() as $item)
                                                <tr>
                                                    <td>
                                                        <h6 class="mb-0">{{ $item->model->name }}</h6>
                                                        {{-- <p class="mb-0">
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit.
                                                        </p> --}}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                @if ($item->qty > 1)
                                                                    <a
                                                                        type="button"
                                                                        class="btn btn-outline-secondary btn-number"
                                                                        data-type="minus"
                                                                        data-field="quant[1]"
                                                                        href="{{ route('decqty', $item->rowId) }}"
                                                                    >
                                                                        <i class="ri-subtract-line"></i>
                                                                    </a>
                                                                @else
                                                                    <a
                                                                        type="button"
                                                                        class="btn btn-outline-secondary btn-number"
                                                                        data-type="minus"
                                                                        data-field="quant[1]"
                                                                        href="{{ route('delitm', $item->rowId) }}"
                                                                    >
                                                                        <i class="ri-subtract-line"></i>
                                                                    </a>
                                                                @endif
                                                                
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input
                                                                    onchange="changeQty('{{ $item->rowId }}', this.value)"
                                                                    type="text"
                                                                    name="quant[1]"
                                                                    class="form-control input-number"
                                                                    value="{{ $item->qty }}"
                                                                    min="1"
                                                                    max="10"
                                                                />
                                                            </div>
                                                            <div class="input-group-append">
                                                                <a
                                                                    type="button"
                                                                    class="btn btn-outline-secondary btn-number"
                                                                    data-type="plus"
                                                                    data-field="quant[1]"
                                                                    href="{{ route('incqty', $item->rowId) }}"
                                                                >
                                                                    <i class="ri-add-line"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">Rp. {{ number_format($item->model->price, 0, ",", ".") }}</td>
                                                    <td class="text-center">Rp. {{ number_format($item->subtotal, 0, ",", ".") }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0">Total</h6>
                                                </td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">Rp. {{ number_format((int)Cart::total(0, "", "") - (int)Cart::tax(0, "", ""), 0, ",", ".") }}</td>
                                            </tr>
                                    </tbody>
                                </table>

                                <!-- button pay -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-right float-end">
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function changeQty(rowId, qty){
        url = "/cart/changeqty/" + rowId + "/" + qty
        $.get(url, {} ,function(data){
            location.reload();
        });
    }
</script>