@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Company
                    <a href="{{ url('admin/company') }}" class="float-right btn btn-success btn-sm">View All</a>
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
                    <form enctype="multipart/form-data" method="post" action="{{ url('admin/company') }}">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th>Company Name</th>
                                <td><input name="company_name" type="text" class="form-control" /></td>
                            </tr>
                            <tr>
                                <th>Contact Person Name</th>
                                <td><input name="contact_person_name" type="text" class="form-control" /></td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td><input name="phone" type="number" class="form-control" /></td>
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
                                <th>Number of Person</th>
                                <td><input name="n_of_person" type="number" class="form-control" /></td>
                            </tr>

                            <tr>
                                <th>Airport pick/drop</th>
                                <td><label for="chkPassport">
                                        <input type="checkbox" id="chkPassport" />
                                        Yes
                                    </label></td>
                            </tr>

                            <tr>
                                <th>Person name</th>
                                <td><input type="text" class="form-control" name="person_name" id="person_name"
                                        disabled="disabled" />
                                </td>
                            </tr>

                            <tr>
                                <th>Passport Number</th>
                                <td><input type="text" class="form-control" name="passport" id="txtPassportNumber"
                                        disabled="disabled" />
                                </td>
                            </tr>

                            <tr>
                                <th>Flight no</th>
                                <td><input id="flight" name="flight" type="text" class="form-control"
                                        disabled="disabled" /></td>
                            </tr>
                            <tr>
                                <th>Offer Price</th>
                                <td><input name="offer_price" type="number" class="form-control" /></td>
                            </tr>

                            <tr>
                                <th>Bill Pay Option</th>
                                <td><label for="chkBillPay">
                                        <input type="checkbox" id="chkBillPay" />
                                        Company
                                    </label></td>
                            </tr>

                            <tr>
                                <th>Company Contact Person</th>
                                <td><input type="text" class="form-control" id="txtCompanyContact" name="company_contact"
                                        disabled="disabled" />
                                </td>
                            </tr>

                            <tr>
                                <th>Company Contact Person number</th>
                                <td><input type="text" class="form-control" id="txtCompanyContactPNumber"
                                        name="company_contact_p_number" disabled="disabled" />
                                </td>
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

<script type="text/javascript">
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
</script>
