Product Management System
# 🛒 Product Cart & Checkout API (Laravel)

This is a Laravel-based backend application for managing products, cart functionality, and Stripe-powered checkout with API endpoints. It includes an admin panel, CRUD operations, and a complete REST API for frontend/mobile integration.

---

## 🚀 Features

- Product CRUD with multiple image uploads
- Add to cart, update quantity, remove items
- Cart summary with total amount
- Stripe payment gateway integration
- Clean admin dashboard with login
- Exception handling and validation
- RESTful APIs with Postman collection
- API-ready backend (Laravel 10+, PHP 8.1+)

---

## 🧑‍💻 Technologies

- PHP 8.1+
- Laravel 10
- MySQL 8+
- Stripe Payment API
- Laravel Breeze (for auth)
- Bootstrap / Admin Template (for CMS)
- REST APIs (with Postman docs)

---

## 📦 Installation

### 1. Clone the repository

```bash
git clone https://github.com/SawantRiddhi12/product_management.git
cd project_management_system
```

### 2. Install dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Copy `.env` and set credentials

```bash
cp .env.example .env
```

Then edit `.env` and set:

```env
APP_NAME=Laravel
APP_URL=http://localhost:8000

DB_DATABASE=project_management_system
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=pk_test_XXXXXXXXXXXXXXXXXXXXXXXX
STRIPE_SECRET=sk_test_XXXXXXXXXXXXXXXXXXXXXXXX
```

### 4. Generate app key

```bash
php artisan key:generate
```

### 5. Run migrations and seeders

```bash
php artisan migrate --seed
```

### 6. Create storage symlink

```bash
php artisan storage:link
```

### 7. Start development server

```bash
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000)

---

## 🧪 API Testing (Postman)

Use Postman collection for testing:
- Products
- Cart
- Payment
---

## 🗃️ Admin Credentials

> After seeding:

- **URL:** `/login`
- **Email:** `admin@example.com`
- **Password:** `Admin123`

---

## 📂 Folder Structure Highlights

```
app/
 └── Http/
     ├── Controllers/Api/CartController.php
     ├── Resources/CartResource.php
     └── ...
routes/
 ├── api.php        # API routes
 └── web.php        # Admin routes
public/
 └── storage/       # Product images
```

---

## 💳 Stripe Testing

Use the Stripe test token:
```json
{
  "stripeToken": "tok_visa"
}
```

More test cards: https://stripe.com/docs/testing

---

## 🔐 Environment Requirements

- PHP 8.2.12
- MySQL 8+
- Node.js 16+
- Composer
- Laravel 12

---

Thank You!
