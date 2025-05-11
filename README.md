# MineDrive

This is the backend API for the **MineDrive** application, a comprehensive vehicle management system designed for mining companies. It handles vehicle monitoring, fuel consumption tracking, service scheduling, usage history, and a booking system with an approval workflow.

Built with the **Laravel Framework**.

## Key Features

-   User Management with Roles (Admin, Approver, Driver)
-   Vehicle Data Management (company-owned & rented, passenger & goods transport)
-   Vehicle Booking System with multi-level approval workflow
-   Fuel Usage Tracking per vehicle
-   Vehicle Service History Logging

## Technologies Used

-   **PHP**
-   **Laravel 12 Framework** 
-   **Composer** 
-   **MySQL**

## Prerequisites

Ensure your development environment has the following installed:
-   PHP (compatible with your Laravel version)
-   Composer
-   A Database Server (MySQL,.)
-   Git

## Installation

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/HAFIDJR/MineDrive.git](https://github.com/HAFIDJR/MineDrive.git)
    cd MineDrive
    ```

2.  **Install PHP dependencies using Composer:**
    ```bash
    composer install
    ```

3.  **Copy the example environment file:**
    ```bash
    cp .env.example .env
    ```

4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

## Environment Configuration

Open the `.env` file and customize the settings, especially the database connection details:

```dotenv
APP_NAME="MineDrive"
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx= # This will be filled by `php artisan key:generate`
APP_DEBUG=true
APP_URL=http://localhost:8000 # Adjust if you use a different port or domain

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql # Change to pgsql, sqlite, etc., if needed
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=minedrive_db # Example: your_database_name
DB_USERNAME=root # Example: your_database_username
DB_PASSWORD= # Example: your_database_password

# Other configurations (Mail, Cache, Queue, etc.) can be added here