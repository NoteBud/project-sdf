<?php

namespace SDF\Library;

/**
 * Copyright 2024 Devsimsek & The NoteBud Backend Team
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * @package     SDF\Library\Session
 * @file        Session.php
 * @version     v1.0.0
 * @since       v1.0
 * @author      devsimsek, The NoteBud Backend Team
 * @url         https://github.com/NoteBud/project-sdf/
 * @filesource
 */
class Session
{
    // The session array
    // This array will be used to store and process session data
    // @var array
    protected static array $session = [];

    // The temporary session array
    // This array will be used to store and process temporary session data
    // @var array
    protected static array $temp = [];

    public function __construct()
    {
        self::init();
    }

    // Initialize the session
    // This function will be used to initialize the session
    // @return void
    public static function init(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        self::$session = $_SESSION;
        self::$temp = self::$session;
    }

    // Set a session value
    // This function will be used to set a session value
    // @param string $key The session key
    // @param mixed $value The session value
    // @return void
    public static function set(string $key, $value): void
    {
        self::$temp[$key] = $value;
    }

    // Get a session value
    // This function will be used to get a session value
    // @param string $key The session key
    // @return mixed
    public static function get(string $key)
    {
        return self::$temp[$key] ?? null;
    }

    // Remove a session value
    // This function will be used to remove a session value
    // @param string $key The session key
    // @return void
    public static function remove(string $key): void
    {
        unset(self::$temp[$key]);
    }

    // Check existence of a session value
    // This function will be used to check the existence of a session value
    // @param string $key The session key
    // @return bool
    public static function has(string $key): bool
    {
        if (!empty(self::$temp[$key]) || !isset(self::$temp[$key])) {
            return false
        }
        return true;
    }

    // Save the session
    // This function will be used to save the session
    // @return void
    public static function save(): void
    {
        $_SESSION = self::$temp;
    }

    // Destroy the session
    // This function will be used to destroy the session
    // @return void
    public static function destroy(): void
    {
        session_destroy();
    }

    // Regenerate the session
    // This function will be used to regenerate the session
    // @return void
    public static function reinstiate(): void
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            self::destroy();
            self::init();
        }
    }

    // Destructor
    // This function will be used to update the session
    // @return void
    public function __destruct()
    {
        // If the session is not equal to the temp variable, update the session
        if (self::$session !== self::$temp) {
            self::save();
        }
    }
}
