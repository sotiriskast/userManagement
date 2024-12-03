# Laravel Breeze User Management System

This project implements a Laravel-based user management system built on Laravel Breeze, providing a robust foundation for authentication and role-based access control.

---

## **Project Overview**

The User Management System includes the following features:
- Authentication powered by Laravel Breeze.
- Role-based access control (Super Admin, Admin, User roles).
- User creation, modification, and deletion through an intuitive interface.
- Pre-configured database migrations and seeders to quickly set up demo data.
- Responsive and modern frontend styling using Tailwind CSS.

---

## **Installation and Setup**

To run this project, ensure the following prerequisites are met:
- PHP >= 8.3
- Composer (PHP dependency manager)
- Node.js and npm (for frontend assets)
- MySQL database or equivalent.

Once all dependencies are installed, you can set up the project by:
- Configuring environment variables in the `.env` file.
- Running database migrations to create necessary tables.
- Seeding the database to prepopulate roles and demo users.
- Installing and building frontend assets with npm.

---

```bash
npm install
npm run build
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
```

## **Database Migrations and Seeding**

The project includes pre-configured database migrations and seeders. Running the migrations will create all necessary tables, while the seeders will populate the database with the following demo users and roles:

| **Role**        | **Email**            | **Password** |
|------------------|----------------------|--------------|
| Super Admin      | root@root.com        | `password`   |
| Admin            | admin@admin.com      | `password`   |
| User             | user@user.com        | `password`   |

To reset and reseed the database at any time, the following command can be executed:

```bash
php artisan migrate:fresh --seed
