SkyRoute — PHP + MySQL Website
========================================================
Pages included:
1. index.php — distinct landing page and featured records
2. search.php — browse/search catalog
3. register.php — customer registration
4. login.php — login/logout session support
5. forgot_password.php — password-help page
6. book.php — booking/order form
7. payment.php — simulated payment step
8. my_bookings.php — personal dashboard/history
9. ticket.php — printable confirmation/receipt
10. cancel.php — cancel a booking
11. feedback.php — customer feedback
12. admin.php — admin dashboard
13. admin_report.php — summary report
14. setup_admin.php — one-time admin creation
Plus db.php, header.php, footer.php, style.css, schema.sql and seed.sql.

XAMPP setup:
1. Copy the complete project folder into C:\xampp\htdocs\
2. Start Apache and MySQL in XAMPP Control Panel.
3. Open http://localhost/phpmyadmin
4. Import schema.sql, then import seed.sql (each SQL file creates/uses its own database).
5. Open http://localhost/01_Flight_Reservation/setup_admin.php and create an admin account.
6. Delete setup_admin.php after admin creation.
7. Visit http://localhost/01_Flight_Reservation/

Default DB credentials in db.php: host localhost, user root, blank password.
If you have a MySQL password, update DB_PASS in db.php.

Important:
- Payments are simulated; no real payment gateway is connected.
- Emails/SMS are not sent; confirmation pages are local.
- Demo seed dates and prices can be changed in phpMyAdmin.
- This is a classroom starter, not a production system. Use HTTPS, stricter
  access controls, rate limiting, email verification, and tested payment integration
  before any public deployment.

Additional navigation pages: cart.php / orders.php / my_appointments.php (as applicable).
