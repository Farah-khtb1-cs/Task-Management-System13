# Task Management System

**Task Management System** is a comprehensive web-based solution designed to enhance organizational efficiency by streamlining workforce and task management. It provides administrators and employees with a centralized platform to manage tasks, attendance, skills, and performance through role-based access and skill-based task assignment.

## 🚀 Features

- **Role-Based Access Control**: Admin and Employee roles with appropriate permissions
- **Task Management**: Create, assign, accept/reject, and track task status in real-time
- **Skill-Based Assignment**: Match tasks to employees based on skills and proficiency levels
- **Attendance Tracking**: Clock in/out functionality with duration calculations and history
- **Performance Analytics**: Comprehensive reporting and statistics for informed decision-making
- **Responsive Design**: Mobile-friendly interface that works across all devices
- **Security**: Session-based authentication with audit trails and access controls

## 🛠️ Tech Stack

- **Backend**: PHP 7.4+ with PDO for database interactions
- **Database**: MySQL 5.6+ with comprehensive relational schema
- **Frontend**: Bootstrap 3.3.7, jQuery 3.2.1, Bootstrap Datepicker, Flatpickr
- **Server**: Compatible with Apache, Nginx, or PHP built-in server

## 📁 Project Structure

```
Task-Management-System/
├── Employee-taskms-PHP/          # Main application directory
│   ├── DATABASE FILE/
│   │   └── etmsh.sql            # MySQL database dump
│   ├── setup_database.sh        # Database setup script
│   ├── classes/
│   │   └── admin_class.php      # Database connection and core functions
│   ├── assets/                  # CSS, JS, fonts, and UI assets
│   ├── include/                 # Shared headers, footers, and UI components
│   ├── index.php               # Login page (application entry point)
│   ├── task-info.php           # Main dashboard and task management
│   ├── attendance-info.php     # Attendance tracking interface
│   └── task-statistics.php     # Analytics and reporting
├── PHPReport.pdf               # Comprehensive project documentation
└── DBReport.pdf                # Database design and architecture
```

## 📋 Requirements

- **PHP**: Version 7.4 or newer with PDO MySQL extension
- **Database**: MySQL 5.6+ or MariaDB equivalent
- **Web Server**: Apache, Nginx, or PHP built-in server for development
- **Browser**: Modern web browser with JavaScript enabled

## ⚡ Quick Start

### 1. Clone the Repository
```bash
git clone <repository-url>
cd Task-Management-System/Employee-taskms-PHP
```

### 2. Database Setup

#### Option A: Automated Setup (Linux/macOS)
```bash
# Edit credentials in setup_database.sh if needed
bash setup_database.sh
```

#### Option B: Manual Setup
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE etmsh CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Import schema and data
mysql -u root -p etmsh < "DATABASE FILE/etmsh.sql"
```

### 3. Configure Database Connection
Edit `classes/admin_class.php` with your MySQL credentials:
```php
$host_name = 'localhost';
$user_name = 'root';        // Your MySQL username
$password  = '';            // Your MySQL password
$db_name   = 'etmsh';       // Database name
```

### 4. Run the Application

#### Development Server
```bash
php -S localhost:8000
# Access at http://localhost:8000
```

#### Production Server
Configure your web server document root to point to the `Employee-taskms-PHP/` directory.

## 🔐 Default Login Credentials

| Role | Username | Password |
|------|----------|----------|
| **Admin** | `admin` | `codeastro` |
| **Employee** | `logan` | `password` |
| **Employee** | `christine` | `password` |

**Note**: Change default credentials before production deployment. New employee passwords are generated automatically and displayed in the "Manage User" section.

## 🎯 Key Features Overview

### For Administrators
- **Employee Management**: Add, edit, and manage employee profiles
- **Task Assignment**: Create and assign tasks based on employee skills
- **Performance Monitoring**: Track task completion rates and employee productivity
- **Skills Management**: Define and track employee skill sets and proficiency levels
- **Reporting Dashboard**: Generate comprehensive analytics and reports

### For Employees
- **Task Dashboard**: View assigned tasks with priorities and deadlines
- **Task Management**: Accept, reject, and update task status
- **Attendance Logging**: Simple clock in/out functionality
- **Skill Profile**: View and update personal skill information
- **Performance Tracking**: Monitor personal productivity metrics

## 🔧 System Architecture

### Database Design
- **Users Table**: Employee information and authentication
- **Tasks Table**: Task details, assignments, and status tracking
- **Skills Table**: Skill definitions and proficiency mapping
- **Attendance Table**: Time tracking and attendance records
- **Audit Tables**: System logs and change tracking

### Security Features
- Session-based authentication with timeout management
- Role-based access control for feature restrictions
- SQL injection prevention through PDO prepared statements
- Input validation and sanitization
- Audit trail for system changes and user actions

## 🧪 Testing

### Essential Test Cases
- User authentication and authorization
- Task creation, assignment, and status updates
- Attendance tracking accuracy
- Skills-based task matching
- Report generation and data accuracy
- Cross-browser compatibility
- Mobile responsiveness

## ⚠️ Important Notes

### Security Considerations
- **Password Security**: Current implementation uses MD5. For production, upgrade to `password_hash()` and `password_verify()`
- **Session Hardening**: Implement additional session security measures for production
- **Default Credentials**: Change all default passwords before deployment
- **Database Security**: Use strong MySQL credentials and restrict database access

### Dependencies
- Flatpickr assets load via CDN (internet connection required)
- Bootstrap and jQuery assets included locally
- Consider bundling CDN assets locally for offline environments

## 📊 Performance Optimization

- Database indexing on frequently queried columns
- Pagination for large data sets
- AJAX implementation for real-time updates
- Responsive design optimized for mobile devices
- Efficient query optimization using PDO prepared statements

## 🤝 Development Team

- **Farah El Khatib** - Lead Developer
- **Hadi Baghdadi** - Backend Developer  
- **Bahaa Mezhir** - Database Architect

*Original framework foundation by Sabbir Hossain*

## 📝 Documentation

- **PHPReport.pdf**: Comprehensive project documentation and technical specifications
- **DBReport.pdf**: Database design, schema documentation, and relationship diagrams
- **Code Comments**: Inline documentation throughout the codebase

## 🔄 Future Enhancements

- **API Development**: RESTful API for mobile applications
- **Advanced Reporting**: More detailed analytics and custom report generation
- **Notification System**: Email and in-app notifications for task updates
- **File Management**: Document attachment and file sharing capabilities
- **Integration Options**: Calendar integration and third-party service connections

---

**Task Management System** provides a modern, secure, and scalable solution for organizations seeking to improve workforce management and operational efficiency through automated task delegation and performance tracking.
