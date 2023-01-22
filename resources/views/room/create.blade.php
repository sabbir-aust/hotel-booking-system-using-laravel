@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Room
                    <a href="{{ url('admin/rooms') }}" class="float-right btn btn-success btn-sm">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="text-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form method="post" action="{{ url('admin/rooms') }}" id="form-test">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th>Select Room Type</th>
                                <td>
                                    <select name="rt_id" class="form-control">
                                        <option value="0">--- Select ---</option>
                                        @foreach ($roomtypes as $rt)
                                            <option value="{{ $rt->id }}">{{ $rt->title }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td><input name="title" type="text" class="form-control" /></td>
                            </tr>
                            <tr>

                                {{-- <tr>
                                <th>Airport pick/drop</th>
                                <td>
                                    <label for="chkPassport">
                                        <input type="checkbox" id="chkPassport" />
                                        Yes
                                    </label>
                            <tr>
                                <th>Passport Number:</th>
                                <td><input type="text" class="form-control" id="txtPassportNumber" disabled="disabled" />
                                </td>
                            </tr>
                            <tr>
                                <th>Flight no</th>
                                <td><input id="flight" name="flight" type="text" class="form-control"
                                        disabled="disabled" /></td>
                            </tr> --}}

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
{{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $("#chkPassport").click(function() {
            if ($(this).is(":checked")) {
                $("#txtPassportNumber").removeAttr("disabled");
                $("#txtPassportNumber").focus();
                $("#flight").removeAttr("disabled");
                $("#flight").focus();
            } else {
                $("#txtPassportNumber").attr("disabled", "disabled");
                $("#flight").attr("disabled", "disabled");
            }
        });
    });
</script> --}}
