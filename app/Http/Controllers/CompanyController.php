<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\ForeignPerson;
use App\Models\BillPayDetails;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Company::all();
        return view('company.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'company_name'=>'required',
            'contact_person_name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
            'n_of_person'=>'required',
            'offer_price'=>'required',
        ]);

        $data=new Company;
        $data->company_name=$request->company_name;
        $data->contact_person_name=$request->contact_person_name;
        $data->mobile_number=$request->phone;
        $data->email=$request->email;
        $data->company_address=$request->address;
        $data->number_of_person=$request->n_of_person;
        $data->offer_price=$request->offer_price;
        $data->save();

        $flightInfo=new ForeignPerson;
        $flightInfo->company_id=$data->id;
        $flightInfo->person_name=$request->person_name;
        $flightInfo->passport_number=$request->passport;
        $flightInfo->flight_number=$request->flight;
        $flightInfo->save();

        $billpay=new BillPayDetails;
        $billpay->company_id=$data->id;
        $billpay->company_contact=$request->company_contact;
        $billpay->company_contact_p_number=$request->company_contact_p_number;
        $billpay->save();

        return redirect('admin/company/create')->with('success','Data has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Company::find($id);
        return view('company.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Company::find($id);
        $foreignInfo = ForeignPerson::all()->where('company_id','=',$data->id);
        $billPayInfo = BillPayDetails::all()->where('company_id','=',$data->id);
        //dd($billPayInfo);
        //$data->foreign()->get();
        return view('company.edit',['data'=>$data, 'foreignInfo' => $foreignInfo, 'billPayInfo' => $billPayInfo,]);
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
        $data=Company::find($id);
        $data->company_name=$request->company_name;
        $data->contact_person_name=$request->contact_person_name;
        $data->mobile_number=$request->phone;
        $data->email=$request->email;
        $data->company_address=$request->address;
        $data->number_of_person=$request->n_of_person;
        $data->offer_price=$request->offer_price;
        $data->save();

        $flightInfo=ForeignPerson::where('company_id', $id)->first();
        //$flightInfo->company_id=$data->id;
        $flightInfo->person_name=$request->person_name;
        $flightInfo->passport_number=$request->passport;
        $flightInfo->flight_number=$request->flight;
        $flightInfo->save();

        $billpay=BillPayDetails::where('company_id', $id)->first();
        //$billpay->company_id=$data->id;
        $billpay->company_contact=$request->company_contact;
        $billpay->company_contact_p_number=$request->company_contact_p_number;
        $billpay->save();

        return redirect('admin/company/'.$id.'/edit')->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id',$id)->delete();
        return redirect('admin/company')->with('success','Data has been deleted.');
    }
}
