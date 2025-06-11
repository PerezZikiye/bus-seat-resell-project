<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🚌 Bus Seat Resell Application

This is a Laravel 11 application for **reselling bus seats**, allowing users to view available seats, book them, and securely complete payments using Paystack. The platform includes admin and user dashboards, authentication, booking management, and more.

---

## 🚀 Features

- ✅ User registration and login
- ✅ Admin dashboard for managing bookings and users
- ✅ Seat booking system
- ✅ Payment gateway integration (Paystack)
- ✅ Role-based access (admin/user)
- ✅ Email notifications (optional)
- ✅ Laravel Blade components for layout and reuse
- ✅ Tailwind CSS for frontend styling

---

## 🛠️ Technologies

- PHP 8+
- Laravel 11
- MySQL
- Tailwind CSS
- Paystack (Payment Integration)

---

## 📦 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/PerezZikiye/bus-seat-resell.git
cd bus-seat-resell

~~
2. Install Dependencies
composer install
npm install

3. Create Environment File
cp .env.example .env

Then edit .env and update the following:

env
APP_NAME="Bus Seat Resell"
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

PAYSTACK_PUBLIC_KEY=your_public_key
PAYSTACK_SECRET_KEY=your_secret_key
⚠️ Replace placeholders with your actual credentials.

4. Generate Key
php artisan key:generate


5. Run Migrations
php artisan migrate


6. Seed Initial Data (optional)
php artisan db:seed


7. Compile Assets
npm run build

8. Start the Development Server
php artisan serve
Visit: http://127.0.0.1:8000



