# NoteBud's Project SDF

Project SDF is a project development framework created for PHP enthusiasts. The framework itself is compact, easy to maintain, and improvable.
With this fork, we aim to use the framework to create a cross-university note sharing platform for students.
Streamlining the process of sharing notes, and making it easier for students to access notes from other universities as well as their own.

This fork will maintain the original framework's structure, but will add new libraries, helpers and classes to support the note sharing platform.

## Features

- Cross-university note sharing
- Collaborative note editing
- Rating system for notes
- User profiles

## Framework version

This fork is based on the original Project SDF framework, version 1.5.1 with the revised router.

## Differences from the original framework

We are using static approach for the libraries if aplicable, and we are using the original framework's structure as much as possible.
The memory usage must be kept low, and the performance must be high thus achieving a fast and reliable platform.

Some of the differences are:

- New libraries

  - [x]: File library
  - [x]: Logger library
  - [x]: Mailer library
  - [x]: Flash library
  - [x]: Session library

- New helpers

  - [x]: Global
    - Ability to use global variables
    - File i/o functions
    - Some useful functions
  - [x]: Provider
    - Library providers, for example, Sorm\Model requires a database provider
  - [x]: String
    - String manipulation functions
    - Seo friendly url functions
    - Security functions
  - [x]: Encryption
    - Encryption functions, including hashing and salting
    - Decryption functions

## Installation

1. Clone the repository
2. Configure the application by editing both the sdf/config and app/config/product.php files
3. Run the application using the sdf-cli tool

## Usage

The application is designed to be used by students and lecturers. Students can upload and download notes, while lecturers can upload notes and manage the platform.

## Contributing

1. Fork the repository
2. Create a new branch
3. Make your changes
4. Create a pull request

## License

[Apache License 2.0](https://www.apache.org/licenses/LICENSE-2.0)

## Authors

- [devsimsek <Metin Şimşek>](https://github.com/devsimsek/project-sdf) - Original author of the Project SDF framework
- [NoteBud Backend Team Members](https://github.com/orgs/NoteBud/teams/backend-team)
