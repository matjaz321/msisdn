<?php

namespace App\Http\Controllers;

use App\Records;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(['data' => Records::all()], 200);
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
    public function show($record) {
      $record = Records::find($record);
      if ($record) {
        return response()->json(['data' => $record->data], 200);
      }
      else {
        return response()->json(['message' => 'Record not found'], 400);
      }
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
      $number = $request->number;
      $validPhoneNumber = new ValidPhoneNumber();
      $isValid = $validPhoneNumber->validate($number);
      if ($isValid) {
        $controller= new MsisdnController();
        $record = $controller->createNewRecord($number);
        return response()->json(['data' => $record], 200);
      }
      else {
        return response()->json(['message' => $isValid->error], 400);
      }
    }
}
