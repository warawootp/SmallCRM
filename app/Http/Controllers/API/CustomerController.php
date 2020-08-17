<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Key;
use Validator;

class CustomerController extends Controller
{
    public $successStatus = 200;

    public function doAction(Request $request)
    {
      $apikey = $request->key;
      if (!isset($apikey)) {
          return response()->json(['error'=>"Please provide an api key"], 401);
      }

      if(!Key::where('apikey', $apikey)->exists())
        return response()->json(['error'=>'The provided api key is not correct'], 401);

      if($request['action']===null) return response()->json(['error'=>"Please provide action"], 401);

      $data = $request->all();

      switch ($request['action']) {
        case 'add':
          return $this->store();
          break;
        case 'update':
          return $this->update();
          break;
        default:
          return response()->json(['error'=>"Incorrect action"], 401);
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store()
     {
       $request = request();
       $validator = Validator::make($request->all(), [
           'fname' => 'required',
           'lname' => 'required',
       ]);

       if($validator->fails()) {
           return response()->json(['error'=>$validator->errors()], 401);
       }
       $input['firstname'] = $request['fname'];
       $input['lastname'] = $request['lname'];

       if(Customer::where('firstname', $input['firstname'])->where('lastname', $input['lastname'])->exists())
         return response()->json(['error'=>'The customer already exists'], 401);

       $customer = Customer::create($input);
       $success['customer'] = $customer;
       return response()->json(['success'=>$success], $this-> successStatus);

     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update()
     {
       $request = request();
       $validator = Validator::make($request->all(), [
           'old_fname' => 'required',
           'old_lname' => 'required',
           'fname' => 'required',
           'lname' => 'required',
       ]);
       if ($validator->fails()) {
           return response()->json(['error'=>$validator->errors()], 401);
       }

       $customer = Customer::where('firstname', $request['old_fname'])
                           ->where('lastname', $request['old_lname'])->first();
       if($customer===null)
         return response()->json(['error'=>'The specified user does not exist'], 401);

       $customer->firstname = $request['fname'];
       $customer->lastname = $request['lname'];
       $customer->save();
       $success['customer'] = $customer;
       return response()->json(['success'=>$success], $this-> successStatus);
     }
}

?>
