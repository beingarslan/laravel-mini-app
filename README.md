# Project Name

GEVS – An Online Voting Platform.

## Installation

Follow these steps to install and run the application:

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js and npm
- A database system (MySQL, PostgreSQL, etc.)

### Setup

1. **Install PHP Dependencies**

    ```bash
    composer install
    ```

2. **Environment Configuration**

    Copy the example environment file and edit it to match your local configuration.

    ```bash
    cp .env.example .env
    ```

    Open `.env` file and update the database credentials:

    ```
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

3. **Database Migration and Seeding**

    Run the following command to create the database tables and seed them with any initial data.

    ```bash
    php artisan migrate:fresh --seed
    ```

### Frontend Setup

1. **Install Node Dependencies**

    In a new terminal window, install the Node.js dependencies.

    ```bash
    npm install
    ```

2. **Compile Assets**

    Compile the front-end assets using Laravel Mix.

    ```bash
    npm run dev
    ```

### Running the Application

- To start the Laravel application, run:

    ```bash
    php artisan serve
    ```

- Access the application via the browser: `http://localhost:8000`

## Additional Information

- Add any additional setup or operational information here.

## Support

For support, contact [your-email@example.com].
