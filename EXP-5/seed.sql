USE `01_flight_reservation_db`;
INSERT INTO flights (origin,destination,flight_date,cabin_class,fare,seats_available,flight_code) VALUES
('Chennai','Bengaluru','2026-12-05','Economy',4200,18,'SR101'), ('Chennai','Mumbai','2026-12-06','Economy',6100,22,'SR204'), ('Delhi','Chennai','2026-12-07','Business',14500,8,'SR315'), ('Bengaluru','Hyderabad','2026-12-08','Economy',3500,16,'SR420'), ('Mumbai','Delhi','2026-12-09','Premium Economy',8900,12,'SR509'), ('Chennai','Kochi','2026-12-10','Economy',2800,14,'SR612');
-- Admin user is created by visiting setup_admin.php after importing schema.sql and seed.sql.
