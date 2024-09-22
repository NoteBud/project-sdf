<?php

if (!defined("SDF")) {
    die('Security warning. You can\'t view this page.');
}

// Variables
// This section is for the variable functions.
// These functions are used to manipulate variables.

function is_empty(mixed $var): bool
{
    return empty($var);
}

function is_url(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function is_ip(string $ip): bool
{
    return filter_var($ip, FILTER_VALIDATE_IP) !== false;
}

// File i/o
// This section is for the file i/o functions.
// These functions are used to read and write files.

function read_file(string $file): string
{
    return file_get_contents($file);
}

function write_file(string $file, string $data): bool
{
    return file_put_contents($file, $data) !== false;
}

function append_file(string $file, string $data): bool
{
    return file_put_contents($file, $data, FILE_APPEND) !== false;
}

function delete_file(string $file): bool
{
    return unlink($file);
}

// checkpoint: add better logic for file upload
function upload_file(string $file, string $destination): bool
{
    return move_uploaded_file($file, $destination);
}

// checkpoint: add better logic for file download
function download_file(string $file): bool
{
    return readfile($file) !== false;
}

function create_directory(string $directory): bool
{
    return mkdir($directory);
}

function delete_directory(string $directory): bool
{
    return rmdir($directory);
}

function list_directory(string $directory): array
{
    return scandir($directory);
}

function directory_exists(string $directory): bool
{
    return is_dir($directory);
}

// Loaders
// Loaders act like the Core\Loader, but they are not part of the core.
// They allow the helpers to use the same functionality as the core loader.
// core is not exposed to the helpers due to reasons.
// With these functions, we expose more controlled functionality to the helpers.

if (!class_exists("SDF\\Loader")) {
    unsafe_load_core();
}

if (!defined("LOADER")) {
    define("LOADER", new SDF\Loader());
}

function unsafe_load_core()
{
    require_once SDF_DIR . "core/Loader.php";
}

function load_view(
    string $name,
    array|object $data = [],
    string $directory = SDF_APP_VIEW
) {
    return LOADER->view($name, $data, $directory);
}

function load_library(
    string $name,
    array|object $params = [],
    string $directory = SDF_APP_LIB
) {
    return LOADER->library($name, $params, $directory);
}

function load_model(string $name, string $directory = SDF_APP_MODL)
{
    return LOADER->model($name, $directory);
}

function load_helper(string $name, string $directory = SDF_APP_HELP)
{
    return LOADER->helper($name, $directory);
}

function load_file(string $file, string $directory = SDF_DIR): mixed
{
    return LOADER->file($file, $directory);
}

function load_config(string $file, string $directory = SDF_APP_CONF): array
{
    return LOADER->config($file, $directory);
}
