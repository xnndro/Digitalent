@extends('user.layouts.default')uts.default')

@section('content')
<div class="row">
    <!-- add product card -->
    <div class="col-md-6 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Add Product</h4>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label class="form-label" for="email">Nama Product</label>
                        <input type="text" class="form-control" id="email1" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pwd">Jenis Product</label>
                        <!-- select -->
                        <select
                            class="form-select"
                            aria-label="Default select example"
                        >
                            <option selected>Pilih Jenis Product</option>
                            <option value="1">Makanan</option>
                            <option value="2">Minuman</option>
                            <option value="3">Snack</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pwd"
                            >Batas Waktu Penyimpanan</label
                        >
                        <input type="date" class="form-control" id="pwd1" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- table product -->
    <div class="col-md-12 col-lg-12">
        <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Yours products</h4>
                </div>
            
            </div>
            <div class="p-0 card-body">
                <div class="mt-4 table-responsive">
                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                        <thead>
                            <tr>
                                <th>Products Name</th>
                                <th>Type of Products</th>
                                <th>Date in</th>
                                <th>Date out</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6>Bangor</h6>
                                </td>
                                <td>Makanan</td>
                                <td>
                                    February, 31 February 2055
                                </td>
                                <td>
                                    February, 31 February 2055
                                </td>
                                <td>
                                    <span class="badge badge bg-success">Active</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <h6>Bangor</h6>
                                </td>
                                <td>Makanan</td>
                                <td>
                                    February, 31 February 2055
                                </td>
                                <td>
                                    February, 31 February 2055
                                </td>
                                <td>
                                    <span class="badge badge bg-danger">Out</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection