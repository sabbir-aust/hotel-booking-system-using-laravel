@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Booking Information
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('admin/booking') }}" class="btn btn-success btn-sm mr-2">View All</a>
                        <a href="{{ url('admin/booking/pdf/' . $data->id) }}" class="btn btn-danger btn-sm">Download as
                            PDF</a>
                    </div>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $data->company->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Room Type</th>
                            <td>{{ $data->room->rooms->title }}</td>
                        </tr>

                        <tr>
                            <th>Total Rooms</th>
                            <td>{{ $data->total_rooms }}</td>
                        </tr>

                        <tr>
                            <th>CheckIn Date</th>
                            <td>{{ $data->checkin_date }}</td>
                        </tr>

                        <tr>
                            <th>CheckIn Time</th>
                            <td>{{ date('g:i a', strtotime($data->checkin_time)) }}</td>
                        </tr>


                        <tr>
                            <th>CheckOut Date</th>
                            <td>{{ $data->checkout_date }}</td>
                        </tr>

                        <tr>
                            <th>Total Price</th>
                            <td>{{ $data->total_price }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{ $data->status }}</td>
                        </tr>

                        <tr>
                            <th>Reference</th>
                            <td>{{ $data->ref }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
