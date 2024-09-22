<?php

// String Manipulation Functions

/**
 * Convert a string to camelCase.
 *
 * @param string $string
 * @return string
 */
function toCamelCase(string $string): string
{
    return lcfirst(
        str_replace(" ", "", ucwords(str_replace("_", " ", $string)))
    );
}

/**
 * Convert a string to snake_case.
 *
 * @param string $string
 * @return string
 */
function toSnakeCase(string $string): string
{
    return strtolower(preg_replace("/[A-Z]/", '_$0', lcfirst($string)));
}

/**
 * Truncate a string to a specified length, adding an ellipsis if necessary.
 *
 * @param string $string
 * @param int $limit
 * @param string $ellipsis
 * @return string
 */
function truncateString(
    string $string,
    int $limit = 100,
    string $ellipsis = "..."
): string {
    if (strlen($string) > $limit) {
        return substr($string, 0, $limit) . $ellipsis;
    }
    return $string;
}

/**
 * Remove all non-alphanumeric characters from a string.
 *
 * @param string $string
 * @return string
 */
function removeNonAlphaNumeric(string $string): string
{
    return preg_replace("/[^a-zA-Z0-9]/", "", $string);
}

/**
 * Reverse a string.
 *
 * @param string $string
 * @return string
 */
function reverseString(string $string): string
{
    return strrev($string);
}

// Seo Functions

/**
 * Convert a string to an SEO-friendly slug.
 *
 * @param string $string
 * @return string
 */
function createSlug(string $string): string
{
    // Convert to lowercase
    $string = strtolower($string);
    // Remove any HTML tags
    $string = strip_tags($string);
    // Replace spaces and underscores with hyphens
    $string = preg_replace("/[\s_]+/", "-", $string);
    // Remove non-alphanumeric characters
    $string = preg_replace("/[^a-z0-9\-]/", "", $string);
    // Remove duplicate hyphens
    $string = preg_replace("/-+/", "-", $string);
    // Trim hyphens from the ends
    return trim($string, "-");
}

/**
 * Remove stop words from a string for SEO optimization.
 *
 * @param string $string
 * @param array $stopWords
 * @return string
 */
function removeStopWords(string $string, array $stopWords = []): string
{
    if (empty($stopWords)) {
        $stopWords = ["the", "and", "of", "in", "a", "to", "for", "with"]; // Example stop words
    }
    $words = explode(" ", $string);
    $filteredWords = array_filter($words, function ($word) use ($stopWords) {
        return !in_array(strtolower($word), $stopWords);
    });
    return implode(" ", $filteredWords);
}

/**
 * Limit the length of an SEO title.
 *
 * @param string $title
 * @param int $maxLength
 * @return string
 */
function seoTitleLimit(string $title, int $maxLength = 60): string
{
    return truncateString($title, $maxLength, "");
}

// Security Functions

/**
 * Sanitize a string for output to prevent XSS.
 *
 * @param string $string
 * @return string
 */
function sanitizeForOutput(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
}

/**
 * Sanitize input for SQL queries to prevent SQL Injection.
 *
 * @param string $string
 * @param mixed $connection
 * @param int $mode
 * @return string
 */
function sanitizeForSQL(
    string $string,
    mixed $connection = [],
    int $mode = 0
): string {
    if ($mode === 0) {
        return addslashes($string);
    } elseif ($mode === 1) {
        return $connection->quote($string);
    } elseif ($mode === 2) {
        return $connection->real_escape_string($string);
    }
}

/**
 * Generate a random secure token (e.g., for CSRF protection).
 *
 * @param int $length
 * @return string
 */
function generateSecureToken(int $length = 32): string
{
    return bin2hex(random_bytes($length / 2));
}

/**
 * Validate if a given string is a valid email address.
 *
 * @param string $email
 * @return bool
 */
function isValidEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Get the user's IP address (supports both IPv4 and IPv6).
 *
 * @return string|null
 */
function getUserIP(): ?string
{
    $ipKeys = [
        "HTTP_CLIENT_IP",
        "HTTP_X_FORWARDED_FOR",
        "HTTP_X_FORWARDED",
        "HTTP_X_CLUSTER_CLIENT_IP",
        "HTTP_FORWARDED_FOR",
        "HTTP_FORWARDED",
        "REMOTE_ADDR",
    ];

    foreach ($ipKeys as $key) {
        if (
            !empty($_SERVER[$key]) &&
            filter_var($_SERVER[$key], FILTER_VALIDATE_IP)
        ) {
            return $_SERVER[$key];
        }
    }
    return null; // Return null if no valid IP is found
}

/**
 * Validate if a string is a valid IPv4 address.
 *
 * @param string $ip
 * @return bool
 */
function isValidIPv4(string $ip): bool
{
    return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
}

/**
 * Validate if a string is a valid IPv6 address.
 *
 * @param string $ip
 * @return bool
 */
function isValidIPv6(string $ip): bool
{
    return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
}

/**
 * Check if the IP address is from a private range (IPv4 only).
 *
 * @param string $ip
 * @return bool
 */
function isPrivateIP(string $ip): bool
{
    if (!isValidIPv4($ip)) {
        return false;
    }

    $privateRanges = [
        "10.0.0.0|10.255.255.255", // 10.0.0.0 – 10.255.255.255
        "172.16.0.0|172.31.255.255", // 172.16.0.0 – 172.31.255.255
        "192.168.0.0|192.168.255.255", // 192.168.0.0 – 192.168.255.255
    ];

    $ipLong = ip2long($ip);

    foreach ($privateRanges as $range) {
        [$start, $end] = explode("|", $range);
        if ($ipLong >= ip2long($start) && $ipLong <= ip2long($end)) {
            return true;
        }
    }

    return false;
}

/**
 * Get the user's IP address version (IPv4 or IPv6).
 *
 * @param string $ip
 * @return string|null
 */
function getIPVersion(string $ip): ?string
{
    if (isValidIPv4($ip)) {
        return "IPv4";
    } elseif (isValidIPv6($ip)) {
        return "IPv6";
    }
    return null;
}
