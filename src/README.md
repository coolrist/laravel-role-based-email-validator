# Technical Documentation: `src` Directory of `Coolrist\RoleBasedEmailValidator`

This directory contains the core logic of the `Coolrist\RoleBasedEmailValidator` package, a tool designed to **validate email addresses** by preventing the use of role-based emails (like `admin@`, `support@`). It integrates with the Laravel framework or any project using the `Illuminate\Validator` component.

---

## `src/AppServiceProvider.php`

This file serves as the **main service provider** for the package. It handles the registration and initialization of services and configuration when the package is loaded by a Laravel application.

* **`boot()` Method**:

  * Runs after all other service providers are registered. Used for bootstrapping tasks.
  * **Publishing Configuration File**:

    * `$this->publishes(...)`: Publishes the package’s default config file (`config/role_based.php`) into the user’s Laravel `config` directory. After installation, users can run an Artisan command to publish this file and customize the validator’s behavior. The tag `'coolrist-role-based-config'` makes targeted publishing easier.
  * **Registering Validation Rule**:

    * `RoleBasedEmailValidator::validate();`: Calls the static `validate()` method of `RoleBasedEmailValidator`, which registers a **custom validation rule** named `'not_role_based'`. This rule can then be used in form validation like `['email' => 'required|email|not_role_based']`.

* **`register()` Method**:

  * Used to bind elements to Laravel’s service container and typically merge default configuration.
  * **Merging Configuration**:

    * `$this->mergeConfigFrom(...)`: Merges the package’s default config (`config/role_based.php`) with the application’s config. Users only need to override specific settings without duplicating the whole config file. Any missing values fall back to the package defaults.

---

## `src/RoleBasedEmailValidator.php`

This class holds the core validation logic for detecting role-based email addresses. It defines the custom Laravel validation rule.

* **`validate()` Static Method**:

  * Called by `AppServiceProvider` during package bootstrapping.
  * **Registers the `not_role_based` Rule**:

    * `Validator::extend('not_role_based', function (...) { ... }, 'This email address is role-based.');`: Defines the validation rule.
    * **Validation Logic**:

      1. `$localPart = explode('@', $value)[0];`: Extracts the part before the `@` from the email.
      2. `return !in_array(strtolower($localPart), RoleBasedList::all());`: Converts the local part to lowercase and checks whether it exists in the combined role-based email list (internal + custom). If it does, validation fails.
    * **Error Message**: `'This email address is role-based.'` is returned on failure.

* **Usefulness**:
  Helps Laravel developers enforce the use of personal, non-generic email addresses during registration or data collection.

---

## `src/RoleBasedList.php`

This class manages and provides access to the list of role-based email prefixes, combining an internal list with an optional user-defined custom list.

* **`$internalList` Static Property**:

  * A private static property containing an **extensive built-in list** of role-based email prefixes. This includes common function-related terms (e.g., marketing, notifications, meetings, support).

* **`all()` Static Method**:

  * Public method to retrieve the full list of role-based prefixes.
  * Reads the `role_based.only_custom` setting from the config (defaults to `false`), deciding whether to use only the custom list or to merge it with the internal list.
  * Calls `sanitizeCustomList()` to clean and validate the custom list.
  * Merges and normalizes the final list using `strtolower()` and `array_unique()`.

* **`internal()` Static Method**:

  * Returns the **internal list** of role-based prefixes.
  * Uses `array_merge(...array_values(self::$internalList))` to flatten the list into a single array.

* **`sanitizeCustomList()` Private Static Method**:

  * A helper that ensures the custom list from the config is a valid array and contains only scalar or stringable values. Helps avoid misconfiguration issues.

* **Usefulness**:
  Essential for keeping the role-based list current and flexible, allowing developers to extend or override entries based on their specific needs.

---
