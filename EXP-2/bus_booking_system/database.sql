CREATE DATABASE IF NOT EXISTS bus_booking_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bus_booking_db;
CREATE TABLE IF NOT EXISTS users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(150) NOT NULL UNIQUE,password VARCHAR(255) NOT NULL,phone VARCHAR(30),role ENUM('user','admin') NOT NULL DEFAULT 'user',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS buses(id INT AUTO_INCREMENT PRIMARY KEY,bus_name VARCHAR(120) NOT NULL,category VARCHAR(60) NOT NULL,source VARCHAR(100) NOT NULL,destination VARCHAR(100) NOT NULL,travel_date DATE NOT NULL,departure_time TIME NOT NULL,total_seats INT NOT NULL,available_seats INT NOT NULL,price DECIMAL(10,2) NOT NULL);
CREATE TABLE IF NOT EXISTS bookings(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,bus_id INT NOT NULL,passenger_name VARCHAR(100) NOT NULL,age INT NOT NULL,seat_no VARCHAR(10) NOT NULL,total_price DECIMAL(10,2) NOT NULL,status ENUM('Booked','Cancelled') DEFAULT 'Booked',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(bus_id) REFERENCES buses(id),UNIQUE KEY unique_active_seat (bus_id,seat_no,status));
INSERT IGNORE INTO buses(id,bus_name,category,source,destination,travel_date,departure_time,total_seats,available_seats,price) VALUES
(1,'Coastal Express','Volvo AC','Chennai','Bengaluru',DATE_ADD(CURDATE(),INTERVAL 1 DAY),'07:30:00',40,40,850),
(2,'Night Rider','Sleeper Coach','Chennai','Hyderabad',DATE_ADD(CURDATE(),INTERVAL 2 DAY),'21:00:00',36,36,1200),
(3,'City Connect','Seater Coach','Bengaluru','Mysuru',DATE_ADD(CURDATE(),INTERVAL 1 DAY),'10:00:00',40,40,350),
(4,'Southern Star','Volvo AC','Chennai','Coimbatore',DATE_ADD(CURDATE(),INTERVAL 3 DAY),'06:00:00',40,40,700);
-- Register a user in the website, then grant admin access:
-- UPDATE users SET role='admin' WHERE email='your-email@example.com';
