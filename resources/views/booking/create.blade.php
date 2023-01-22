@extends('layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Booking
                    <a href="{{ url('admin/booking') }}" class="float-right btn btn-success btn-sm">View All</a>
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
                    <form method="post" action="{{ url('admin/booking') }}" id="booking-form">

                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th>Select Company <span class="text-danger">*</span></th>
                                <td>
                                    <select class="form-control" name="company_id" id="company_id"
                                        onchange="fetchNumberOfPerson()">
                                        <option>--- Select Company ---</option>
                                        @foreach ($company as $data)
                                            <option value="{{ $data->id }}">{{ $data->company_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>CheckIn Date <span class="text-danger">*</span></th>
                                <td><input name="checkin_date" type="date" class="form-control checkin-date" /></td>
                            </tr>
                            <tr>
                                <th>CheckOut Date <span class="text-danger">*</span></th>
                                <td><input name="checkout_date" type="date" class="form-control" /></td>
                            </tr>

                            <tr>
                                <th>CheckIn Time <span class="text-danger">*</span></th>
                                <td><input name="checkin_time" type="time" class="form-control" /></td>
                            </tr>

                            <tr>
                                <th>Avaiable Rooms <span class="text-danger">*</span></th>
                                <td>
                                    <select class="form-control room-list" name="room_id" id="room_id">

                                    </select>
                                    <p>Price: <span class="show-room-price" id="room_price"></span></p>
                                </td>
                            </tr>

                            <tr>
                                <th>Total Person <span class="text-danger">*</span></th>
                                <td><input value="" name="total_person" id="total_person" type="number"
                                        class="form-control" /></td>
                            </tr>

                            <tr>
                                <th>Total Rooms</th>
                                <td><input name="total_roooms" type="text" class="form-control" id="total_rooms" /></td>
                            </tr>

                            <tr>
                                <th>Discount Percentage</th>
                                <td>
                                    <input type="number" name="discount_percentage" class="form-control" min="0"
                                        max="100" placeholder="Enter discount percentage">
                                </td>
                            </tr>


                            <tr>
                                <th>Total Price</th>
                                <td><input id="total_price" name="total_price" type="decimal" class="form-control"
                                        readonly /></td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td><select class="form-control" id="status" name="status">
                                        <option value="Paid">Paid</option>
                                        <option value="Due">Due</option>
                                    </select></td>
                            </tr>


                            <tr>
                                <td colspan="2" class="text-center">
                                    <input type="submit" value="Confirm Booking" class="btn btn-success">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>

    {{-- <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">

        <!-- Then put toasts within -->
        <div id="booking-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
            style="display: none;">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Booking Created</strong>
                <small class="booking-time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                A new booking has been created!
            </div>
        </div>
    </div> --}}
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <script>
        function calculateTotalPrice() {
            var room_price = $('#room_price').text();
            var total_rooms = $('#total_rooms').val();
            var discount_percentage = $('[name="discount_percentage"]').val();
            var total_price = room_price * total_rooms;
            var discounted_price = total_price - (total_price * discount_percentage / 100);
            $('#total_price').val(discounted_price.toFixed(2));
        }

        $(document).ready(function() {
            $(document).on('change', '#room_id', function() {
                var room_id = $(this).val();
                var a = $('#room_id').find(':selected').data('price');
                console.log(a);
                $('#room_price').text(a);
                calculateTotalPrice();
            });

            $(document).on('change', '#total_rooms, [name="discount_percentage"]', function() {
                calculateTotalPrice();
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".checkin-date").on('blur', function() {
                var _checkindate = $(this).val();
                // Ajax
                $.ajax({
                    url: "{{ url('admin/booking') }}/available-rooms/" + _checkindate,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".room-list").html('<option>--- Loading ---</option>');
                    },
                    success: function(res) {
                        var _html = '';
                        $.each(res.data, function(index, row) {
                            _html += '<option data-price="' + row.roomtype.price +
                                '" value="' + row.room.id + '">' + row.room.title +
                                '-' + row.roomtype.title + '</option>';

                        });
                        $(".room-list").html(_html);

                        var _selectedPrice = $(".room-list").find('option:selected').attr(
                            'data-price');
                        $(".room-price").val(_selectedPrice);
                        $(".show-room-price").text(_selectedPrice);
                    }
                });
            });

            $(document).on("change", ".room-list", function() {
                var _selectedPrice = $(this).find('option:selected').attr('data-price');
                $(".room-price").val(_selectedPrice);
                $(".show-room-price").text(_selectedPrice);
            });

        });


        function fetchNumberOfPerson() {
            console.log('fetchNumberOfPerson function is being triggered');
            // Get the selected company id
            var companyId = document.getElementById('company_id').value;
            console.log(companyId);

            // Send an AJAX request to the server
            fetch('/admin/booking/total/' + companyId)
                .then(function(response) {
                    return response.json();
                    console.log(response.json());
                })
                .then(function(numberOfPerson) {
                    // Update the value of the input element
                    document.getElementById('total_person').value = numberOfPerson;
                });
        }
    </script>



@endsection
