<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class ValidPhoneNumber implements Rule
{

    private $error;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      // Define classes that we need to use.
      $phoneUtil = PhoneNumberUtil::getInstance();

      try {
        // Define PhoneNumber instance.
        $phoneNumber = $phoneUtil->parse($value);
        // Check if phone number is valid.
        if (!$phoneUtil->isValidNumber($phoneNumber)) {
          $this->error = 'The phone number is not valid.';
        }
        else {
          return TRUE;
        }
      }
      catch (NumberParseException $e) {
        $this->error = $e->getMessage();
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
