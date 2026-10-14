BUS TICKET BOOKING SYSTEM - READY VERSION

1. Extract this folder into C:\xampp\htdocs\
2. Start Apache and MySQL in XAMPP Control Panel.
3. Open http://localhost/bus_booking_system/

The database, tables, and sample bus routes are created automatically on first visit. No manual SQL import is needed.

To enable admin: register an account, then in phpMyAdmin run:
UPDATE users SET role='admin' WHERE email='your-email@example.com';
Replace the email with the email you registered with, then log out and log in again.

Default XAMPP settings are used (MySQL user root, blank password). If your MySQL password is different, update db.php.
