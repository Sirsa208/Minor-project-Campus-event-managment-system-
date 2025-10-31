-- Campus Event Management System Database Schema

-- Create database
CREATE DATABASE IF NOT EXISTS campus_events;
USE campus_events;

-- Table for users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    role ENUM('student', 'faculty', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for events
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    event_date DATETIME NOT NULL,
    location VARCHAR(200) NOT NULL,
    organizer VARCHAR(100) NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Table for event registrations
CREATE TABLE event_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    UNIQUE KEY unique_registration (user_id, event_id)
);

-- Insert sample data
INSERT INTO users (username, email, password, first_name, last_name, role) VALUES
('admin', 'admin@college.edu', '$2y$10$examplehash', 'Admin', 'User', 'admin'),
('john_doe', 'john@student.college.edu', '$2y$10$examplehash', 'John', 'Doe', 'student'),
('jane_smith', 'jane@student.college.edu', '$2y$10$examplehash', 'Jane', 'Smith', 'student'),
('prof_williams', 'williams@college.edu', '$2y$10$examplehash', 'Prof', 'Williams', 'faculty');

INSERT INTO events (title, description, event_date, location, organizer, created_by) VALUES
('Tech Conference 2025', 'Join us for the biggest tech conference on campus featuring industry experts and workshops.', '2025-10-30 10:00:00', 'Main Auditorium', 'Computer Science Department', 4),
('Annual Cultural Fest', 'Celebrate diversity and creativity with performances, food, and cultural exhibitions.', '2025-11-05 14:00:00', 'Campus Ground', 'Cultural Committee', 1),
('Inter-College Sports', 'Compete in various sports tournaments and showcase your athletic skills.', '2025-11-12 08:00:00', 'Sports Complex', 'Sports Council', 1);

INSERT INTO event_registrations (user_id, event_id) VALUES
(2, 1),
(3, 1),
(2, 2);