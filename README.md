# Clock-In System API

## Description

This is an open source project developed using Laravel 11. This API provides functionality for managing time tracking, including work time control, time bank management, overtime tracking, and blocking work on weekends. The project is still under development and aims to be a comprehensive solution for time management in the workplace.

## Technologies

Laravel 11, MySQL, Docker (with Sail), Sanctum, Telescope.

## Architecture

For now, the project is being developed using the MVC architecture, with a Service Layer for business rules. The controller layer is responsible for receiving the requests and returning the responses.

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `cp .env.example .env`
4. Run `./vendor/bin/sail up -d`
5. Run `./vendor/bin/sail artisan key:generate`
6. Run `./vendor/bin/sail artisan migrate`
7. Run `./vendor/bin/sail artisan db:seed`
