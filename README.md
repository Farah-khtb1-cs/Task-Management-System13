## Task Management System (PHP + MySQL)

A web-based system to manage employees, tasks, skills, and attendance with role-based access. Built with PHP, MySQL, Bootstrap, and jQuery.

### Repository layout
- `FarahElKhatib108791_HadiBaghdadi109035_BahaaMezhir107667/Employee-taskms-PHP` — main PHP application
  - `DATABASE FILE/etmsh.sql` — MySQL dump (schema + seed data)
  - `setup_database.sh` — helper script to create DB and import dump
  - `classes/admin_class.php` — PDO DB connection (configure credentials here)
  - `assets/` — CSS, JS, fonts, and datepicker assets
  - `include/` — shared headers/footers/ui
- `PHPReport.pdf` — project write-up
- `DBReport.pdf` — database/report document

## Features
- **User roles**: Admin and Employee
- **Task management**: create, assign, accept/reject, status tracking
- **Skills**: track skills and proficiency; skill-based assignment
- **Attendance**: clock in/out, history, duration
- **Reporting**: task/attendance overviews and statistics
- **Security**: session-based auth, role-based access

## Tech stack
- **Backend**: PHP 7.4+ (PDO)
- **Database**: MySQL (default DB name: `etmsh`)
- **Frontend**: Bootstrap 3.3.7, jQuery 3.2.1, Bootstrap Datepicker, Flatpickr (via CDN)
- **Server**: PHP built-in server or Apache/Nginx

## Requirements
- PHP 7.4 or newer with PDO MySQL extension
- MySQL 5.6+ (or MariaDB)
- A web server (Apache/Nginx) or PHP built-in server

## Quick start

### 1) Clone
```bash
git clone <this-repo-url>
cd FarahElKhatib108791_HadiBaghdadi109035_BahaaMezhir107667/Employee-taskms-PHP
```

### 2) Create database and import data
Choose one option.

- Option A — script (Linux/macOS):
  1. Open `setup_database.sh` and adjust `DB_USER`, `DB_PASS` as needed.
  2. If your MySQL requires a password, add `-p` or `-p$DB_PASS` to the `mysql`/`mysqldump` commands inside the script. Example:
     - `mysql -u $DB_USER -p$DB_PASS -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;"`
     - `mysql -u $DB_USER -p$DB_PASS $DB_NAME < DATABASE\ FILE/etmsh.sql`
     - `mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_FILE`
  3. Run:
     ```bash
     bash setup_database.sh
     ```

- Option B — manual import:
  ```bash
  # Create DB (edit credentials as needed)
  mysql -u root -p -e "CREATE DATABASE etmsh CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

  # Import dump (directory name contains a space; quote or escape it)
  mysql -u root -p etmsh < 'DATABASE FILE/etmsh.sql'
  # or
  mysql -u root -p etmsh < DATABASE\ FILE/etmsh.sql
  ```

### 3) Configure DB connection
Edit `classes/admin_class.php` if your MySQL credentials differ from defaults:
```php
$host_name = 'localhost';
$user_name = 'root';
$password  = '';
$db_name   = 'etmsh';
```

### 4) Run the application
- PHP built-in server (dev):
  ```bash
  php -S localhost:8000
  ```
  Then open `http://localhost:8000/` (entrypoint is `index.php`).

- Apache/Nginx: point your document root to `Employee-taskms-PHP/`.

## Default credentials
From `01 LOGIN DETAILS & PROJECT INFO.txt`:
- **Admin**: `admin` / `codeastro`
- **Employee**: `logan` / `password`
- **Employee**: `christine` / `password`

Note: When creating a new employee, a temporary password is generated and shown under the "Manage User" section. Use that temp password for the first login.

## Key pages
- `index.php` — login
- `task-info.php` — main dashboard/tasks
- `attendance-info.php` — attendance
- `task-statistics.php` — stats/overview

## Notes and security
- Flatpickr assets load via CDN; an internet connection is required for those assets unless you bundle them locally.
- The codebase uses MD5 for password storage in places; for production, replace with `password_hash()`/`password_verify()` and add stronger session/cookie hardening.
- Change default credentials before deploying anywhere public.

## Credits
- Developed by: Farah El Khatib, Hadi Baghdadi, Bahaa Mezhir
- Original base/login details attribution noted as "Developed by Sabbir Hossain" inside project info file
- Frontend libraries: Bootstrap, jQuery, Bootstrap Datepicker, Flatpickr

## License
No license file was found in this repository. Treat as all rights reserved unless a license is added.
