@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Client
                    <a href="{{ url('admin/client') }}" class="float-right btn btn-success btn-sm">View All</a>
                </h6>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

                @if (Session::has('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form enctype="multipart/form-data" method="post" action="{{ url('admin/client') }}">
                        @csrf
                        <table class="table table-bordered">

                            <tr>
                                <th>Select Company</th>
                                <td>
                                    <select name="company_name" class="form-control">
                                        @foreach ($company as $option)
                                            <option value="{{ $option->id }}">{{ $option->company_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Full Name</th>
                                <td><input name="full_name" type="text" class="form-control" /></td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td><input name="phone_number" type="number" class="form-control" /></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><input name="email" type="text" class="form-control" /></td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td><input name="address" type="text" class="form-control" /></td>
                            </tr>

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

{{-- <script type="text/javascript">
    $(function() {
        $("#chkPassport").click(function() {
            if ($(this).is(":checked")) {
                $("#txtPassportNumber").removeAttr("disabled");
                $("#txtPassportNumber").focus();
                $("#flight").removeAttr("disabled");
                $("#flight").focus();
                $("#person_name").removeAttr("disabled");
                $("#person_name").focus();
            } else {
                $("#txtPassportNumber").attr("disabled", "disabled");
                $("#flight").attr("disabled", "disabled");
                $("#person_name").attr("disabled", "disabled");
            }
        });
    });

    $(function() {
        $("#chkBillPay").click(function() {
            if ($(this).is(":checked")) {
                $("#txtCompanyContact").removeAttr("disabled");
                $("#txtCompanyContact").focus();
                $("#txtCompanyContactPNumber").removeAttr("disabled");
                $("#txtCompanyContactPNumber").focus();
            } else {
                $("#txtCompanyContact").attr("disabled", "disabled");
                $("#txtCompanyContactPNumber").attr("disabled", "disabled");
            }
        });
    });
</script> --}}
