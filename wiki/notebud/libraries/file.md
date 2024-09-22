# File Library

This library provides functions to work with files.

## Introduction

File library provides a better interface to work with files.
It can handle normal i/o operations as well as downloading files from remote locations, handling upload operations and even more.
It has a simple and easy to use structure.

## Functions

### open

**Arguments**:

- path: string
- mode: string

**Returns**: boolean

Open is a function that opens a file and reads its content
It takes two arguments, the path to the file and the mode in which the file should be opened.
If path starts with `http://` or `https://`, it will download the file from the remote location.
If the file is not found, it will return false.

### write

**Arguments**:

- path: string
- content: string

**Returns**: boolean

Write is a function that writes content to a file.
It takes two arguments, the path to the file and the content to be written.
If the file is not found, it will return false.

### upload

**Arguments**:

- path: string
- key: string

**Returns**: boolean

Upload is a function that handles incoming file uploads.
It takes two arguments, the path to the file and the key of the file in the request.
If the file is not found, it will return false.

File should be uploaded using `multipart/form-data` encoding.
Also it supports multiple file uploads.

### download

**Arguments**:

- url: string
- path: string

**Returns**: boolean

Download is a function that downloads a file from a remote location.
It takes two arguments, the url of the file and the path where the file should be saved.
If the file is not found, it will return false.

### Copy

**Arguments**:

- source: string
- destination: string

**Returns**: boolean

Copy is a function that copies a file from one location to another.
It takes two arguments, the source path of the file and the destination path where the file should be copied.
If the file is not found, it will return false.

### Move

**Arguments**:

- source: string
- destination: string

**Returns**: boolean

Move is a function that moves a file from one location to another.
It takes two arguments, the source path of the file and the destination path where the file should be moved.
If the file is not found, it will return false.

### Delete

**Arguments**:

- path: string

**Returns**: boolean

Delete is a function that deletes a file.
It takes one argument, the path of the file to be deleted.
If the file is not found, it will return false.

### Create

**Arguments**:

- $path: string

**Returns**: boolean

Create is a function that creates a file.
It takes one argument, the path of the file to be created.

### Read

**Arguments**:

- path: string

**Returns**: string

Read is a function that reads the content of a file.
It takes one argument, the path of the file to be read.

### Info

**Arguments**:

- path: string

**Returns**: string

Info is a function that returns information about a file.
It takes one argument, the path of the file.

### Mime

**Arguments**:

- path: string

**Returns**: string

Mime is a function that returns the mime type of a file.

### Extension

**Arguments**:

- path: string

**Returns**: string

Extension is a function that returns the extension of a file.

### Permissions

**Arguments**:

- path: string

**Returns**: string

Permissions is a function that returns the permissions of a file.

### Compress

**Arguments**:

- source: string
- destination: string

**Returns**: boolean

Compress is a function that compresses a file.
It takes two arguments, the source path of the file and the destination path where the file should be compressed.

### Extract

**Arguments**:

- source: string
- destination: string

**Returns**: boolean

Extract is a function that extracts a compressed file.
It takes two arguments, the source path of the file and the destination path where the file should be extracted.

### Hash

**Arguments**:

- path: string
- algo: string

**Returns**: string

Hash is a function that hashes a file.
It takes two arguments, the path of the file and the algorithm to be used.

### Checksum

**Arguments**:

- path: string
- algo: string

**Returns**: string

Checksum is a function that calculates the checksum of a file.

### Compare

**Arguments**:

- path1: string
- path2: string

**Returns**: boolean

Compare is a function that compares two files.

## Conclusion

Providers are a great way to provide services to the application.
They allow us to delay the instantiation of services until they are actually needed.
