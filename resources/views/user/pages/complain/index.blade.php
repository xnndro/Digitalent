@extends('user.layouts.default')

@section('content')
<div class="row">
    @if($complains_count == 0)
        <div class="col-lg-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('forum.create')}}" class="btn btn-primary">Add Complain</a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_0owih56n.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                        <h5 class="mt-n5">No Complain Added</h5>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg-12">
            
        </div>


    @endif
</div>
@endsection