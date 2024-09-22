# Global Helper

This is the documentation for the Global Helper in NoteBud\SDF.

## Introduction

Global helper is a collection of functions that are used globally in the application.
It stores constants, global functions, global variables and loaders that are used throughout the application.

## Functions

### is_url

**Arguments**:

- url: string

**Returns**: boolean

This function is used to check if the given string is a valid URL.

### is_email

**Arguments**:

- email: string

**Returns**: boolean

This function is used to check if the given string is a valid email.

### is_json

**Arguments**:

- json: string

**Returns**: boolean

This function is used to check if the given string is a valid JSON.

### is_base64

**Arguments**:

- base64: string

**Returns**: boolean

This function is used to check if the given string is a valid base64 encoded string.

### is_serialized

**Arguments**:

- serialized: string

**Returns**: boolean

This function is used to check if the given string is a valid serialized string.

### read_file

**Arguments**:

- file: string

**Returns**: string

This function is used to read the contents of a file.

### write_file

**Arguments**:

- file: string

This function is used to write data to a file.

### append_file

**Arguments**:

- file: string

This function is used to append data to a file.

### delete_file

**Arguments**:

- file: string

This function is used to delete a file.

### upload_file

**Arguments**:

- file: string

This function is used to upload a file.

### download_file

**Arguments**:

- file: string

This function is used to download a file.

### create_directory

**Arguments**:

- directory: string

This function is used to create a directory.

### delete_directory

**Arguments**:

- directory: string

This function is used to delete a directory.

### list_directory

**Arguments**:

- directory: string

**Returns**: array

This function is used to list the contents of a directory.

### directory_exists

**Arguments**:

- directory: string

**Returns**: boolean

This function is used to check if a directory exists.

### unsafe_load_core

Loads core loader.

### load_view

**Arguments**:

- name: string
- data: array|object
- directory: string

**Returns**: string

This function is used to load a view.

### load_library

**Arguments**:

- name: string
- params: array
- directory: string

This function is used to load a library.

### load_model

**Arguments**:

- name: string
- params: array
- directory: string

This function is used to load a model.

### load_helper

**Arguments**:

- name: string
- params: array
- directory: string

This function is used to load a helper.

### load_file

**Arguments**:

- file: string
- directory: string

This function is used to load a file.

### load_config

**Arguments**:

- name: string
- directory: string

This function is used to load a config.

## Conclusion

This is the documentation for the Global Helper in NoteBud\SDF. The Global Helper is a collection of functions that are used globally in the application. It stores constants, global functions, global variables and loaders that are used throughout the application. The Global Helper provides functions to check if a string is a valid URL, email, JSON, base64 encoded string, or serialized string. It also provides functions to read, write, append, delete, upload, download, create, delete, list directories, and check if a directory exists. The Global Helper also provides functions to load views, libraries, models, helpers, files, and configs. The Global Helper is an essential part of the NoteBud\SDF framework and is used in many parts of the application.
