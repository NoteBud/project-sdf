<?php

namespace SDF\Library;

use SDF\Library\Session;
use SDF\Library\Flash\Message;

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
 * @package     SDF\Library\Flash
 * @file        Flash.php
 * @version     v1.0.0
 * @since       v1.0
 * @author      devsimsek, The NoteBud Backend Team
 * @url         https://github.com/NoteBud/project-sdf/
 * @filesource
 */
class Flash
{
    // Temporary Flash Storage
    // @var []Message
    protected static array $flash = [];

    // Allowed Types
    // @var []string
    public static array $allowedTypes = ["info", "success", "warning", "error"];

    public function __construct()
    {
        Flash::init();
    }

    // Initialize the Flash Message
    // @return void
    public static function init(): void
    {
        // initialize session
        Session::start();

        // check if the flash key exists at the session storage, if not create it
        if (!Session::has("flash")) {
            Session::w("flash", []);
        } else {
            self::$flash = Session::r("flash");
        }
    }

    // Set the Flash Message
    // @param Message $message
    // @return void
    public static function load(Message $message): void
    {
        self::$flash[] = $message;
        self::save();
    }

    // Get the Flash Message
    // @return string
    public static function dispose(string $type = ""): array
    {
        if (!empty($type) && in_array($type, self::$allowedTypes)) {
            $m = array_filter(self::$flash, fn($m) => $m->type === $type);
            self::$flash = array_filter(
                self::$flash,
                fn($m) => $m->type !== $type || $m->persistent
            );
            return $m;
        }

        $m = self::$flash;

        self::$flash = array_filter(self::$flash, fn($m) => $m->persistent);

        self::save();

        return $m;
    }

    // Check if the Flash Message Exists
    // @return bool
    public static function has(): bool
    {
        return !empty(self::$flash);
    }

    // Save the Flash Message
    // @return void
    protected static function save(): void
    {
        Session::w("flash", self::$flash);
    }
}

namespace SDF\Library\Flash;

use SDF\Library\Flash;

// Message Class
class Message
{
    public function __construct(
        public string $message,
        public string $type = "info",
        public string $icon = "",
        public string $title = "",
        public string $subtitle = "",
        public string $link = "",
        public string $linkText = "",
        public bool $persistent = false,
        public int $dismissTimeout = 5000
    ) {
        if (!in_array($this->type, Flash::$allowedTypes)) {
            throw new \Exception("Invalid Flash Message Type");
        }
    }
}
