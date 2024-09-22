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
 * @package     SDF\Library\File
 * @file        File.php
 * @version     v1.0.0
 * @since       v1.0
 * @author      devsimsek, The NoteBud Backend Team
 * @url         https://github.com/NoteBud/project-sdf/
 * @filesource
 */
class File
{
    // r/w

    // Open
    // Open is a function that opens a file and reads its content
    // @param string $path
    // @param string $mode
    // @return bool
    public function open(string $path, string $mode = "r"): bool
    {
        // Retreive the content of the remote file.
        if (str_starts_with($path, "http")) {
            return file_get_contents($path);
        }

        $h = fopen($path, $mode);
        $b = "";
        if ($h) {
            while (!feof($h)) {
                $line = fgets($h);
                $b .= $line;
            }
            fclose($h);
        }
        return $b;
    }

    // Write
    // Write is a function that writes content to a file
    // @param string $path
    // @param string $content
    // @return bool
    public function write(string $path, string $content): bool
    {
        $h = fopen($path, "w");
        if ($h) {
            fwrite($h, $content);
            fclose($h);
            return true;
        }
        return false;
    }

    // upload/download

    // Upload
    // Upload is a function that takes uploaded content from $_FILES and writes into a file
    public function upload(string $path, string $key): bool
    {
        if (isset($_FILES[$key])) {
            $file = $_FILES["file"];
            // if there's more than one file
            if (is_array($file)) {
                while (list($key, $value) = each($file)) {
                    if ($value["error"] == UPLOAD_ERR_OK) {
                        move_uploaded_file(
                            $value["tmp_name"],
                            $path . $value["name"]
                        );
                    }
                }
            } else {
                if ($file["error"] == UPLOAD_ERR_OK) {
                    move_uploaded_file(
                        $file["tmp_name"],
                        $path . $file["name"]
                    );
                }
            }
        }
        return false;
    }

    // Download
    // Download is a function that captures a file from a URL
    // @param string $url
    // @param string $path
    // @return void
    public function download(string $url, string $path): void
    {
        $newfname = $path;
        $file = fopen($url, "rb");
        if ($file) {
            $newf = fopen($newfname, "wb");
            if ($newf) {
                while (!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }

        if ($file) {
            fclose($file);
        }

        if ($newf) {
            fclose($newf);
        }
    }

    // manuplation

    // Copy
    // Copy is a function that copies a file from one location to another
    // @param string $source
    // @param string $destination
    // @return bool
    public function copy(string $source, string $destination): bool
    {
        return copy($source, $destination);
    }

    // Move
    // Move is a function that moves a file from one location to another
    // @param string $source
    // @param string $destination
    // @return bool
    public function move(string $source, string $destination): bool
    {
        return rename($source, $destination);
    }

    // Delete
    // Delete is a function that deletes a file
    // @param string $path
    // @return bool
    public function delete(string $path): bool
    {
        return unlink($path);
    }

    // Create
    // Create is a function that creates a file
    // @param string $path
    // @return bool
    public function create(string $path): bool
    {
        $h = fopen($path, "w");
        if ($h) {
            fclose($h);
            return true;
        }
        return false;
    }

    // Read
    // Read is a function that reads a file
    // @param string $path
    // @return string
    public function read(string $path): string
    {
        $h = fopen($path, "r");
        $b = "";
        if ($h) {
            while (!feof($h)) {
                $line = fgets($h);
                $b .= $line;
            }
            fclose($h);
        }
        return $b;
    }

    // Info
    // Info is a function that returns information about a file
    // @param string $path
    // @return array
    public function info(string $path): array
    {
        return stat($path);
    }

    // Size
    // Size is a function that returns the size of a file
    // @param string $path
    // @return int
    public function size(string $path): int
    {
        return filesize($path);
    }

    // Type
    // Type is a function that returns the type of a file
    // @param string $path
    // @return string
    public function type(string $path): string
    {
        return filetype($path);
    }

    // Mime
    // Mime is a function that returns the mime type of a file
    // @param string $path
    // @return string
    public function mime(string $path): string
    {
        return mime_content_type($path);
    }

    // Extension
    // Extension is a function that returns the extension of a file
    // @param string $path
    // @return string
    public function extension(string $path): string
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    // Permissions
    // Permissions is a function that returns the permissions of a file
    // @param string $path
    // @return int
    public function permissions(string $path): int
    {
        return fileperms($path);
    }

    // compression/extraction

    // Compress
    // Compress is a function that compresses a file
    // @param string $source
    // @param string $destination
    // @return bool
    public function compress(string $source, string $destination): bool
    {
        return gzcompress(file_get_contents($source), 9);
    }

    // Extract
    // Extract is a function that extracts a file
    // @param string $source
    // @param string $destination
    // @return bool
    public function extract(string $source, string $destination): bool
    {
        return gzuncompress(file_get_contents($source));
    }

    // Hash
    // Hash is a function that hashes a file
    // @param string $path
    // @param string $algo
    // @return string
    public function hash(string $path, string $algo): string
    {
        return hash_file($algo, $path);
    }

    // Checksum
    // Checksum is a function that returns the checksum of a file
    // @param string $path
    // @param string $algo
    // @return string
    public function checksum(string $path, string $algo): string
    {
        return hash_file($algo, $path);
    }

    // Compare
    // Compare is a function that compares two files
    // @param string $path1
    // @param string $path2
    // @return bool
    public function compare(string $path1, string $path2): bool
    {
        return md5_file($path1) === md5_file($path2);
    }
}
