CREATE TABLE employee_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    skill VARCHAR(50) NOT NULL,
    proficiency_level ENUM('Beginner', 'Intermediate', 'Expert') DEFAULT 'Intermediate',
    INDEX (user_id)
) ENGINE=InnoDB;