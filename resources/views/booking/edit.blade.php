@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update {{ $data->company->company_name }}
                    <a href="{{ url('admin/booking') }}" class="float-right btn btn-success btn-sm">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form enctype="multipart/form-data" method="post" action="{{ url('admin/booking/' . $data->id) }}">
                        @csrf
                        @method('put')
                        <table class="table table-bordered">
                            {{-- <tr>
                                <th>Select Company</th>
                                <td>
                                    <select name="company_name" class="form-control">
                                        @foreach ($data as $option)
                                            <option value="{{ $option->id }}">{{ $option->company->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr> --}}

                            <tr>
                                <th>Total Rooms</th>
                                <td><input value="{{ $data->total_rooms }}" name="total_rooms" type="number"
                                        class="form-control" min="0" /></td>
                            </tr>
                            {{-- <tr>
                                <th>Discount Percentage</th>
                                <td><input value="{{ $data->mobile_number }}" name="phone_number" type="number"
                                        class="form-control" /></td>
                            </tr> --}}
                            {{-- <tr>
                                <th>Total Price</th>
                                <td><input value="{{ $data->email }}" name="email" type="text" class="form-control" />
                                </td>
                            </tr> --}}

                            <tr>
                                <th>Status</th>
                                <td>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Paid" {{ $data->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="Due" {{ $data->status == 'Due' ? 'selected' : '' }}>Due</option>
                                    </select>
                                </td>


                            <tr>

                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="btn btn-primary" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
