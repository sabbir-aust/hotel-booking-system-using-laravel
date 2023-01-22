<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Cookie;


class AdminController extends Controller
{
    public function adminLoginForm(){
        return view('backend.admin.admin_login');
    }

    public function adminLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $admin=Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password]);
        if ($admin == true) {
            session(['adminData'=>$admin]);
            return redirect('/admin/dashboard');
        }else{
            Session::flash('error-msg', 'Invalid Email or Password');
            return redirect()->back();
        }
    }

    public function adminLogout()
{
    Auth::guard('admin')->logout();
    return redirect('admin/login');
}


    public function dashboard(){
        $bookings=Booking::selectRaw('count(id) as total_bookings,checkin_date')->groupBy('checkin_date')->get();
        //print_r($bookings);
        $labels=[];
        $data=[];
        foreach($bookings as $booking){
            $labels[]=$booking['checkin_date'];
            $data[]=$booking['total_bookings'];
        }
       

     // For Pie Chart
     $rtbookings=DB::table('room_types as rt')
     ->join('rooms as r','r.room_type_id','=','rt.id')
     ->join('bookings as b','b.room_id','=','r.id')
     ->select('rt.*','r.*','b.*',DB::raw('count(b.id) as total_bookings'))
     ->groupBy('r.room_type_id')
     ->get();
    $plabels=[];
    $pdata=[];
    foreach($rtbookings as $rbooking){
        $plabels[]=$rbooking->title;
        $pdata[]=$rbooking->total_bookings;
    }

        //echo($plabels);
// End

//  echo '<pre>';
// print_r($rtbookings);
return view('backend.dashboard.admin_dashboard', ['labels'=>$labels,'data'=>$data, 'plabels'=>$plabels,'pdata'=>$pdata]);
//return view('dashboard.admin_dashboard', ['bookings'=>$bookings]);






}
}
