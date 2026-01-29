# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-01-29
### Added
- **Docker**: Full environment with `docker-compose.yml` (Nginx, PHP 8.2, MySQL 8.0) and profiles support (`dev`).
- **Composer**: Dependency management initialized.
- **Blade Engine**: View system replaced with Laravel Blade (`jenssegers/blade`).
- **Medoo ORM**: Database abstraction layer (`catfan/medoo`).
- **Console Interface**: Full Artisan-style CLI (`mini`/`artisan`) based on `symfony/console`.
    - Commands: `make:controller`, `make:model`, `make:service`, `make:view`, `make:migration`, `clear:cache`.
- **System Architecture**:
    - Standardization to PascalCase and English naming conventions.
    - New layers: `App\Services`, `App\Observers`, `App\Listeners`.
    - Event Manager logic.
- **Security**:
    - Environment variables via `.env` (credentials removed from code).
    - Authentication library (`delight-im/auth`).
    - `.gitignore` configured to exclude sensitive files.

### Changed
- Converted `system/model.php` to use Medoo.
- Refactored `system/system.php` (Router) to support new naming conventions.
- Renamed all controllers and models to English/PascalCase.

## [0.2.0] - 2026-01-26
### Security
- **CRITICAL**: Fix SQL Injection vulnerability in `system/model.php` by implementing Prepared Statements (PDO).
- Remove hardcoded database credentials from the code; implement external configuration file (`app/config.php`).

### Fixed
- Update Autoload system (deprecated `__autoload`) to `spl_autoload_register` to support PHP 8.0+.
- Fix syntax error in `app/models/Produtos_Model.php` (missing semicolon).
- Correct API usage examples in `app/controllers/produtosController.php`.

### Added
- Created `app/config.php` for environment configuration. Note: `system/model.php` now depends on constants defined here.

## [0.1.0] - Current Version (Legacy)
### Added
- Basic manual MVC structure (`System`, `Model`, `Controller`).
- Simple routing via URL Rewrite (`controller/action/param/value`).
- PDO connection with MySQL.
- Basic CRUD operations (`insert`, `read`, `update`, `delete`) in the base Model class.
- View helpers with variable `extract` method.

### Known Issues
- **Vulnerability**: Model class methods concatenate SQL strings directly, allowing SQL injection.
- **Deprecation**: Use of magic function `__autoload`, removed in PHP 8.
- **Configuration**: Database credentials (root/root) hardcoded in the source code.
