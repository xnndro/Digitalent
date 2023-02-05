@extends('user.layouts.default')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card rounded overflow-hidden" data-aos="fade-up" data-aos-delay="600">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="mb-2">Apa gitu nanti</h4>
                        <!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mt-4">
                        <div class="table-responsive-lg">
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
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Item 1</h6>
                                            <p class="mb-0">
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit.
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        disabled="disabled"
                                                        data-type="minus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-subtract-line"></i>
                                                    </button>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input
                                                        type="text"
                                                        name="quant[1]"
                                                        class="form-control input-number"
                                                        value="1"
                                                        min="1"
                                                        max="10"
                                                    />
                                                </div>
                                                <div class="input-group-append">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        data-type="plus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">$120.00</td>
                                        <td class="text-center">$2,880.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Item 2</h6>
                                            <p class="mb-0">
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit.
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        disabled="disabled"
                                                        data-type="minus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-subtract-line"></i>
                                                    </button>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input
                                                        type="text"
                                                        name="quant[1]"
                                                        class="form-control input-number"
                                                        value="1"
                                                        min="1"
                                                        max="10"
                                                    />
                                                </div>
                                                <div class="input-group-append">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        data-type="plus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">$120.00</td>
                                        <td class="text-center">$2,880.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Item 1</h6>
                                            <p class="mb-0">
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit.
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        disabled="disabled"
                                                        data-type="minus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-subtract-line"></i>
                                                    </button>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input
                                                        type="text"
                                                        name="quant[1]"
                                                        class="form-control input-number"
                                                        value="1"
                                                        min="1"
                                                        max="10"
                                                    />
                                                </div>
                                                <div class="input-group-append">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        data-type="plus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">$120.00</td>
                                        <td class="text-center">$2,880.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Item 1</h6>
                                            <p class="mb-0">
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit.
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        disabled="disabled"
                                                        data-type="minus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-subtract-line"></i>
                                                    </button>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input
                                                        type="text"
                                                        name="quant[1]"
                                                        class="form-control input-number"
                                                        value="1"
                                                        min="1"
                                                        max="10"
                                                    />
                                                </div>
                                                <div class="input-group-append">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-number"
                                                        data-type="plus"
                                                        data-field="quant[1]"
                                                    >
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">$120.00</td>
                                        <td class="text-center">$2,880.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Total</h6>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center">$2,880.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Taxs</h6>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center">$2,880.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Discount</h6>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center">$2,880.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Net Amount</h6>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"><b>$2,880.00</b></td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- button pay -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-right float-end">
                                        <button type="button" class="btn btn-primary">
                                            Pay
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection