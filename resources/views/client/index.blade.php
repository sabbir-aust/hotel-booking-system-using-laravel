@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clients
                    <a href="{{ url('admin/client/create') }}" class="float-right btn btn-success btn-sm">Add New</a>
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
                                <th>Client Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>GalleryImages</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @if ($data)
                                @foreach ($data as $key => $d)
                                    <tr>
                                        <td>{{ 'CM-' . $key + 1 }}</td>
                                        <td>{{ $d->clients->company_name }}</td>
                                        <td>{{ $d->person_name }}</td>
                                        <td>{{ $d->mobile_number }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->address }}</td>
                                        <td>
                                            <a href="{{ url('admin/client/' . $d->id) }}" class="btn btn-info btn-sm"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="{{ url('admin/client/' . $d->id) . '/edit' }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure to delete this data?')"
                                                href="{{ url('admin/client/' . $d->id) . '/delete' }}"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ $datas->links() }} --}}
                </div>



            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
