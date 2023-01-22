@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update {{ $data->person_name }}
                    <a href="{{ url('admin/client') }}" class="float-right btn btn-success btn-sm">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form enctype="multipart/form-data" method="post" action="{{ url('admin/client/' . $data->id) }}">
                        @csrf
                        @method('put')
                        <table class="table table-bordered">
                            <tr>
                                <th>Select Company</th>
                                <td>
                                    <select name="company_name" class="form-control">
                                        @foreach ($company as $option)
                                            <option value="{{ $option->id }}">{{ $option->company_name }}</option>
                                            {{-- <option value="{{ $option->id }}"
                                                @if ($data->company_id == $option->company_id) selected @endif>
                                                {{ $option->company_name }}</option> --}}
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Full Name</th>
                                <td><input value="{{ $data->person_name }}" name="full_name" type="text"
                                        class="form-control" /></td>
                            </tr>
                            <tr>
                                <th>Phone number</th>
                                <td><input value="{{ $data->mobile_number }}" name="phone_number" type="number"
                                        class="form-control" /></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><input value="{{ $data->email }}" name="email" type="text" class="form-control" />
                                </td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td><input value="{{ $data->address }}" name="address" type="text"
                                        class="form-control" /></td>
                            </tr>

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
