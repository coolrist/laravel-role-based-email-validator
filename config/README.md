# Technical Documentation: `config` Directory

This directory centralizes essential PHP configuration files that ensure the proper functioning of the application. It allows key behavior and parameter adjustments without altering the main source code.

---

## `config/role_based.php`

This configuration file is dedicated to **managing role-based email addresses** (e.g., `admin@domain.com`, `support@domain.com`). Its main purpose is to control email validation during registration or form submissions, aiming to prevent the use of generic addresses often tied to shared inboxes or company roles rather than individual users.

* **`"only_custom"`**:

  * **Description**: A boolean (`true` or `false`) that defines the email validation logic.
  * If **`true`**: Validation will rely **only** on the custom list defined in this file (`"list"`). Emails not explicitly listed here won’t be blocked.
  * If **`false`** (recommended): Validation will consider **both the built-in default list and the custom list**. This is the advised setting since the internal list already includes a large number of common role-based addresses (like "admin", "support", "noreply", etc.), providing broader coverage.
  * **Recommendation**: Keep this value set to `false` to benefit from the already robust internal list.

* **`"list"`**:

  * **Description**: An array that defines a **custom list of role-based email prefixes** the application should reject during validation.
  * **Usage**: Add any additional email prefixes (the part before the `@`) that represent roles specific to your organization or that aren’t covered by the default internal list.
  * **Commented Examples**: The examples `// "admin", // "support", // "noreply"` are commented out, indicating they are already handled by the default internal list and don't need to be added here unless specific behavior is required for them.

* **Global Impact**:
  This file plays a key role in maintaining high-quality user data by filtering out email addresses not associated with individual users. It helps reduce spam, improve the relevance of communication, and ensure users provide personal email addresses during registration.

---
