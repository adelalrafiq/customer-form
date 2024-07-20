# Customer Form Application

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/adelalrafiq/customer-form.git

2. Navigate to the project directory:
   ```bash
   cd customer-form

3. Install dependencies:
   ```bash
   composer install

4. Create a copy of the .env file:
   ```bash
   cp .env.example .env

5. Generate an application key:
   ```bash
   php artisan key:generate

6. Configure your database settings in the .env file.

7. Run the migrations:
   ```bash
   php artisan migrate

8. Serve the application:
   ```bash
   php artisan serve
