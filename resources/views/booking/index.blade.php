@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Bookings
                    <a href="{{ url('admin/booking/create') }}" class="float-right btn btn-success btn-sm">Add
                        New</a> <a href="{{ url('admin/download') }}" class="float-right btn btn-danger btn-sm">Download All
                        Bookings as PDF</a>

                </h6>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                {{-- <th>Room No.</th> --}}
                                <th>Room Type</th>
                                <th>Total Rooms</th>
                                <th>CheckIn Date</th>
                                <th>CheckIn Time</th>
                                <th>CheckOut Date</th>
                                <th>Total Price</th>
                                <th>Ref</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Room No.</th>
                                <th>Room Type</th>
                                <th>CheckIn Date</th>
                                <th>CheckOut Date</th>
                                <th>Ref</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($data as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->company->company_name }}</td>
                                    {{-- <td>{{ $booking->room->title }}</td> --}}
                                    <td>{{ $booking->room->rooms->title }}</td>
                                    <td>{{ $booking->total_rooms }}</td>
                                    <td>{{ $booking->checkin_date }}</td>
                                    <td>{{ date('g:i a', strtotime($booking->checkin_time)) }}</td>
                                    <td>{{ $booking->checkout_date }}</td>
                                    <td>{{ $booking->total_price }}</td>
                                    <td>{{ $booking->ref }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>
                                        <a href="{{ url('admin/booking/' . $booking->id) }}" class="btn btn-info btn-sm"><i
                                                class="fa fa-eye"></i></a>

                                        {{-- <a href="{{ url('admin/booking/' . $booking->id) . '/edit' }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> --}}
                                        <a href="{{ url('admin/booking/' . $booking->id . '/delete') }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this data?')"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
                {{-- {{ $data->links() }} --}}
            </div>

        </div>


    </div>

    <!-- /.container-fluid -->

@section('scripts')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection

@endsection
