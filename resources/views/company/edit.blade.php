@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update {{ $data->company_name }}
                    <a href="{{ url('admin/company') }}" class="float-right btn btn-success btn-sm">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form enctype="multipart/form-data" method="post" action="{{ url('admin/company/' . $data->id) }}">
                        @csrf
                        @method('put')
                        <table class="table table-bordered">
                            <tr>
                                <th>Company Name</th>
                                <td><input value="{{ $data->company_name }}" name="company_name" type="text"
                                        class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <th>Contact Person Name</th>
                                <td><input value="{{ $data->contact_person_name }}" name="contact_person_name"
                                        type="text" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td><input value="{{ $data->mobile_number }}" name="phone" type="number"
                                        class="form-control" />
                                </td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td><input value="{{ $data->email }}" name="email" type="text" class="form-control" />
                                </td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td><input value="{{ $data->company_address }}" name="address" type="text"
                                        class="form-control" />
                                </td>
                            </tr>

                            <tr>
                                <th>Number of Person</th>
                                <td><input value="{{ $data->number_of_person }}" name="n_of_person" type="number"
                                        class="form-control" />
                                </td>
                            </tr>

                            <tr>
                                <th>Airport pick/drop</th>
                                <td><label for="chkPassport">
                                        <input type="checkbox" id="chkPassport" />
                                        Yes
                                    </label></td>
                            </tr>
                            @if ($foreignInfo)
                                @foreach ($foreignInfo as $d)
                                    <tr>
                                        <th>Person name</th>
                                        <td><input value="{{ $d->person_name }}" name="person_name" id="person_name"
                                                type="text" class="form-control" disabled="disabled" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Passport Number:</th>
                                        <td><input value="{{ $d->passport_number }}" name="passport" type="text"
                                                class="form-control" disabled="disabled" id="txtPassportNumber" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Flight no</th>
                                        <td><input value="{{ $d->flight_number }}" id="flight" name="flight"
                                                type="text" class="form-control" disabled="disabled" />
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <th>Offer Price</th>
                                <td><input value="{{ $data->offer_price }}" name="offer_price" type="number"
                                        class="form-control" />
                                </td>
                            </tr>

                            <tr>
                                <th>Bill Pay Option</th>
                                <td><label for="chkBillPay">
                                        <input type="checkbox" id="chkBillPay" />
                                        Company
                                    </label></td>
                            </tr>
                            @if ($billPayInfo)
                                @foreach ($billPayInfo as $ds)
                                    <tr>
                                        <th>Company Contact Person</th>
                                        <td><input value="{{ $ds->company_contact }}" name="company_contact" type="text"
                                                class="form-control" disabled="disabled" id="txtCompanyContact" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Company Contact Person number</th>
                                        <td><input value="{{ $ds->company_contact_p_number }}"
                                                name="company_contact_p_number" id="txtCompanyContactPNumber" type="text"
                                                class="form-control" disabled="disabled" />
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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

    {{-- @section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".delete-image").on('click', function() {
                var _img_id = $(this).attr('data-image-id');
                var _vm = $(this);
                $.ajax({
                    url: "{{ url('admin/roomtypeimage/delete') }}/" + _img_id,
                    dataType: 'json',
                    beforeSend: function() {
                        _vm.addClass('disabled');
                    },
                    success: function(res) {
                        if (res.bool == true) {
                            $(".imgcol" + _img_id).remove();
                        }
                        _vm.removeClass('disabled');
                    }
                });
            });
        });
    </script>
@endsection --}}
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
