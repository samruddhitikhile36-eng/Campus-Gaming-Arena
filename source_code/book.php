<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Station - Campus Gaming Arena</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">
    <div class="logo">🎮 Campus Gaming Arena</div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="book.php">Book a Station</a>
        <a href="view.php">Reservations</a>
    </div>
</nav>

<section class="form-section">

    <div class="section-heading">
        <span>RESERVE YOUR SLOT</span>
        <h1>Book a Gaming Station</h1>
        <p>Fill in your details and choose your gaming experience.</p>
    </div>

    <form action="save.php" method="POST" class="booking-form">

        <div class="form-grid">

            <div class="form-group">
                <label>Student Name</label>
                <input
                    type="text"
                    name="student_name"
                    maxlength="100"
                    required
                    placeholder="Enter your full name"
                >
            </div>

            <div class="form-group">
                <label>Roll Number</label>
                <input
                    type="text"
                    name="roll_number"
                    maxlength="30"
                    required
                    placeholder="Example: CSE101"
                >
            </div>

            <div class="form-group">
                <label>Department</label>
                <input
                    type="text"
                    name="department"
                    maxlength="100"
                    required
                    placeholder="Example: CSE"
                >
            </div>

            <div class="form-group">
                <label>Contact Number</label>
                <input
                    type="text"
                    name="contact_number"
                    maxlength="15"
                    required
                    placeholder="10 digit mobile number"
                >
            </div>

            <div class="form-group full">
                <label>Gaming Station</label>

                <select name="station_id" required>

                    <option value="">-- Select Station --</option>

<?php

require_once "config.php";

$stmt = $conn->prepare(
    "SELECT station_id, station_name, game_type, hourly_rate
     FROM stations
     WHERE status = 'Available'
     ORDER BY station_id"
);

$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()):

?>

                    <option value="<?= (int)$row["station_id"] ?>">
                        <?= htmlspecialchars($row["station_name"]) ?>
                        -
                        <?= htmlspecialchars($row["game_type"]) ?>
                        -
                        ₹<?= htmlspecialchars($row["hourly_rate"]) ?>/hr
                    </option>

<?php endwhile; ?>

                </select>
            </div>

            <div class="form-group">
                <label>Reservation Date</label>

                <input
                    type="date"
                    name="reservation_date"
                    min="<?= date('Y-m-d') ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Start Time</label>

                <input
                    type="time"
                    name="start_time"
                    required
                >
            </div>

            <div class="form-group">
                <label>Duration</label>

                <select name="duration" required>

                    <option value="">-- Select Duration --</option>
                    <option value="1">1 Hour</option>
                    <option value="2">2 Hours</option>
                    <option value="3">3 Hours</option>
                    <option value="4">4 Hours</option>

                </select>
            </div>

        </div>

        <button type="submit" class="btn primary submit-btn">
            🎮 Confirm Booking
        </button>

    </form>

</section>

<footer>
    <p>© 2026 Campus Gaming Arena</p>
</footer>

</body>
</html>
