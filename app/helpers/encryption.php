<?php

/**
 * Hash a password securely using bcrypt.
 *
 * @param string $password
 * @return string The hashed password
 */
function securePasswordHash(string $password): string
{
    return password_hash($password, PASSWORD_BCRYPT);
}

/**
 * Verify a password against a bcrypt hash.
 *
 * @param string $password
 * @param string $hash
 * @return bool True if the password matches the hash, false otherwise
 */
function verifyPasswordHash(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * Encrypt a string using AES-256-CBC.
 *
 * @param string $data The data to encrypt
 * @param string $encryptionKey The encryption key
 * @return string The encrypted string, base64-encoded
 */
function encryptData(string $data, string $encryptionKey): string
{
    $cipherMethod = "AES-256-CBC";
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = openssl_random_pseudo_bytes($ivLength);

    // Encrypt the data
    $encryptedData = openssl_encrypt(
        $data,
        $cipherMethod,
        $encryptionKey,
        0,
        $iv
    );

    // Return the encrypted data and IV as a base64-encoded string
    return base64_encode($encryptedData . "::" . $iv);
}

/**
 * Decrypt an AES-256-CBC encrypted string.
 *
 * @param string $encryptedData The base64-encoded encrypted string
 * @param string $encryptionKey The encryption key
 * @return string The decrypted string
 */
function decryptData(string $encryptedData, string $encryptionKey): string
{
    $cipherMethod = "AES-256-CBC";

    // Split the encrypted data and IV
    list($encryptedData, $iv) = explode("::", base64_decode($encryptedData), 2);

    // Decrypt the data
    return openssl_decrypt(
        $encryptedData,
        $cipherMethod,
        $encryptionKey,
        0,
        $iv
    );
}

/**
 * Generate a random encryption key.
 *
 * @param int $length The length of the key (default is 32)
 * @return string The generated key
 */
function generateEncryptionKey(int $length = 32): string
{
    return bin2hex(random_bytes($length));
}

/**
 * Generate a salted hash using SHA-256.
 *
 * @param string $data The data to hash
 * @param string $salt The salt to use
 * @return string The salted hash (SHA-256)
 */
function generateSaltedHash(string $data, string $salt): string
{
    return hash("sha256", $salt . $data);
}

/**
 * Generate a random salt for hashing.
 *
 * @param int $length The length of the salt (default is 16)
 * @return string The generated salt
 */
function generateSalt(int $length = 16): string
{
    return bin2hex(random_bytes($length));
}

/**
 * Verify a salted hash against the original data.
 *
 * @param string $data The original data
 * @param string $salt The salt used during hashing
 * @param string $hash The salted hash to verify against
 * @return bool True if the salted hash matches, false otherwise
 */
function verifySaltedHash(string $data, string $salt, string $hash): bool
{
    return hash("sha256", $salt . $data) === $hash;
}
