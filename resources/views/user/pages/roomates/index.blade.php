@extends('user.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                @if($status == 'pending')
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_ghg0pifn.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-n5">You have requested a roommate</h5>
                        </div>
                    </div>
                </div>
                @elseif($status == 'accepted')
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                        <div class="text-center">
                            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_ghg0pifn.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                            <h5 class="mt-n5">You have a roommate</h5>
                            <div class="mt-3">Your Roomie: <span>{{$roomie->name}}</span></div>
                            <div>No.Kamar: <span class="ms-3">{{$roomName}}</span></div>
                            <div>Kamar: <span class="ms-3">{{$floor}}</span></div>
                        </div>
                    </div>
                </div>
                @else 
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">You're a good fit for roommates with</h4>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $r)
                                        <form action="{{ route('roommates.request', $r) }}" method="post">
                                            @csrf
                                            <tr>
                                                <td>
                                                    {{-- pass value to controller too --}}
                                                    <input type="hidden" name="name" value="{{ $r }}">
                                                    <h6>{{ $r }}</h6>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">Request</button>
                                                </td>
                                            </tr>
                                        </form>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection