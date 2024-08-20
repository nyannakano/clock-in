# Clock-In System API

## Description

This is an open source project developed using Laravel 11. This API provides functionality for managing time tracking, including work time control, time bank management, overtime tracking, and blocking work on weekends. The project is still under development and aims to be a comprehensive solution for time management in the workplace.

## Technologies

- **Laravel 11**: PHP framework for web development.
- **MySQL**: Relational database management system.
- **Docker**: Containerization platform.
- **Sail**: Docker development environment for Laravel.
- **PHPUnit**: Testing framework for PHP.
- **Sanctum**: Laravel package for API authentication.
- **Telescope**: Laravel package for debugging and monitoring.

## Architecture

The project is divided into the following layers:

- **Controllers**: Responsible for receiving requests and returning responses.
- **Services**: Responsible for implementing the business rules.
- **Repositories**: Responsible for implementing the database operations.
- **Models**: Responsible for representing the database tables.

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `cp .env.example .env`
4. Run `./vendor/bin/sail up -d`
5. Run `./vendor/bin/sail artisan key:generate`
6. Run `./vendor/bin/sail artisan migrate`
7. Run `./vendor/bin/sail artisan db:seed`
