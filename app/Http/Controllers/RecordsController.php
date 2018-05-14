<?php

namespace App\Http\Controllers;

use App\Msisdn;
use App\Records;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $records = Records::all();

      return view ('records')->with('records', $records);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $record
     * @return \Illuminate\Http\Response
     */
    public function show($record)
    {
      $record = Records::find($record);
      $data = (array) json_decode($record->data);

      return view('record')->with(['data' => $data, 'phone_number' => $record->phone_number]);
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
        //
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

    public function validateNumber(Request $request) {
      // Number field is required and also validate E.164 format.
      $this->validate($request, [
        'number' => ['required', new ValidPhoneNumber()],
      ]);

      // Retrieve the validated input data.
      $number = $request->number;

      // Define our class.
      $msisdn = new Msisdn($number);

      // Create new record.
      $record = $msisdn->createNewRecord();

      // Redirect to our route.
      return redirect(route('record.item', ['record' => $record->id]));
    }
}
