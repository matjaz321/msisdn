<?php

namespace App;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;

/**
 * Class Msisdn
 *
 * @package \App
 */
class Msisdn {

  protected $number;

  function __construct($number) {
    $this->number = $number;
  }

  /**
   * Function will create new record.
   * @return \App\Records
   * @throws \libphonenumber\NumberParseException
   */
  public function createNewRecord() {
    try {
      // Define classes that we need to use.
      $phoneUtil = PhoneNumberUtil::getInstance();
      $phoneNumberCarrier = PhoneNumberToCarrierMapper::getInstance();
      // Define PhoneNumber instance.
      $phoneNumber = $phoneUtil->parse($this->number);
      // Check if phone number is valid.
      if ($phoneUtil->isValidNumber($phoneNumber)) {
        // Get phone number parameters.
        $countryCode = $phoneUtil->getRegionCodeForNumber($phoneNumber);
        $carrier = $phoneNumberCarrier->getNameForNumber($phoneNumber, $countryCode);
        $countryDialingCode = $phoneNumber->getCountryCode();
        $subscriberNumber = $phoneNumber->getNationalNumber();

        // We will return this data to the view.
        $data = [
          'mno' => $carrier,
          'country_dialing_code' => $countryDialingCode,
          'subscriber_number' => $subscriberNumber,
          'country_code' => $countryCode,
        ];

        // Save new record into database.
        $record = Records::create([
          'phone_number' => $this->number,
          'data' => json_encode($data),
        ]);

        return $record;
      }
    } catch (NumberParseException $e) {
      throw new NumberParseException($e, $e->getMessage());
    }
  }
}
