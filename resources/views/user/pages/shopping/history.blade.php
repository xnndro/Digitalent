@extends('user.layouts.default')

@section('content')
@if($count == 0)
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                <div class="text-center">
                    <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_ttnc5lln.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                    <h5 class="mt-3">You Don't Have any Shopping Transactions</h5>
                </div>
            </div> 
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <p class="mb-md-0 mb-2 d-flex align-items-center">
                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.56517 3C3.70108 3 3 3.71286 3 4.5904V5.52644C3 6.17647 3.24719 6.80158 3.68936 7.27177L8.5351 12.4243L8.53723 12.4211C9.47271 13.3788 9.99905 14.6734 9.99905 16.0233V20.5952C9.99905 20.9007 10.3187 21.0957 10.584 20.9516L13.3436 19.4479C13.7602 19.2204 14.0201 18.7784 14.0201 18.2984V16.0114C14.0201 14.6691 14.539 13.3799 15.466 12.4243L20.3117 7.27177C20.7528 6.80158 21 6.17647 21 5.52644V4.5904C21 3.71286 20.3 3 19.4359 3H4.56517Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Filter by invoice name...
                    </p>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="dropdown me-3">
                            <span class="dropdown-toggle align-items-center d-flex" id="dropdownMenuButton04" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By:
                            </span>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton04">
                                <a class="dropdown-item" href="#">Name Ascending</a>
                                <a class="dropdown-item" href="#">Name Descending</a>
                                <a class="dropdown-item" href="#">Date Ascending</a>
                                <a class="dropdown-item" href="#">Date Descending</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @for ($i = 0; $i < count($histories); $i++)
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">                           
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="text-pink mb-0" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#invoiceModal{{ $i }}">{{ $histories[$i]->invoice_name }}</h6>
                        <div class="modal fade" id="invoiceModal{{ $i }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $histories[$i]->invoice_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
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
                                                            @foreach ($histories_details[$i] as $item)
                                                                <tr>
                                                                    <td>
                                                                        <h6 class="mb-0">{{ $item->name }}</h6>
                                                                        <p class="mb-0">
                                                                            Lorem ipsum dolor sit amet, consectetur
                                                                            adipiscing elit.
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-center">{{ $item->qty }}</td>
                                                                    <td class="text-center">Rp. {{ number_format($item->price, 0, ",", ".") }}</td>
                                                                    <td class="text-center">Rp. {{ number_format($item->price * $item->qty, 0, ",", ".") }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td>
                                                                    <h6 class="mb-0">Total</h6>
                                                                </td>
                                                                <td class="text-center"></td>
                                                                <td class="text-center"></td>
                                                                <td class="text-center">Rp. {{ number_format($histories[$i]->total_price, 0, ",", ".") }}</td>
                                                            </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <span class="d-flex align-items-center h5 mb-0" id="dropdownMenuButton07" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <g>
                                        <g>
                                            <circle cx="7" cy="12" r="1" fill="black"/>
                                            <circle cx="12" cy="12" r="1" fill="black"/>
                                            <circle cx="17" cy="12" r="1" fill="black"/>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton07" >
                            {{-- <a class="dropdown-item" href="{{ route('') }}">
                                Rename
                            </a> --}}
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#renameModal{{ $i }}">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                    <path d="M13.7476 20.4428H21.0002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.78 3.79479C13.5557 2.86779 14.95 2.73186 15.8962 3.49173C15.9485 3.53296 17.6295 4.83879 17.6295 4.83879C18.669 5.46719 18.992 6.80311 18.3494 7.82259C18.3153 7.87718 8.81195 19.7645 8.81195 19.7645C8.49578 20.1589 8.01583 20.3918 7.50291 20.3973L3.86353 20.443L3.04353 16.9723C2.92866 16.4843 3.04353 15.9718 3.3597 15.5773L12.78 3.79479Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M11.021 6.00098L16.4732 10.1881" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Rename
                            </button>
                            <a class="dropdown-item" href="{{ route('history.del', [$histories[$i]->order_transaction_id]) }}">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Delete
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0">Date: {{ substr($histories[$i]->created_at, 0, 10) }}</p>
                    </div>
                    <div class="modal fade" id="renameModal{{ $i }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Rename invoice to...</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('history.confirmRename', [$histories[$i]->order_transaction_id]) }}">
                                @csrf
                                <div class="modal-body">
                                    <input name="new_name" type="text" class="form-control" placeholder="Input new name here">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" >Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
      
</div>
@endif
@endsection