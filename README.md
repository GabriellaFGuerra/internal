# Grupo Reica Internal Management System

This is the internal management system developed for **Grupo Reica**, a Brazilian real estate and construction company. The system is designed to handle internal processes and improve the efficiency of employee-related tasks.

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Dependencies](#dependencies)
- [Contributing](#contributing)
- [License](#license)

## Introduction

The internal management system streamlines various operations within Grupo Reica, providing a centralized platform for employees to manage their daily tasks efficiently. It is built using Laravel and other modern technologies tailored to meet the needs of the real estate and construction industries.

## Features

- Employee management
- Task tracking and reporting
- Document management
- User role management

## Installation

To install and run the project locally, follow these steps:

1. Clone the repository:
    ```bash
    git clone https://github.com/GabriellaFGuerra/internal.git
    ```
2. Navigate to the project directory:
    ```bash
    cd internal
    ```
3. Install dependencies using Composer:
    ```bash
    composer install
    ```
4. Install frontend packages using npm:
    ```bash
    npm install
    ```
5. Create a `.env` file by copying the example:
    ```bash
    cp .env.example .env
    ```
6. Generate the application key:
    ```bash
    php artisan key:generate
    ```
7. Run the database migrations and seed:
    ```bash
    php artisan migrate --seed
    ```
8. Start the local development server:
    ```bash
    php artisan serve
    ```

## Usage

After installation, you can access the system through your local server. The main dashboard provides access to all features, including task management, user roles, and project management. Detailed documentation on how to use each feature can be found within the application.

## Configuration

Make sure to configure the `.env` file with your database and other environment-specific settings. This includes setting up the database connection, mail settings, and any API keys required.

## Dependencies

- PHP 8.x
- Laravel 11.x
- Composer
- MySQL or any supported database

## Contributing

Contributions are welcome! Please fork this repository and submit a pull request with your proposed changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
