# Documentation: `Coolrist/RoleBasedEmailValidator` Package

The `Coolrist/RoleBasedEmailValidator` package is a **Laravel extension** that adds a **custom validation rule** to block role-based email addresses like `admin@`, `info@`, `support@`, etc. It ensures users register with **personal email addresses**, improving the reliability of your user data and the effectiveness of your communication.

---

## 1. Why Use This Package?

In many applications, it's important to make sure each user is uniquely identifiable. This package helps you:

* ✅ **Improve user data quality** – no more generic emails in your database.
* 🚫 **Reduce spam and abuse** – role-based addresses are commonly used for testing or fraudulent signups.
* 📬 **Enable targeted communication** – you’re messaging a real person, not a shared inbox.

---

## 2. Installation

Install it via Composer:

```bash
composer require coolrist/role-based-email-validator
```

Then, **publish the configuration file** (optional but recommended):

```bash
php artisan vendor:publish --tag=coolrist-role-based-config
```

This creates a `config/role_based.php` file where you can tweak settings to fit your use case.

---

## 3. Configuration

Here’s what the config file looks like:

```php
return [
    'only_custom' => false, // Leave false to use the built-in list + your custom list
    'list' => [
        // Add your own role-based email prefixes here
        'compta',
        'direction',
        // Common ones like 'admin', 'support' are already covered internally
    ],
];
```

* `only_custom => false`: combines the **internal list** (included in the package) with your custom list. Best for full protection.
* `only_custom => true`: disables the internal list and uses **only** your custom entries.

The internal list already includes common role-based prefixes like `admin`, `support`, `info`, `sales`, and more.

---

## 4. Usage

Once installed and configured, you can use the `not_role_based` rule in your Laravel validators:

```php
Validator::make($request->all(), [
    'email' => 'required|email|not_role_based|unique:users,email', // <-- Add the rule here
]);
```

If a user tries to register with something like `admin@example.com`, validation will fail and return:
**"The email address is role-based."**

💡 *This message is customizable in your Laravel language files.*

---

## 5. Bonus: Rock-Solid Email Validation 🛡️

For even stronger email checks, combine this package with [`Propaganistas/Laravel-Disposable-Email`](https://github.com/Propaganistas/Laravel-Disposable-Email), which blocks temporary email addresses.

Install it:

```bash
composer require propaganistas/laravel-disposable-email
```

Then chain the rules like so:

```php
'email' => 'required|email:strict,dns,spoof|indisposable|not_role_based',
```

💥 With this combo, you ensure the email is technically valid, not disposable, **and** not role-based. Only solid, permanent, personal emails get through.

---

## 6. Want to Help Us Push This Like a TUF Laptop with an RTX? 🚀🎮

If you want to support the project — with some code, some cash, or just good vibes — reach out! The maintainer's email is in the `composer.json` file, like a hidden bonus in a well-coded level. 💌

We love stylish commits, fresh ideas, and even dream-desk setup gifs (especially with RGB lighting). Thanks for being here — whether you're a dev, supporter, or just a curious visitor stopping by with good energy. 💻🔥

---

