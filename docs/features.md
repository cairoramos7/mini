# 📘 Mini Framework - Features Guide

This document details all components and resources available in this application.

## 🏗 Architecture
The system follows the **MVC (Model-View-Controller)** pattern but has been modernized with service and observability layers, separating responsibilities professionally.

- **Entry Point**: `public_html/index.php` (Frontend Controller).
- **Core**: `system/` (Router, Base Controller, Base Model).
- **App**: `app/` (Application Logic).

---

## 💻 Environment & Infrastructure
Ref: `docker-compose.yml`, `dk`, `Dockerfile`

- **Docker Full Stack**:
  - **Nginx** (Web Server).
  - **PHP 8.2 FPM** (Application).
  - **MySQL 8.0** (Database).
- **`dk` Wrapper**: Smart script that detects whether to run commands via Docker or locally.
- **Profiles**: Docker Compose profiles support (`dev`).

---

## 🛠 Command Line Tools (CLI)
Ref: `app/console/`, `mini`

Robust system based on **Symfony Console**.

### Generation Commands (`make:*`)
Speed up development by generating code skeletons:
- `make:controller`: Generates Controllers in `app/controllers`.
- `make:model`: Generates Models in `app/models`.
- `make:view`: Generates Blade Views in `app/views`.
- `make:service`: Generates business-logic Services.
- `make:observer`: Generates Observers to monitor Models.
- `make:listener`: Generates Listeners for Events.
- `make:migration`: Generates database migration files (Phinx).

### Utilities
- `clear:cache`: Clears Blade compiled views cache.
- `list`: Lists all available commands.

---

## 💾 Data Layer (Database)
Ref: `system/Model.php`, `phinx.php`

- **Medoo ORM**: Lightweight and secure abstraction for SQL queries. Natively protects against SQL Injection.
- **Base Model**:
  - Simplified CRUD (`insert`, `read`, `update`, `delete`).
  - **`$fillable` Protection**: Automatically filters allowed fields in insert/update for security.
- **Migrations**: Database version control using **Phinx**.

---

## 🎨 Visualization Layer (Frontend)
Ref: `app/views/`

- **Blade Template Engine**: The same powerful engine from Laravel.
  - Layouts support (`@extends`).
  - Sections (`@section`, `@yield`).
  - Control structures (`@if`, `@foreach`).
  - Automatic caching for performance.

---

## 🧠 Support Layers
Resources to keep Controllers skinny and code organized:

- **Services** (`app/services`): For complex business rules that don't belong in the Controller or Model.
- **Observers** (`app/observers`): To react to actions in Models (although automatic implementation needs to be linked to the event).
- **Listeners** (`app/listeners`): To process system events (e.g., Send email after registration).

---

## 🔒 Security
- **Environment (`.env`)**: Sensitive credentials are never committed to code.
- **Auth Library**: Integrated `delight-im/auth` library for complete user management (Login, Registration, Password Recovery).
- **Folder Structure**: `public_html` as the only web-exposed folder, protecting source code (`app/`, `vendor/`).
