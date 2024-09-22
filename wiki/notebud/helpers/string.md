# String Helper

This is the documentation for the String Helper in NoteBud\SDF.

## Introduction

String helper is a collection of functions that are used to manipulate strings in the application.
It provides functions to manuplate strings, checkers and validators.

## Functions

### toCamelCase

**Arguments**:

- string: string

**Returns**: string

This function is used to convert a string to camel case.
For example, `hello_world` will be converted to `helloWorld`.

### toSnakeCase

**Arguments**:

- string: string

**Returns**: string

This function is used to convert a string to snake case.
For example, `helloWorld` will be converted to `hello_world`.

### truncateString

**Arguments**:

- string: string
- limit: number
- ellipsis: string

**Returns**: string

This function is used to truncate a string to a specified length.
If the string is longer than the specified length, it will be truncated and an ellipsis will be added at the end.
For example, `truncateString('hello world', 5, '...')` will return `hello...`.

### removeNonAlphaNumeric

**Arguments**:

- string: string

**Returns**: string

This function is used to remove all non-alphanumeric characters from a string.
For example, `removeNonAlphaNumeric('hello world!')` will return `helloworld`.

### reverseString

**Arguments**:

- string: string

**Returns**: string

This function is used to reverse a string.
For example, `reverseString('hello world')` will return `dlrow olleh`.

### createSlug

**Arguments**:

- string: string

**Returns**: string

This function is used to create a slug from a string.
For example, `createSlug('Hello World')` will return `hello-world`.

### removeStopWords

**Arguments**:

- string: string
- stopWords: string[]

**Returns**: string

This function is used to remove stop words from a string.
Stop words are common words that are filtered out before or after processing of natural language data.
For example, `removeStopWords('hello world', ['hello'])` will return `world`.

### seoTitleLimit

**Arguments**:

- title: string
- maxLength: number

**Returns**: string

This function is used to limit the length of a title for SEO purposes.

### sanitizeForOutput

**Arguments**:

- string: string

**Returns**: string

This function is used to sanitize a string for output.
It removes any HTML tags and entities from the string.

### sanitizeForSQL

**Arguments**:

- string: string
- connection: mixed
- mode: int

**Returns**: string

This function is used to sanitize a string for SQL queries.
It escapes special characters in the string to prevent SQL injection attacks.

Has support for multiple drivers and modes, for example, `sanitizeForSQL('hello world', $connection, 1)`.
The mode can be `0` for string, `1` for PDO, `2` for Mysqli.

### generateSecureToken

**Arguments**:

- length: int

**Returns**: string

This function is used to generate a secure token of a specified length using random bytes.
It is useful for generating secure tokens for authentication and other purposes.
It is not recommended to use, prefer encryption methods to generate tokens.

### isValidEmail

**Arguments**:

- email: string

**Returns**: boolean

This function is used to check if an email address is valid.
It checks if the email address has a valid format.

### getUserIP

**Arguments**:

- none

**Returns**: string

This function is used to get the IP address of the user.

### isValidIPv4

**Arguments**:

- ip: string

**Returns**: boolean

This function is used to check if an IPv4 address is valid.
It checks if the IPv4 address has a valid format.

### isValidIPv6

**Arguments**:

- ip: string

**Returns**: boolean

This function is used to check if an IPv6 address is valid.
It checks if the IPv6 address has a valid format.

### isPrivateIP

**Arguments**:

- ip: string

**Returns**: boolean

This function is used to check if an IP address is a private IP address.
Private IP addresses are reserved for use in private networks and are not routable on the public internet.

### getIPVersion

**Arguments**:

- ip: string

**Returns**: number

This function is used to get the version of an IP address.

## Conclusion

String helper provides a collection of functions to manipulate strings in the application.
