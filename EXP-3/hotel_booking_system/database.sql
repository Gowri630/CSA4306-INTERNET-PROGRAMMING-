CREATE DATABASE IF NOT EXISTS hotel_booking_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hotel_booking_db;
CREATE TABLE IF NOT EXISTS users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(150) NOT NULL UNIQUE,password VARCHAR(255) NOT NULL,phone VARCHAR(30),role ENUM('user','admin') NOT NULL DEFAULT 'user',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS rooms(id INT AUTO_INCREMENT PRIMARY KEY,room_type VARCHAR(80) NOT NULL,description TEXT,price DECIMAL(10,2) NOT NULL,quantity INT NOT NULL DEFAULT 1);
CREATE TABLE IF NOT EXISTS bookings(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,room_id INT NOT NULL,checkin DATE NOT NULL,checkout DATE NOT NULL,guests INT NOT NULL,total_price DECIMAL(10,2) NOT NULL,status ENUM('Booked','Cancelled') DEFAULT 'Booked',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(room_id) REFERENCES rooms(id));
INSERT IGNORE INTO rooms(id,room_type,description,price,quantity) VALUES
(1,'Standard Room','Comfortable room with Wi-Fi and essential amenities.',1500,10),
(2,'Deluxe Room','Larger room with air conditioning and breakfast.',2500,8),
(3,'Family Room','Spacious room for families and groups.',3500,5),
(4,'Suite','Premium room with a separate sitting area.',5000,3);
-- Create a normal account by registering in the website. To create an admin, register first, then run:
-- UPDATE users SET role='admin' WHERE email='your-email@example.com';
-- Demo admin password is not inserted as plain text; create admin using registration and update the role with the query above.
