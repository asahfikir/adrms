# 📚 Academic Document Readiness Monitoring System (ADRMS)

A Laravel + FilamentPHP web application to monitor document readiness for the current active academic year. Built for internal academic use by Superadmins, Document PICs (users), and Stakeholders to ensure timely document submission and visibility.

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![Filament](https://img.shields.io/badge/Filament-v3-blue)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-06B6D4)
![License](https://img.shields.io/badge/license-MIT-green.svg)

---

## ✨ Features

- 👤 Role-based Access Control (Superadmin, User, Stakeholder)
- 📆 Academic Year Management
- 📂 Document Categories & Subcategories
- 🔗 Assign PICs to Document Subcategories
- 📥 Document URL Submission (Google Docs/Sheets)
- 📊 Real-time Progress Dashboard for Stakeholders
- 🔍 Filtering by Category and PIC (powered by Alpine.js)
- 🔒 Permission system via Filament Shield

---

## 📦 Tech Stack

- **Backend**: Laravel 10.x
- **Admin Panel**: FilamentPHP v3
- **Styling**: TailwindCSS
- **Interactivity**: Alpine.js
- **RBAC**: Spatie Roles + Filament Shield
- **Database**: MySQL
- **Version Control**: Git + GitHub

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/adrms.git
cd adrms
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run build
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit .env for your DB settings:
```ini
DB_DATABASE=adrms
DB_USERNAME=root
DB_PASSWORD=secret
```

### 4. Run Migrations & Seeders + Setup filament
```bash
php artisan migrate --seed && php artisan shield:install
# This will create default roles: superadmin, user, stakeholder.
```

### 5. Create Superadmin
```bash
php artisan tinker
>>> \App\Models\User::factory()->create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
])->assignRole('super_admin');
```

## 🧪 Testing
Manual testing preferred for MVP.
✅ Login and permission control
✅ Assigning PICs and submitting document links
✅ Stakeholder dashboard with live filtering

## 📸 Screenshots
(Will add screenshots here later)

## 📂 Project Structure (Important Files)
```swift
├── app/
│   ├── Filament/Resources/DocumentCategoryResource.php
│   ├── Filament/Pages/StakeholderDashboard.php
│   └── Models/
│       └── DocumentSubCategory.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/filament/pages/stakeholder-dashboard.blade.php
```

## 🛠️ Useful Commands
```bash
php artisan shield:install
php artisan make:filament-resource ModelName
php artisan make:filament-page StakeholderDashboard
```

## 📃 License
This project is open-sourced under the MIT license.

## ✍️ Author
Made with ❤️ by Rijalul Fikri
For the "Rekayasa Perangkat Lunak Lanjut" course project (2025)