@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
             <div class="header-title">
                <h4 class="card-title">Class</h4>
            </div>
            <a type="button" href="{{route('class.create')}}" class="btn btn-primary">Add Class</a>
          </div>
          <div class="card-body px-0">
            @if($count == 0)
                <div class="d-flex justify-content-center align-items-center flex-wrap mb-5">
                    <div class="text-center">
                        <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_crwpngvr.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player>
                        <h5 class="mt-3">You Don't Have Laundry Transactions</h5>
                    </div>
                </div> 
            @else
                <div class="table-responsive">
                    <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                    <thead>
                        <tr class="ligth">
                            <th>Class Name</th>
                            <th>Total Student</th>
                            <th>Class Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($class as $c)
                            <tr>
                                <td>
                                    <h6>{{ $c->namaKelas }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $c->jumlahSiswa }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $c->status }}</h6>
                                </td>
                                <td>
                                    <a href="{{ route('class.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @if($c->status != 'Lulus')
                                        <a href="{{ route('class.status', $c->id) }}" class="btn btn-primary btn-sm">Graduate</a>
                                    @else
                                        <form action="{{ route('class.destroy', $c->id) }}" class="d-inline" method="post">
                                            @csrf
                                            @method('DELETE')    
                                            <button href="" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
           @endif
        </div>
     </div>
  </div>
</div>
@endsection