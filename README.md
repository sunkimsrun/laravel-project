# Hospitality (Hotel Booking Management System)

A RESTful API for managing hotels, guests, rooms, bookings, and payments built with Laravel.

## ✨ Features

- Full CRUD for Guests, Hotels, Rooms, Bookings, and Payments
- JWT-based authentication with role-based access (Admin/User)
- Modular MVC structure using Laravel best practices
- Blade form interface for submitting hotel and guest entries
- Middleware protection for authenticated routes
- Database seeders and custom model methods

---

## 🚀 Installation Guide

1. **Clone the Repository**

    ```bash
    git clone https://github.com/sunkimsrun/laravel-project.git
    cd laravel-project
    ```
2. **Composer Install**

    ```bash
    composer install
    npm install
    ```

3. **Configure the environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Set up the database connection in `.env`**
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3310
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Install and configure JWT Authentication**

    ```bash
    composer require tymon/jwt-auth
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    php artisan jwt:secret
    ```

6. 6. **Run migrations and seeders**

   ```bash
   php artisan migrate --seed
   ```
   
7. **Start the development server**

   ```bash
   php -S 127.0.0.1:8888 -t public
   ```

---

## API Documentation

**Base URL:** `http://127.0.0.1:8888`

### Authentication Endpoints

| Method | Endpoint  | Description           |
| ------ | --------- | --------------------- |
| POST   | /register | Register a user/admin |
| POST   | /login    | Login and get token   |


**Example: Register User**

```json
{
  "name": "name",
  "email": "name@example.com",
  "password": "123456789"
}
```

## Resource Endpoints

### Destinations

| Method | Endpoint     | Description        |
| ------ | ------------ | ------------------ |
| GET    | /guests      | List all guests    |
| POST   | /guests      | Create a guest     |
| PATCH  | /guests/{id} | Update guest by ID |
| DELETE | /guests/{id} | Delete guest by ID |

### Hotel

| Method | Endpoint     | Description        |
| ------ | ------------ | ------------------ |
| GET    | /hotels      | List all hotels    |
| POST   | /hotels      | Create a hotel     |
| PATCH  | /hotels/{id} | Update hotel by ID |
| DELETE | /hotels/{id} | Delete hotel by ID |

### Rooms

| Method | Endpoint    | Description       |
| ------ | ----------- | ----------------- |
| GET    | /rooms      | List all rooms    |
| POST   | /rooms      | Create a room     |
| PATCH  | /rooms/{id} | Update room by ID |
| DELETE | /rooms/{id} | Delete room by ID |

### Booking

| Method | Endpoint       | Description          |
| ------ | -------------- | -------------------- |
| GET    | /bookings      | List all bookings    |
| POST   | /bookings      | Create a booking     |
| PATCH  | /bookings/{id} | Update booking by ID |
| DELETE | /bookings/{id} | Delete booking by ID |





