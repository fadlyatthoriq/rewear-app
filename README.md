# Rewear App

<p align="center">
  <img src="public/assets/images/logo.png" alt="Rewear Logo" width="200">
</p>

<p align="center">
  <a href="https://github.com/fadlyatthoriq/rewear-app"><img src="https://img.shields.io/github/stars/fadlyatthoriq/rewear-app" alt="Stars"></a>
  <a href="https://github.com/fadlyatthoriq/rewear-app/blob/master/LICENSE"><img src="https://img.shields.io/github/license/fadlyatthoriq/rewear-app" alt="License"></a>
  <a href="https://github.com/fadlyatthoriq/rewear-app/issues"><img src="https://img.shields.io/github/issues/fadlyatthoriq/rewear-app" alt="Issues"></a>
</p>

## About Rewear App

Rewear App is a modern e-commerce platform built with Laravel, focusing on sustainable fashion through second-hand clothing. Our platform connects buyers and sellers of pre-loved fashion items, promoting a circular economy in the fashion industry.

### Key Features

- 🛍️ User-friendly shopping experience
- 👤 Secure user authentication
- 🛒 Shopping cart functionality
- 💳 Secure payment processing
- 📱 Responsive design
- 🔍 Advanced search and filtering
- 📊 Admin dashboard
- 📦 Order management system

## Built With

<p align="center">
  <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo"></a>
</p>

- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [MySQL](https://www.mysql.com) - Database
- [Vite](https://vitejs.dev) - Next Generation Frontend Tooling

## Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

### Installation

1. Clone the repository
```bash
git clone https://github.com/fadlyatthoriq/rewear-app.git
cd rewear-app
```

2. Install PHP dependencies
```bash
composer install
```

3. Install NPM dependencies
```bash
npm install
```

4. Create environment file
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Configure your database in `.env` file
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rewear_app
DB_USERNAME=root
DB_PASSWORD=
```

7. Run migrations and seeders
```bash
php artisan migrate --seed
```

8. Start the development server
```bash
php artisan serve
```

9. In a separate terminal, start Vite
```bash
npm run dev
```

Visit `http://localhost:8000` to see the application.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- All contributors who have helped shape this project

---

<p align="center">
  Made with ❤️ by <a href="https://github.com/fadlyatthoriq">Fadly Atthoriq</a>
</p>
