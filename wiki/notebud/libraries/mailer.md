# Mailer Library

The Mailer library provides functionality for sending emails with attachments in the SDF framework.

## Namespace
`SDF\Library`

## Class: Mailer

### Properties

- `private string $to`: The recipient's email address.
- `private string $subject`: The subject of the email.
- `private string $htmlMessage`: The HTML content of the email.
- `private string $plainMessage`: The plain text content of the email.
- `private string $from`: The sender's email address.
- `private array $headers`: Additional email headers.
- `private array $attachments`: File paths of attachments to be included in the email.

### Methods

- `__construct(string $to, string $subject, string $htmlMessage, string $plainMessage = "", string $from = "")`: Creates a new Mailer instance.
- `addHeader(string $header): void`: Adds a custom header to the email.
- `setFrom(string $from): void`: Sets the "From" address for the email.
- `addAttachment(string $filePath): void`: Adds a file attachment to the email.
- `private isValidEmail(string $email): bool`: Validates an email address.
- `send(): string`: Sends the email and returns a status message.

## Usage Example

```php
use SDF\Library\Mailer;

$mailer = new Mailer(
    "recipient@example.com",
    "Test Email",
    "<h1>Hello, World!</h1><p>This is a test email.</p>",
    "Hello, World! This is a test email.",
    "sender@example.com"
);

$mailer->addAttachment("/path/to/attachment.pdf");
$result = $mailer->send();

echo $result; // "Email sent successfully to recipient@example.com" or error message
```

## Features

- Supports both HTML and plain text email content.
- Allows adding custom headers.
- Supports file attachments.
- Validates email addresses.
- Uses PHP's built-in `mail()` function for sending emails.
- Integrates with the Logger library for logging email sending results.

## Notes

- Ensure that your PHP environment is properly configured to send emails.
- The library uses `mime_content_type()` function, which might require additional PHP extensions.
- Large attachments may impact email delivery performance.

This Mailer library provides a convenient way to send emails with attachments from your SDF-based application.
