# CAMPUS GAMING ARENA
## Gaming Station Reservation System

### DBMS Secure Hosted Mini Project

---

# 1. Introduction

Campus Gaming Arena is a web-based gaming station reservation system developed as a DBMS mini project.

The system allows students to view available gaming stations, reserve a station, view reservations, search bookings and cancel confirmed reservations.

The project demonstrates database connectivity using PHP and MySQL along with secure database operations.

---

# 2. Objectives

The objectives of the project are:

- Create a functional PHP and MySQL web application.
- Store gaming station information in MySQL.
- Store student reservation information in MySQL.
- Perform INSERT, SELECT and UPDATE operations.
- Demonstrate JOIN and search operations.
- Use prepared statements for secure SQL execution.
- Validate user input on the server.
- Escape output to prevent XSS.
- Deploy the application on a hosting platform.

---

# 3. Technologies Used

Frontend:

- HTML
- CSS

Backend:

- PHP

Database:

- MySQL

Database Management:

- phpMyAdmin

Local Server:

- XAMPP Apache

Hosting:

- InfinityFree

---

# 4. Database Design

Database name:

campus_gaming_arena

## Table: stations

Fields:

- station_id
- station_name
- game_type
- location
- hourly_rate
- status

## Table: reservations

Fields:

- reservation_id
- student_name
- roll_number
- department
- station_id
- reservation_date
- start_time
- duration
- contact_number
- total_amount
- status
- created_at

The station_id field in reservations is a foreign key referencing stations.

---

# 5. System Workflow

User opens the Campus Gaming Arena website.

↓

User views gaming stations.

↓

User opens Book a Station.

↓

User enters student and booking details.

↓

PHP validates the input.

↓

PHP retrieves the station price using a prepared statement.

↓

PHP checks whether the selected slot already exists.

↓

PHP inserts the reservation using a prepared statement.

↓

Booking confirmation is displayed.

↓

User can view and search reservations.

↓

User can cancel a confirmed reservation.

↓

The reservation status is updated to Cancelled.

---

# 6. Database Operations

The project demonstrates:

INSERT

SELECT

JOIN

WHERE

UPDATE

COUNT

SUM

Prepared statements are used for user-controlled database operations.

---

# 7. Security Implementation

## Prepared Statements

PHP mysqli prepared statements are used with ? placeholders and bind_param().

This prevents user input from being directly concatenated into SQL queries.

## Server-Side Validation

User inputs are validated on the server before database operations.

Examples include:

- Name length
- Roll number length
- Contact number format
- Station ID
- Duration
- Date
- Time

## Output Escaping

Database and user-generated values are displayed using htmlspecialchars().

This reduces the risk of Cross-Site Scripting.

## Error Handling

Database errors are logged using error_log() instead of displaying internal database information to users.

---

# 8. Security Testing

The application was tested using:

1. O'Reilly
2. <script>alert('XSS')</script>
3. Invalid phone number
4. Invalid duration
5. Invalid station ID
6. Duplicate booking
7. Invalid cancellation ID

The expected result is that invalid or malicious input is rejected or safely displayed.

---

# 9. Screenshots Required

The following screenshots should be captured:

1. Homepage
2. Gaming station cards
3. Booking form
4. Successful booking confirmation
5. MySQL reservations table
6. Reservations page
7. Search result
8. Cancelled booking
9. phpMyAdmin stations table
10. phpMyAdmin database structure
11. Security test
12. Hosted website
13. Hosted website in Incognito mode

---

# 10. Conclusion

Campus Gaming Arena successfully demonstrates a secure database-driven web application.

The project connects a PHP frontend/backend system with MySQL and performs practical database operations including insertion, retrieval, searching, joining and updating.

Security techniques such as prepared statements, server-side validation and output escaping are implemented to reduce common web application vulnerabilities.

The system can be extended in the future with student login, admin dashboard, online payments, email notifications and advanced slot management.

---

# 11. Future Scope

Possible future improvements include:

- Student login and registration
- Admin dashboard
- Payment gateway
- Email confirmation
- QR-based booking confirmation
- Real-time availability
- Booking history
- Analytics dashboard
- Mobile application
