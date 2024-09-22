<?php

namespace SDF\Library;
use SDF\Library\Logger\Log;

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
 * @package     SDF\Library\Logger
 * @file        Logger
 * @version     v1.0.0
 * @since       v1.0
 * @author      devsimsek, The NoteBud Backend Team
 * @url         https://github.com/NoteBud/project-sdf/
 * @filesource
 */
class Logger
{
    // Log storage
    // @var Log[]
    protected static array $logs = [];

    // Allowed Types
    // @var string[]
    protected static array $allowedTypes = [
        0 => "info",
        1 => "notice",
        2 => "warning",
        3 => "error",
    ];

    public function __construct()
    {
        // Initialize if needed
    }

    // Set the Log Message
    // @param Log $message
    // @return void
    public static function set(Log $message): void
    {
        self::$logs[] = $message;
    }

    // Get the Log Message
    // @param int $timestamp
    // @param int $type
    // @return Log[] if one of the parameters is not empty and the log is found, otherwise return []Log
    // @throws Exception
    public static function get(int $timestamp = -1, int $type = -1): array
    {
        $results = [];

        foreach (self::$logs as $log) {
            if (
                ($timestamp === -1 || $log->time === $timestamp) &&
                ($type === -1 || $log->type === self::$allowedTypes[$type])
            ) {
                $results[] = $log;
            }
        }

        return $results;
    }

    // Clear the Logs
    // @return void
    public static function clear(): void
    {
        self::$logs = [];
    }

    // Format the Log Message
    // Only for internal use
    // @param string $message
    // @param string $type
    // @return string
    protected static function format(string $message, string $type): string
    {
        return "[" . strtoupper($type) . "] " . $message;
    }

    protected static function log(Log $message, int $type): void
    {
        self::set($message);
    }

    public static function info(string $message): void
    {
        self::log(new Log($message, self::$allowedTypes[0], time()), 0);
    }

    public static function notice(string $message): void
    {
        self::log(new Log($message, self::$allowedTypes[1], time()), 1);
    }

    public static function warning(string $message): void
    {
        self::log(new Log($message, self::$allowedTypes[2], time()), 2);
    }

    public static function error(string $message): void
    {
        self::log(new Log($message, self::$allowedTypes[3], time()), 3);
    }

    public static function debug(string $message): void
    {
        self::log(new Log($message, "debug", time()), 0); // Adding debug as info for logging
    }

    public static function critical(string $message): void
    {
        self::log(new Log($message, "critical", time()), 3); // Critical as error
    }
}

namespace SDF\Library\Logger;

/**
 * Log Message Type
 * @package     SDF\Library\Logger\Log
 * @file        Log
 * @version     v1.0.0
 * @since       v1.0
 * @author      devsimsek, The NoteBud Backend Team
 * @url         https://github.com/NoteBud/project-sdf/
 * @filesource
 */
class Log
{
    public function __construct(
        // Log Message
        protected string $message,

        // Log Type
        protected string $type,

        // Log Time
        protected int $time
    ) {
        // Changed to int for timestamps
    }

    public function __toString()
    {
        return Logger::format($this->message, $this->type);
    }
}
