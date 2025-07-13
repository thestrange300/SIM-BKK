# SIM-BKK

**Sistem Informasi Masjid Bukan Kaleng-Kaleng**

SIM-BKK is a comprehensive information system designed to manage various aspects of a mosque's operations, including finance, inventory, events, and more.

## Features

*   **Manajemen Keuangan:** Track income and expenses.
*   **Manajemen Inventaris:** Manage mosque assets and inventory.
*   **Manajemen Acara:** Schedule and manage mosque events (e.g., Khutbah Jumat, Qurban).
*   **Manajemen Zakat:** Handle Zakat Fitrah collection and distribution.
*   **Manajemen Masjid:** Manage mosque personnel (Petugas Keagamaan) and facility rentals (Peminjaman Tempat).
*   **User Roles:** Different roles for Super Admin, Admin Keuangan, and Admin Masjid with specific permissions.

## Installation

To set up the project locally, follow these steps:

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd SIM-BKK
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node.js dependencies:**
    ```bash
    npm install
    ```
    or
    ```bash
    yarn install
    ```

4.  **Copy the environment file:**
    ```bash
    cp .env.example .env
    ```

5.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

6.  **Configure your database** in the `.env` file.

7.  **Run database migrations:**
    ```bash
    php artisan migrate
    ```

8.  **Seed the database** (optional, but recommended for initial data):
    ```bash
    php artisan db:seed
    ```

9.  **Build assets:**
    ```bash
    npm run dev
    ```
    or
    ```bash
    yarn dev
    ```

10. **Start the local development server:**
    ```bash
    php artisan serve
    ```

The application should now be accessible at `http://127.0.0.1:8000`.

## Usage

After installation, you can access the application through your web browser. Log in using the credentials created during the seeding process (if you ran the seeder) or register a new user if allowed. Navigate through the Filament admin panel to manage different aspects of the mosque.

## License

The SIM-BKK project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).