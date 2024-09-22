# Encryption Helper

This is the documentation for the Encryption Helper in NoteBud\SDF.

## Introduction

Encryption helps you to encrypt and decrypt data. You can use the encryption helper to encrypt and decrypt data in your
application.

NoteBud uses the AES-256-CBC encryption algorithm to encrypt most of the data, when it comes to passwords,
we prefer bcrypt. As you can see, these algorithms are proven to be secure by mathematical functions.

Also, we use salted version of sha256 method, developers may prefer to use this method for hashing the data.
But it's not recommended to use this method for passwords.

## Functions

### securePasswordHash

**Arguments**:

- password: string

**Returns**: string

This function is used to hash the password securely.
It uses the bcrypt algorithm to hash the password.

### verifyPasswordHash

> Requires openssl extension to be enabled.

**Arguments**:

- password: string
- hash: string

**Returns**: boolean

This function is used to verify the password hash.
It uses the bcrypt algorithm to verify the password hash.

### encryptData

**Arguments**:

- data: string
- encryptionKey: string

**Returns**: string

> Dependents on openssl random psuedo bytes function.

This function is used to encrypt the data.
It uses the AES-256-CBC algorithm to encrypt the data.

### decryptData

**Arguments**:

- encryptedData: string
- encryptionKey: string

**Returns**: string

This function is used to decrypt the data.
It uses the AES-256-CBC algorithm to decrypt the data.

### generateEncryptionKey

**Arguments**:

- length: int

**Returns**: string

This function is used to generate an encryption key.
It generates a random encryption key of the specified length.

### generateSaltedHash

**Arguments**:

- data: string
- salt: string

**Returns**: string

This function is used to generate a salted hash.
It uses the sha256 algorithm to generate the hash.

### verifySaltedHash

**Arguments**:

- data: string
- hash: string
- salt: string

**Returns**: boolean

This function is used to verify the salted hash.
It uses the sha256 algorithm to verify the hash.

## Conclusion

Encryption is an important aspect of security in any application.
With NoteBud, you can easily encrypt and decrypt data using the encryption helper.
