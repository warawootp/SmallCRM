<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'fname' => 'required',
          'lname' => 'required',
      ]);
      if ($validator->fails()) {
          return redirect()->route('customers.index')->withErrors(['The field Firstname and Lastname are required.']);
      }
      $input['firstname'] = $request['fname'];
      $input['lastname'] = $request['lname'];

      if(Customer::where('firstname', $input['firstname'])->where('lastname', $input['lastname'])->exists())
        return redirect()->route('customers.index')->withErrors(['error'=>'The customer already exists']);

      Customer::create($input);
      return redirect()->route('customers.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
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
      $validator = Validator::make($request->all(), [
          'fname' => 'required',
          'lname' => 'required',
      ]);
      if ($validator->fails()) {
        return redirect()->route('customers.index')->withErrors(['The field Firstname and Lastname are required.']);
      }
      $customer = Customer::find($id);
      $customer->firstname = $request['fname'];
      $customer->lastname = $request['lname'];
      $customer->save();
      return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $customer = Customer::find($id);
      $customer->delete();
      return redirect()->route('customers.index');
    }
}
