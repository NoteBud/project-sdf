# Flash Library

The Flash library provides functionality for creating and managing flash messages in the SDF framework.

## Namespace

`SDF\Library`

## Classes

### Flash

#### Properties

- `protected static array $flash`: Temporary storage for flash messages.
- `public static array $allowedTypes`: Allowed types of flash messages ("info", "success", "warning", "error").

#### Methods

- `__construct()`: Initializes the session and creates a flash key if it doesn't exist.
- `static load(Message $message): void`: Adds a new flash message to the storage.
- `static dispose(string $type = ""): array`: Retrieves and removes flash messages. If a type is specified, only messages of that type are returned.
- `protected static save(): void`: Saves flash messages to the session.

### Message

#### Properties

- `public string $message`: The content of the flash message.
- `public string $type`: The type of the flash message (default: "info").
- `public string $icon`: An optional icon for the message.
- `public string $title`: An optional title for the message.
- `public string $subtitle`: An optional subtitle for the message.
- `public string $link`: An optional link associated with the message.
- `public string $linkText`: The text for the optional link.
- `public bool $persistent`: Whether the message should persist after being displayed (default: false).
- `public int $dismissTimeout`: The timeout in milliseconds before the message is automatically dismissed (default: 5000).

#### Methods

- `__construct(...)`: Creates a new Message instance with the specified properties.

## Usage Example

```php
use SDF\Library\Flash;
use SDF\Library\Flash\Message;

// Create a new flash message
$message = new Message("Operation successful!", "success", "", "Success", "Your changes have been saved.");
Flash::load($message);

// Retrieve and display flash messages
$messages = Flash::dispose();
foreach ($messages as $msg) {
    echo $msg->message;
}
```

This library provides a flexible way to create and manage flash messages for user feedback in your application.
