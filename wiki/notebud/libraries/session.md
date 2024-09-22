# Session Library

The Session library provides functionality for managing PHP sessions in the SDF framework.

## Namespace

`SDF\Library`

## Class: Session

### Properties

- `protected static array $session`: Stores the current session data.
- `protected static array $temp`: Temporary storage for session modifications.

### Methods

- `__construct()`: Initializes the session.
- `static init(): void`: Initializes or resumes the PHP session.
- `static set(string $key, $value): void`: Sets a session value.
- `static get(string $key)`: Retrieves a session value.
- `static remove(string $key): void`: Removes a session value.
- `static has(string $key): bool`: Checks if a session key exists.
- `static save(): void`: Saves the temporary session data to the actual session.
- `static destroy(): void`: Destroys the current session.
- `static reinstiate(): void`: Regenerates the session (destroys and reinitializes).
- `__destruct()`: Automatically saves session changes when the object is destroyed.

## Usage Example

```php
use SDF\Library\Session;

// Initialize the session
Session::init();

// Set a session value
Session::set('user_id', 123);

// Get a session value
$userId = Session::get('user_id');

// Check if a session key exists
if (Session::has('user_id')) {
    echo "User is logged in";
}

// Remove a session value
Session::remove('user_id');

// Destroy the session
Session::destroy();
```

## Features

- Provides a simple interface for managing PHP sessions.
- Uses a temporary array for modifications, allowing for bulk updates.
- Automatically saves changes when the Session object is destroyed.
- Supports session regeneration for security purposes.

## Notes

- This library assumes that PHP's session functions are available and properly configured in your environment.
- The `session_start()`, `session_status()`, and `session_destroy()` functions are used internally, which may require appropriate PHP settings.

This Session library offers a convenient way to manage session data in your SDF-based application, providing an abstraction layer over PHP's native session functions.
