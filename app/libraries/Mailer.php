<?php

namespace SDF\Library;
use SDF\Library\Logger;

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
 * @package     SDF\Library\Mailer
 * @file        Mailer.php
 * @version     v1.5.1
 * @since       v1.5
 * @author      devsimsek, The NoteBud Backend Team
 * @url         https://github.com/NoteBud/project-sdf/
 * @filesource
 */

class Mailer
{
    private string $to;
    private string $subject;
    private string $htmlMessage;
    private string $plainMessage;
    private string $from;
    private array $headers = [];
    private array $attachments = [];

    // Constructor
    public function __construct(
        string $to,
        string $subject,
        string $htmlMessage,
        string $plainMessage = "",
        string $from = ""
    ) {
        $this->to = $to;
        $this->subject = $subject;
        $this->htmlMessage = $htmlMessage;
        $this->plainMessage = $plainMessage ?: strip_tags($htmlMessage);
        $this->from = $from;

        $this->headers[] = "MIME-Version: 1.0";
        $this->headers[] = "From: $from";
    }

    // Function to set custom headers
    public function addHeader(string $header): void
    {
        $this->headers[] = $header;
    }

    // Function to set the "From" address
    public function setFrom(string $from): void
    {
        $this->headers[] = "From: $from";
    }

    // Function to add an attachment
    public function addAttachment(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File does not exist: $filePath");
        }
        $this->attachments[] = $filePath;
    }

    // Function to validate email addresses
    private function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Function to send the email
    public function send(): string
    {
        if (!$this->isValidEmail($this->to)) {
            $errorMsg = "Invalid email address: {$this->to}";
            Logger::error($errorMsg);
            return $errorMsg;
        }

        $boundary = md5(time());
        $this->headers[] = "Content-Type: multipart/alternative; boundary=\"$boundary\"";

        // Create the email body
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $body .= $this->plainMessage . "\r\n";

        $body .= "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $body .= $this->htmlMessage . "\r\n";

        // Add attachments if any
        foreach ($this->attachments as $filePath) {
            $fileName = basename($filePath);
            $fileType = mime_content_type($filePath);
            $fileContent = chunk_split(
                base64_encode(file_get_contents($filePath))
            );

            $body .= "--$boundary\r\n";
            $body .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n";
            $body .= $fileContent . "\r\n";
        }

        $body .= "--$boundary--";

        // Send the email
        if (
            mail(
                $this->to,
                $this->subject,
                $body,
                implode("\r\n", $this->headers)
            )
        ) {
            Logger::info(
                "Email sent successfully to {$this->to} with subject '{$this->subject}'"
            );
            return "Email sent successfully to {$this->to}";
        } else {
            Logger::error("Failed to send email to {$this->to}");
            return "Failed to send email.";
        }
    }
}
