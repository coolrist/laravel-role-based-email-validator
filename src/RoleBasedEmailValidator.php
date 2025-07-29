<?php

namespace Coolrist\RoleBasedEmailValidator;

use Illuminate\Support\Facades\Validator;

/**
 * RoleBasedEmailValidator class.
 * This class provides a method to validate email addresses against a list of role-based emails.
 */
class RoleBasedEmailValidator {

    /**
     * Validates an email address to ensure it is not role-based.
     *
     * The 'not_role_based' rule checks whether the email prefix (before the @) appears in the list of known role-based addresses.
     * This helps ensure users provide personal, non-functional email addresses.
     *
     * @return void
     */
    public static function validate() {
        Validator::extend('not_role_based', function ($attribute, $value, $parameters, $validator) {
            $localPart = explode('@', $value)[0];

            return !in_array(strtolower($localPart), RoleBasedList::all());
        }, 'This email address is role-based.');
    }

}
