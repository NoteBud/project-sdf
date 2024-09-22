<?php

use SDF\Sorm;

/**
 * Providers are used to provide a specific service to the application.
 * These services can be anything from database connections to API clients.
 * We use arrow functions to provide the service, so that we can delay the
 * instantiation of the service until it is actually needed.
 * Thus, we can avoid unnecessary instantiation of services.
 *
 * Providers are defined as an associative array with the key being the name of the provider.
 * The value is an associative array with two keys:
 * 1. provider: An arrow function that returns the service.
 * 2. version: The version of the service.
 * This can be changed in the future to include more information about the service.
 * But for now, this is enough.
 * Sample provider;
 ```php
    "name" => [
        "provider" => fn() => new stdClass(),
        "version" => "v1.5",
    ],
 ```
*/
$providers = [
    "sorm" => [
        "provider" => fn($table) => (new Sorm())->connect(
            ($c = load_config("product", "database")["provider"])["host"],
            $c["database"],
            $c["username"],
            $c["password"],
            $table
        ),
        "version" => "v1.0",
    ],
];

// ---- Do not touch below this line ---- //

// Define the PROVIDERS constant, this constant will be available throughout the application when the provider helper is loaded.
define("PROVIDERS", $providers);

function provide(string $provider, ...$args)
{
    if (array_key_exists($provider, PROVIDERS)) {
        return call_user_func_array(PROVIDERS[$provider]["provider"], $args);
    } else {
        throw new Exception("Provider $provider not found");
    }
}

// Fallback functions

if (!function_exists("load_config")) {
    function load_config(string $file, string $directory = SDF_APP_CONF): array
    {
        $filePath =
            SDF_APP .
            DIRECTORY_SEPARATOR .
            $directory .
            DIRECTORY_SEPARATOR .
            $file;

        if (file_exists($filePath)) {
            require_once $filePath;
            // @var array $config
            return $config ?? false;
        }

        return false;
    }
}
