<?php

/**
 * product Configuration
 * Load this file using load_config('product');
 * @var array $config;
 */
if (!defined("SDF")) {
    die('Security warning. You can\'t view this page.');
}
$config["product"] = [
    "database" => [
        "host" => "localhost",
        "database" => "notebud_dev",
        "username" => "root",
        "password" => "",
    ],
];
