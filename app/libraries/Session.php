<?php

namespace SDF\Library;

use InvalidArgumentException;

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
    protected static int $SESSION_AGE = 1800;
    protected static array $temp = [];

    /**
     * Starts or resumes a session.
     *
     * @return boolean Returns true upon success and false upon failure.
     */
    public static function start(): bool
    {
        self::_init();
        return true;
    }

    /**
     * Writes a value to the current session data.
     *
     * @param string $key String identifier.
     * @param mixed $value Single value or array of values to be written.
     * @return mixed Value or array of values written.
     * @throws InvalidArgumentException Session key is not a string value.
     */
    public static function w(string $key, mixed $value): mixed
    {
        self::_init();
        self::$temp[$key] = $value;
        self::_age();
        return $value;
    }

    /**
     * Reads a specific value from the current session data.
     *
     * @param string $key String identifier.
     * @return mixed Returns a string value upon success. Returns false upon failure.
     * @throws InvalidArgumentException Session key is not a string value.
     */
    public static function r(string $key): mixed
    {
        self::_init();
        if (isset(self::$temp[$key])) {
            self::_age();
            return self::$temp[$key];
        }
        return false;
    }

    /**
     * Deletes a value from the current session data.
     *
     * @param string $key String identifying the array key to delete.
     * @return void
     * @throws InvalidArgumentException Session key is not a string value.
     */
    public static function d(string $key): void
    {
        self::_init();
        unset(self::$temp[$key]);
        self::_age();
    }

    /**
     * Checks the existence of a session value.
     *
     * @param string $key The session key.
     * @return bool
     */
    public static function has(string $key): bool
    {
        return !empty(self::$temp[$key]) || isset(self::$temp[$key]);
    }

    /**
     * Saves the session.
     *
     * @return void
     */
    public static function save(): void
    {
        $_SESSION = self::$temp;
    }

    /**
     * Destroys the current session.
     *
     * @return void
     */
    public static function destroy(): void
    {
        if (session_id() !== "") {
            $_SESSION = [];
            session_destroy();
        }
    }

    /**
     * Initializes a new session.
     *
     * @return void
     */
    private static function _init(): void
    {
        if (session_status() === PHP_SESSION_DISABLED) {
            throw new \RuntimeException("Sessions are disabled.");
        }
        if (session_id() === "") {
            session_start();
            self::$temp = &$_SESSION;
        }
    }

    /**
     * Expires a session if it has been inactive for a specified amount of time.
     *
     * @return void
     * @throws RuntimeException Session has expired.
     */
    private static function _age()
    {
        $last = $_SESSION["LAST_ACTIVE"] ?? false;

        if (false !== $last && time() - $last > self::$SESSION_AGE) {
            self::destroy();
            throw new \RuntimeException("Session has expired.");
        }
        $_SESSION["LAST_ACTIVE"] = time();
    }

    /**
     * Dumps current session data.
     *
     * @return void
     */
    public static function dump(): void
    {
        self::_init();
        echo nl2br(print_r($_SESSION, true));
    }
}
