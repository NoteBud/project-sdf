# Logger Library

The Logger library provides functionality for logging messages with different severity levels in the SDF framework.

## Namespace
`SDF\Library`

## Classes

### Logger

#### Properties

- `protected static array $logs`: Storage for log messages.
- `protected static array $allowedTypes`: Allowed types of log messages (0: "info", 1: "notice", 2: "warning", 3: "error").

#### Methods

- `__construct()`: Initializes the Logger (currently empty).
- `static set(Log $message): void`: Adds a new log message to the storage.
- `static get(int $timestamp = -1, int $type = -1): array`: Retrieves log messages, optionally filtered by timestamp and/or type.
- `static clear(): void`: Clears all stored log messages.
- `protected static format(string $message, string $type): string`: Formats a log message (internal use).
- `protected static log(Log $message, int $type): void`: Internal method to add a log message.
- `static info(string $message): void`: Logs an info message.
- `static notice(string $message): void`: Logs a notice message.
- `static warning(string $message): void`: Logs a warning message.
- `static error(string $message): void`: Logs an error message.
- `static debug(string $message): void`: Logs a debug message (stored as info).
- `static critical(string $message): void`: Logs a critical message (stored as error).

### Log

#### Properties

- `public string $message`: The content of the log message.
- `public string $type`: The type of the log message.
- `public int $time`: The timestamp of when the log was created.

#### Methods

- `__construct(string $message, string $type, int $time)`: Creates a new Log instance.
- `__toString()`: Returns a formatted string representation of the log message.

## Usage Example

```php
use SDF\Library\Logger;

// Log different types of messages
Logger::info("Application started");
Logger::warning("Low disk space");
Logger::error("Database connection failed");

// Retrieve all log messages
$allLogs = Logger::get();

// Retrieve only error messages
$errorLogs = Logger::get(type: 3);

// Clear all logs
Logger::clear();
```

This library provides a simple way to log messages with different severity levels and retrieve them as needed for debugging or monitoring purposes.
