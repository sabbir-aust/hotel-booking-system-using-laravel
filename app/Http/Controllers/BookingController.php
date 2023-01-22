<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon as Carbon;
use Dompdf\Dompdf;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Company;
use App\Models\RoomType;
use App\Models\Room;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$bookings = Booking::orderBy('checkin_date', 'asc')->simplePaginate(10);
        $bookings = Booking::all();
        //dd($bookings);
        //dd($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator);
       return view('booking.index', ['data' => $bookings]);
      //return view('booking.index', compact('bookings','customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        
        //dd( $company);
        return view('booking.create', ['company' => $company]);
    }

    public function fetchNumberOfPerson($companyId)
    {
        $numberOfPerson = Company::where('id', $companyId)->value('number_of_person');
        return response()->json($numberOfPerson);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'room_id' => 'required',
            'checkin_date' => 'required',
        'checkout_date' => 'required',
        'checkin_time' => 'required',
        'total_person' => 'required',
        'total_price' => 'required',
        // 'discount_percentage' => 'required|numeric|between:0,100',

    ]);

    $company_id = $request->input('company_id');
    $room_id = $request->input('room_id');
    $checkin_date = $request->input('checkin_date');
    $checkout_date = $request->input('checkout_date');
    $checkin_time = $request->input('checkin_time');
    $total_person = $request->input('total_person');
    $total_rooms = $request->input('total_roooms');
    $status = $request->input('status');
    $ref = Auth::guard('admin')->user()->name;
    // $discount_percentage = $request->input('discount_percentage');
    $total_price = $request->input('total_price');
    
    // Get company and room data
    // $company = Company::find($company_id);
    // $room = Room::find($room_id);
    // $price = $room->rooms->price;

    // Calculate duration between check-in and check-out
    // $checkin = Carbon::createFromFormat('Y-m-d', $checkin_date);
    // $checkout = Carbon::createFromFormat('Y-m-d', $checkout_date);
    // $duration = $checkin->diffInDays($checkout);

    // Calculate total price
    // $total_price = floatval($price) * $duration * intval($total_rooms);
    // $discount_percentage = $total_price * (intval($discount_percentage) / 100);
    // dd(intval($discount_percentage) / 100);
    // $total_price = $total_price - $discount_percentage;
    $booking = new Booking();
    $booking->company_id = $company_id;
    $booking->room_id = $room_id;
    $booking->checkin_date = $checkin_date;
    $booking->checkout_date = $checkout_date;
    $booking->checkin_time = $checkin_time;
    $booking->total_person = $total_person;
    $booking->total_rooms = $total_rooms;
    $booking->status = $status;
    $booking->ref = $ref;
    $booking->total_price = $total_price;
    $booking->save();

    return redirect('admin/booking/create')->with('success', 'Data has been added.');
}





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Booking::find($id);
        return view('booking.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Booking::find($id);
        //dd($data);
        return view('booking.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'total_rooms' => 'required|numeric|min:0',
        'status' => 'required',
    ]);

    $data = Booking::find($id);
    $data->total_rooms = $request->input('total_rooms');
    $data->status = $request->input('status');
    $data->save();

    return redirect('admin/booking')->with('success', 'Data has been updated.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::where('id',$id)->delete();
        return redirect('admin/booking')->with('success','Data has been deleted.');
    }

    // Check Avaiable rooms
    function available_rooms(Request $request, $checkin_date)
    {
        $arooms = DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");

        $data = [];
        foreach ($arooms as $room) {
            $roomTypes = RoomType::find($room->room_type_id);
            $data[] = ['room' => $room, 'roomtype' => $roomTypes];
        }

        return response()->json(['data' => $data]);
    }


//     public function confirm(Request $request)
//     {
//     // Access POST data
//     $company_id = $request->input('company_id');
//     $checkin_date = $request->input('checkin_date');
//     $checkout_date = $request->input('checkout_date');
//     $checkin_time = $request->input('checkin_time');
//     $room_id = $request->input('room_id');
//     $total_rooms = $request->input('total_roooms');
    
//     $total_person = $request->input('total_person');
//     $ref = Auth::guard('admin')->user()->name;
//     $status = $request->input('status');

//     // Get company and room data
//     $company = Company::find($company_id);
//     $room = Room::find($room_id);
//     $price = $room->rooms->price;

//     // Calculate duration between check-in and check-out
//     $checkin = Carbon::createFromFormat('Y-m-d', $checkin_date);
//     $checkout = Carbon::createFromFormat('Y-m-d', $checkout_date);
//     $duration = $checkin->diffInDays($checkout);

//     // Calculate total price
//     $total_price = floatval($price) * $duration * intval($total_rooms);

//     $data = [
//         'company_id' => $company_id,
//         'room_id' => $room_id,
//         'checkin_date' => $checkin_date,
//         'checkout_date' => $checkout_date,
//         'checkin_time' => $checkin_time,
//         'total_person' => $total_person,
//         'status' => $status,
//         'total_price' => $total_price
//     ];
// //dd($data);
    
//     // Render view and pass data to it
//     // return view('booking/booking-confirm', [
//     //     'company_id' => $company_id,
//     //     'checkin_date' => $checkin_date,
//     //     'checkout_date' => $checkout_date,
//     //     'checkin_time' => $checkin_time,
//     //     'room_id' => $room_id,
//     //     'total_rooms' => $total_rooms,
//     //     'total_person' => $total_person,
//     //     'ref' => $ref,
//     //     'status' => $status,
//     //     'company' => $company,
//     //     'room' => $room,
//     //     'total_price' => $total_price,
//     //     ]);
//     // }
//     return redirect()->route('booking.store', $data);

//     }




    public function downloadPdf($id)
    {
        $data = Booking::find($id);
        //dd($data);
        dd(request()->route()->getName());
        $pdf = new Dompdf();
        $pdf->loadHtml($this->generatePdfBody($data));
        $pdf->setPaper('A4', 'portrait');
        // $pdf->set_option('defaultFont', 'Courier');
        // $pdf->load_html($this->generatePdfBody($data), 'UTF-8');
        $pdf->render();
        $pdf->stream("booking-".$data->id.".pdf", array("Attachment" => false));

    }

    public function downloadAllBookingsPdf()
    {
        // Retrieve all bookings from the database
        $data = Booking::all();
        //dd($data);
        //dd(request()->route()->getName());
        // Create a new instance of Dompdf
        $pdf = new Dompdf();
        $pdf->set_option('defaultFont', 'Courier');
        // Load the HTML code for the PDF
        $pdf->loadHtml($this->generatePdfBodyForAll($data), 'UTF-8');
        // Render the PDF
        $pdf->render();
        // Stream the PDF to the client
        $pdf->stream("booking.pdf", array("Attachment" => false));
    }


    public function generatePdfBody($data)
    {
        return '
        <table style="width: 100%;border-collapse: collapse; border:1px solid black">
        <tr>
            <th style="width: 25%;border:1px solid black">Company Name</th>
            <td style="width: 75%;border:1px solid black">'.$data->company->company_name.'</td>
        </tr>
        <tr>
            <th style="width: 25%;border:1px solid black">Room Type</th>
            <td style="width: 75%;border:1px solid black">'.$data->room->rooms->title.'</td>
        </tr>

        <tr>
            <th style="width: 25%;border:1px solid black">Total Rooms</th>
            <td style="width: 75%;border:1px solid black">'.$data->total_rooms.'</td>
        </tr>

        <tr>
            <th style="width: 25%; border:1px solid black">CheckIn Date</th>
            <td style="width: 75%; border:1px solid black">'.$data->checkin_date.'</td>
        </tr>


        <tr>
            <th style="width: 25%;border:1px solid black">CheckIn Time</th>
            <td style="width: 75%;border:1px solid black">'.date('g:i a', strtotime($data->checkin_time)).'</td>
        </tr>


        <tr>
            <th style="width: 25%;border:1px solid black">CheckOut Date</th>
            <td style="width: 75%;border:1px solid black">'.$data->checkout_date.'</td>
        </tr>

        <tr>
            <th style="width: 25%;border:1px solid black">Total Price</th>
            <td style="width: 75%;border:1px solid black">'.$data->total_price.'</td>
        </tr>

        <tr>
            <th style="width: 25%;border:1px solid black">Status</th>
            <td style="width: 75%;border:1px solid black">'.$data->status.'</td>
        </tr>

        <tr>
            <th style="width: 25%;border:1px solid black">Reference</th>
            <td style="width: 75%;border:1px solid black">'.$data->ref.'</td>
        </tr>
    </table>';
    }



    
public function generatePdfBodyForAll($data)
{
    $output = '<table style="width: 100%; border-collapse: collapse; border:1px solid black">
    <tr>
        
        <th style="width: 25%; border:1px solid black">Company Name</th>
        <th style="width: 25%; border:1px solid black">Room Type</th>
        <th style="width: 25%; border:1px solid black">Total Rooms</th>
        <th style="width: 25%; border:1px solid black">CheckIn Date</th>
        <th style="width: 25%; border:1px solid black">CheckIn Time</th>
        <th style="width: 25%; border:1px solid black">CheckOut Date</th>
        <th style="width: 25%; border:1px solid black">Total Price</th>
        <th style="width: 25%; border:1px solid black">Ref</th>
        <th style="width: 25%; border:1px solid black">Status</th>
    </tr>';

    foreach($data as $booking) {
        $output .= '
        <tr>
            
            <td style="width: 25%; border:1px solid black">'. $booking->company->company_name.'</td>
            <td style="width: 25%; border:1px solid black">'. $booking->room->rooms->title.'</td>
            <td style="width: 25%; border:1px solid black">'. $booking->total_rooms.'</td>
            <td style="width: 25%; border:1px solid black">'. $booking->checkin_date.'</td>
            <td style="width: 25%; border:1px solid black">'. date('g:i a', strtotime($booking->checkin_time)).'</td>
            <td style="width: 25%; border:1px solid black">'. $booking->checkout_date.'</td>
            <td style="width: 25%; border:1px solid black">'. $booking->total_price.'</td>
            <td style="width: 25%; border:1px solid black">'. $booking->ref.'</td>
            <td style="width: 25%; border:1px solid black">'. $booking->status.'</td>
        </tr>';
    }
    $output .= '</table>';
    return $output;
}


}
