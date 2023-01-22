<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Client::all();
        
        return view('client.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        return view('client.create', compact('company'));
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
            'full_name'=>'required',
            'phone_number'=>'required',
            'email'=>'required',
            'address'=>'required',
        ]);

        $data=new Client;
        $selected_option = $request->input('company_name');
        $data->company_id = $selected_option;
        //$new_record->save();

        $data->person_name=$request->full_name;
        $data->mobile_number=$request->phone_number;
        $data->email=$request->email;
        $data->address=$request->address;
        $data->save();

        return redirect('admin/client/create')->with('success','Data has been added.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Client::with('clients')->find($id);
        //dd($data);
        return view('client.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Client::with('clients')->find($id);
        $company = Company::all();
        //$company = Company::all()->where('company_id','=',$data->id);
        //$selected_user = $data->company_id;
        //dd($selected_user);
        //$data->foreign()->get();
        return view('client.edit',['data'=>$data,'company'=>$company,]);
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
        
        $selected_option = $request->input('company_name');
        $data=Client::find($id);
        $data->company_id = $selected_option;
        
       // dd($data);
        
        $data->person_name=$request->full_name;
        $data->mobile_number=$request->phone_number;
        $data->email=$request->email;
        $data->address=$request->address;
        $data->save();

        return redirect('admin/client/'.$id.'/edit')->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
