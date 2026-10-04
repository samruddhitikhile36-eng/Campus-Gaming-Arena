# Campus Gaming Arena

Gaming Station Reservation System

## Technologies

HTML
CSS
PHP
MySQL
phpMyAdmin
XAMPP
InfinityFree

## Local URL

http://localhost/Campus-Gaming-Arena/

## Database

campus_gaming_arena

## Main Tables

stations
reservations

## Main Features

- View gaming stations
- Book gaming station
- Automatic price calculation
- MySQL INSERT
- MySQL SELECT
- JOIN
- Search
- Cancel booking
- MySQL UPDATE
- Input validation
- Prepared statements
- XSS-safe output

## Local Configuration

Edit config.php and enter your own local MySQL password.

Never upload a config.php containing a real password.

For submission, use the sanitized configuration file.

## Hosting

Upload the PHP project to InfinityFree public_html.

Create the MySQL database from the InfinityFree control panel.

Update config.php with the hosting database hostname, database username, database password and database name.

Import database.sql using phpMyAdmin.

Test the hosted URL in an Incognito browser window.

## Security

The application uses:

- Prepared statements
- Parameter binding
- Server-side validation
- htmlspecialchars()
- Error logging
- Foreign keys
- Duplicate booking checks
