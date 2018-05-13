<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class ValidPhoneNumber implements Rule {

    public $error;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
      return $this->validate($value);
    }

    public function validate($number) {
      // Define classes that we need to use.
      $phoneUtil = PhoneNumberUtil::getInstance();

      try {
        // Define PhoneNumber instance.
        $phoneNumber = $phoneUtil->parse($number);
        // Check if phone number is valid.
        if (!$phoneUtil->isValidNumber($phoneNumber)) {
          $this->error = 'The phone number is not valid.';
          return FALSE;
        }
        else {
          return TRUE;
        }
      }
      catch (NumberParseException $e) {
        $this->error = $e->getMessage();
        return FALSE;
      }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
      if (isset($this->error)) {
        return $this->error;
      }
    }
}
