# Press API – Laravel Web Application

Press API is a web application developed using Laravel and MySQL as part of my academic training in application development.

The application allows users to browse articles, manage categories, authenticate accounts, search content, and save favorite articles.

## Features

- Articles management system
- Categories management
- User authentication
- Favorites system
- Search functionality
- REST API routes
- Dynamic frontend using Blade templates and JavaScript

## Technologies Used

- Laravel
- PHP
- MySQL
- JavaScript
- HTML / CSS
- Blade Templates
- XAMPP (local development environment)

## Architecture

The project follows the MVC architecture:

- Models: database interaction
- Controllers: application logic
- Views: Blade templates
- API routes for backend communication

## Installation

Clone the repository:
git clone https://github.com/FADELSAMI/press-api.git

Install dependencies:
composer install
npm install

Configure `.env` file and database connection, then run:
php artisan migrate
php artisan serve
npm run dev

## Author

Sami Fadel  
Final-year Application Development Student – ISFCE Brussels