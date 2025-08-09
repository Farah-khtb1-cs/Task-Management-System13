# Employee Task Management System

A comprehensive web-based system for managing employee tasks, attendance, and skills. Built with PHP and MySQL, this system provides an efficient way to track and manage employee work assignments and performance.

## Features

### User Management

- Two-level user system (Admin and Employee)
- Secure authentication and authorization
- Password management with encryption
- User profile management

### Task Management

- Create and assign tasks to employees
- Track task status (Incomplete, In Progress, Completed)
- Task assignment workflow (Accept/Reject tasks)
- Task details including title, description, start time, and end time
- Skill-based task assignment
- Task history and tracking

### Skills Management

- Track employee skills and proficiency levels
- Skill categories: Beginner, Intermediate, Expert
- Match tasks with employee skills
- Skill-based employee search and filtering

### Attendance System

- Clock In/Clock Out functionality
- Track attendance duration
- Attendance history
- Real-time attendance status

### Admin Features

- Add/Edit/Delete employees
- Manage employee skills
- View all task assignments
- Monitor attendance records
- System-wide reporting
- User role management

### Employee Features

- View assigned tasks
- Accept or reject task assignments
- Update task status
- Manage attendance (Clock In/Out)
- View personal task history
- Update skills and proficiency

### Security Features

- Password encryption
- Session management
- Role-based access control
- Secure authentication

### Interface

- Clean and intuitive user interface
- Responsive design
- Real-time updates
- Sortable and searchable tables
- Modal forms for data entry

## Technical Details

- Built with PHP 7.4+
- MySQL database
- PDO for database operations
- Bootstrap for frontend
- jQuery and JavaScript for dynamic features
- Flatpickr for datetime handling

## Database Structure

- User management tables
- Task management tables
- Attendance tracking tables
- Skills management tables
- Relational database design

## Installation

1. Clone the repository
2. Import the database file from `DATABASE FILE/etmsh.sql`
3. Configure database connection
4. Default admin credentials:
   - Username: admin
   - Password: [contact administrator]

## Requirements

- PHP 7.4 or higher
- MySQL 5.6 or higher
- Web server (Apache/Nginx)
- Modern web browser

## Security Considerations

- Password hashing implemented
- Input validation and sanitization
- Session security measures
- SQL injection prevention
- XSS protection
