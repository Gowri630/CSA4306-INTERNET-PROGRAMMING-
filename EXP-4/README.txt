STAYEASE HOTEL BOOKING SYSTEM (PHP + MySQL)
Requirements: XAMPP, PHP, MySQL, browser.

INSTALLATION
1. Copy the hotel_booking_system folder into C:\xampp\htdocs\
2. Start Apache and MySQL in XAMPP.
3. Open http://localhost/phpmyadmin
4. Click Import and import database.sql, OR open SQL and run its contents.
5. Open http://localhost/hotel_booking_system/
6. Register an account and log in.
7. To make your account an administrator, run this in phpMyAdmin:
   USE hotel_booking_db;
   UPDATE users SET role='admin' WHERE email='your-email@example.com';
   Replace the email with the account you registered, then log out and log in again.
8. Open Admin from the navigation.

FEATURES
- Registration and login with hashed passwords
- Room types, prices and quantity
- Date-based room booking with basic availability checks
- Booking history and cancellation at least 3 days before check-in
- Admin room price/quantity management and booking cancellation
- Responsive layout and basic informational pages

LIMITATIONS
This is an educational lab demo. No real payment gateway or confirmation email is configured. Availability uses room-type inventory and a basic overlap count; it is not a production hotel inventory engine. Add server security, CSRF protection, stronger availability transactions, email and payment integration before real deployment.
