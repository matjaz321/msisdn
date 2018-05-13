<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;

class MsisdnController extends Controller {

  public function validateNumber(Request $request) {
    // Number field is required and also validate E.164 format.
    $this->validate($request, [
      'number' => 'required|regex:/^\+?\d{6,7}[2-9]\d{3}$/',
    ]);

    // Retrieve the validated input data...
    $number = $request->number;

    // Define classes that we need to use.
    $phoneUtil = PhoneNumberUtil::getInstance();
    $phoneNumberCarrier = PhoneNumberToCarrierMapper::getInstance();

    try {
      // Define PhoneNumber instance.
      $phoneNumber = $phoneUtil->parse($number);
      // Check if phone number is valid.
      if ($phoneUtil->isValidNumber($phoneNumber)) {
        // Get phone number parameters.
        $countryCode = $phoneUtil->getRegionCodeForNumber($phoneNumber);
        $carrier = $phoneNumberCarrier->getNameForNumber($phoneNumber, $countryCode);
        $countryDialingCode = $phoneNumber->getCountryCode();
        $subscriberNumber = $phoneNumber->getNationalNumber();

        // We will return this data to the view.
        $data = [
          'MNO' => $carrier,
          'country_dialing_code' => $countryDialingCode,
          'subscriber_number' => $subscriberNumber,
          'country_code' => $countryCode,
        ];
      }
    } catch (NumberParseException $e) {
      // Define errors.
    }
  }
}
