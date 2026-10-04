CREATE DATABASE IF NOT EXISTS campus_gaming_arena;

USE campus_gaming_arena;

CREATE TABLE IF NOT EXISTS stations (
    station_id INT AUTO_INCREMENT PRIMARY KEY,
    station_name VARCHAR(100) NOT NULL,
    game_type VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    hourly_rate DECIMAL(10,2) NOT NULL,
    status ENUM('Available','Maintenance') DEFAULT 'Available'
);

CREATE TABLE IF NOT EXISTS reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    roll_number VARCHAR(30) NOT NULL,
    department VARCHAR(100) NOT NULL,
    station_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    start_time TIME NOT NULL,
    duration INT NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('Confirmed','Cancelled') DEFAULT 'Confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_reservation_station
        FOREIGN KEY (station_id)
        REFERENCES stations(station_id)
);

INSERT INTO stations
(station_name, game_type, location, hourly_rate, status)
SELECT * FROM (
    SELECT 1, 'PlayStation Pro Arena', 'Console Gaming',
           'Gaming Room A', 100.00, 'Available'
) AS tmp
WHERE NOT EXISTS (
    SELECT station_id FROM stations WHERE station_id = 1
);

INSERT INTO stations
(station_name, game_type, location, hourly_rate, status)
SELECT * FROM (
    SELECT 2, 'Racing Simulator', 'Racing',
           'Gaming Room A', 150.00, 'Available'
) AS tmp
WHERE NOT EXISTS (
    SELECT station_id FROM stations WHERE station_id = 2
);

INSERT INTO stations
(station_name, game_type, location, hourly_rate, status)
SELECT * FROM (
    SELECT 3, 'VR Experience Pod', 'Virtual Reality',
           'Gaming Room B', 200.00, 'Available'
) AS tmp
WHERE NOT EXISTS (
    SELECT station_id FROM stations WHERE station_id = 3
);

INSERT INTO stations
(station_name, game_type, location, hourly_rate, status)
SELECT * FROM (
    SELECT 4, 'PC Esports Station', 'PC Gaming',
           'Gaming Room B', 120.00, 'Available'
) AS tmp
WHERE NOT EXISTS (
    SELECT station_id FROM stations WHERE station_id = 4
);

INSERT INTO stations
(station_name, game_type, location, hourly_rate, status)
SELECT * FROM (
    SELECT 5, 'Classic Arcade Corner', 'Arcade',
           'Gaming Room C', 80.00, 'Available'
) AS tmp
WHERE NOT EXISTS (
    SELECT station_id FROM stations WHERE station_id = 5
);

INSERT INTO stations
(station_name, game_type, location, hourly_rate, status)
SELECT * FROM (
    SELECT 6, 'Football Console Zone', 'Sports Gaming',
           'Gaming Room C', 100.00, 'Available'
) AS tmp
WHERE NOT EXISTS (
    SELECT station_id FROM stations WHERE station_id = 6
);

-- SELECT
SELECT * FROM stations;

-- JOIN
SELECT
    r.reservation_id,
    r.student_name,
    r.roll_number,
    r.department,
    s.station_name,
    s.game_type,
    r.reservation_date,
    r.start_time,
    r.duration,
    r.total_amount,
    r.status
FROM reservations r
JOIN stations s
ON r.station_id = s.station_id;

-- COUNT
SELECT COUNT(*) AS total_reservations
FROM reservations;

-- SUM
SELECT SUM(total_amount) AS total_revenue
FROM reservations
WHERE status = 'Confirmed';

-- SEARCH
SELECT
    r.reservation_id,
    r.student_name,
    s.station_name,
    r.status
FROM reservations r
JOIN stations s
ON r.station_id = s.station_id
WHERE r.student_name LIKE '%Samruddhi%';

-- UPDATE / CANCEL
-- Example:
-- UPDATE reservations
-- SET status = 'Cancelled'
-- WHERE reservation_id = 1;

