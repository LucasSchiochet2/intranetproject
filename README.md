# Intranet Project

Corporate intranet system developed with Laravel and Backpack, offering robust features for content management, task tracking, and multi-tenancy support.

## 🚀 Main Technologies

- **PHP 8.2+**
- **[Laravel 12.x](https://laravel.com)**: Robust and modern PHP framework.
- **[Backpack for Laravel 7.x](https://backpackforlaravel.com)**: Powerful administrative panel for CRUD management.
- **Laravel Fortify**: Secure, frontend-agnostic authentication backend.
- **Vite**: Fast build tool for frontend assets.
- **TailwindCSS & Bootstrap 5**: Styling and interface components.

## ✨ Modules and Features

The system features a modular architecture with **Multi-tenancy** support (multiple tenants/units), covering:

- **Administrative Management**
  - **Users & Collaborators**: Complete control with ACL system (Roles & Permissions).
  - **Ombudsman**: Module for ticket and feedback management.

- **Communication & Content**
  - **News**: Publishing and management of internal news.
  - **Banners**: Management of rotating or informational banners.
  - **Pages & Menus**: Dynamic management of the site structure.

- **Productivity**
  - **Documents**: Categorized file repository.
  - **Calendar**: Corporate agenda and event management.
  - **Tasks**: Task system with support for checklists and tracking.

## 🛠️ Installation and Configuration

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- Database (MySQL/MariaDB/PostgreSQL)

### Step by Step

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/intranetproject.git
   cd intranetproject
   ```

2. **Automatic Installation:**
   The project includes a helper script in `composer.json` that installs dependencies, configures `.env`, generates keys, and runs migrations:
   ```bash
   composer run setup
   ```

3. **Manual Installation (Alternative):**
   If you prefer to configure manually:
   ```bash
   # Install PHP dependencies
   composer install

   # Configure environment variables
   cp .env.example .env
   # (Edit the .env file with your database credentials)

   # Generate application key
   php artisan key:generate

   # Run migrations and seeders
   php artisan migrate --seed

   # Install and compile frontend assets
   npm install
   npm run build
   ```

## 👤 System Access

After running migrations and seeders (`database/seeders/DatabaseSeeder.php`), a default administrative user is created for initial access:

- **Login URL:** `/admin` (Backpack Default)
- **E-mail:** `admin@example.com`
- **Password:** `password` (Default defined by Laravel factory)

## 🧪 Tests

The project uses Pest and PHPUnit for testing. To execute the test suite:

```bash
php artisan test
```

## 📄 License

This project is developed on the Laravel framework, under the [MIT](https://opensource.org/licenses/MIT) license.
