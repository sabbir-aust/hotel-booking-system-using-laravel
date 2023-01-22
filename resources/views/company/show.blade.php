@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data->company_name }}
                    <a href="{{ url('admin/company') }}" class="float-right btn btn-success btn-sm">View All</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $data->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $data->mobile_number }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $data->email }}</td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td>{{ $data->company_address }}</td>
                        </tr>

                        <tr>
                            <th>Total person</th>
                            <td>{{ $data->number_of_person }}</td>
                        </tr>

                        <tr>
                            <th>Offer Price</th>
                            <td>{{ $data->offer_price }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
