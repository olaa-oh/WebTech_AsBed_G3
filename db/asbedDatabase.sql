DROP DATABASE IF EXISTS asbedDatabase;
CREATE DATABASE IF NOT EXISTS asbedDatabase;
USE asbedDatabase;


-- Rooms Table
CREATE TABLE IF NOT EXISTS Halls (
    hall_id INT AUTO_INCREMENT PRIMARY KEY,
    hall_name varchar(225) NOT NULL,
    capacity INT NOT NULL,
    location varchar(225) NOT NULL,
    is_available BOOLEAN DEFAULT TRUE
);

-- Roles Table
CREATE TABLE IF NOT EXISTS Roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(100) NOT NULL
);


-- Users Table
CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL unique,
    role_id INT,
	has_room BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

-- room and users

-- Bookings Table
-- CREATE TABLE IF NOT EXISTS Bookings (
--     booking_id INT AUTO_INCREMENT PRIMARY KEY,
--     user_id INT,
--     room_id INT,
--     start_time DATETIME,
--     end_time DATETIME,
--     FOREIGN KEY (user_id) REFERENCES Users(user_id),
--     FOREIGN KEY (room_id) REFERENCES Rooms(room_id)
-- );

-- Create a table for rooms in each hall
CREATE TABLE IF NOT EXISTS Rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    hall_id INT,
    room_name VARCHAR(100) NOT NULL unique,
    capacity INT NOT NULL,
    is_available BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (hall_id) REFERENCES Halls(hall_id)
);


-- Create a table for bookings in each room
CREATE TABLE IF NOT EXISTS RoomBookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT,
    user_id INT,
    FOREIGN KEY (room_id) REFERENCES Rooms(room_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Schedule Table
CREATE TABLE IF NOT EXISTS Schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    start_time DATETIME,
	end_time DATETIME,
    is_booked BOOLEAN DEFAULT FALSE
);


CREATE TABLE Announcements (
    announcement_id INT PRIMARY KEY,
    sentTo varchar(10),
    admin_id INT,
    announcement_text TEXT,
    date_posted DATE,
    FOREIGN KEY (admin_id) REFERENCES Users(user_id)
);

-- Requesting from Students --
CREATE TABLE IF NOT EXISTS Requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject varchar(225),
    request_text TEXT,
    request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_resolved BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (student_id) REFERENCES Users(user_id)
);

-- Add an Administrator-- 
CREATE TABLE IF NOT EXISTS Admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE
);

-- Add a Manager-- 
CREATE TABLE IF NOT EXISTS Manager (
    man_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE
);

-- Verifiable ID --
CREATE TABLE IF NOT EXISTS VerifiablePins (
    pin_id INT AUTO_INCREMENT PRIMARY KEY,
    pin VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserting sample roles-- 
INSERT INTO Roles (role_name) VALUES ('Admin'), ('Manager'), ('Student');


-- Inserting sample rooms
INSERT INTO Halls (hall_name, capacity, location, is_available) VALUES
    ('Odeefoo Oteng Korankye Hall', 50, 'On campus', TRUE),
	('Efua Sutherland', 50, 'On campus', TRUE),
	('Efram Amu', 50, 'On campus', TRUE),
	('Walter Sisulu', 50, 'On campus', TRUE),
	('Hall 2C', 50, 'On campus', TRUE),
	('Kofi Tawiah', 50, 'On campus', TRUE),
	('Hall K', 50, 'On campus', TRUE);

    
-- Inserting sample users
 INSERT INTO Users (username, password, email, role_id) VALUES
     ('Evans Kumi', '$2y$10$QrYHXXWIAhKGhC.0gr1tdeTKlt57tpkKVQ1G4j2rfzg/oJ7JbKiEC', 'kwakukumi14@gmail.com', 1);  -- Admin 
    -- ('teacher456', 'teacherpassword', 'teacher@example.com', 2),  -- Teacher
--     ('student789', 'studentpassword', 'student@example.com', 3);  -- Student


-- Insert into admin
INSERT INTO Admin (admin_id,email) VALUES
(1,'kwakukumi14@gmail.com');