<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MsisdnController extends Controller {

  public function validateNumber(Request $request) {
    $this->validate($request, [
      'number' => 'required|regex:/^\+?\d{6,7}[2-9]\d{3}$/',
    ]);

  }
}
