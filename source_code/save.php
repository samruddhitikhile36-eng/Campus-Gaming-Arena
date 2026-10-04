<?php

require_once "config.php";

function clean($value) {
    return trim($value ?? "");
}

$student_name = clean($_POST["student_name"] ?? "");
$roll_number = clean($_POST["roll_number"] ?? "");
$department = clean($_POST["department"] ?? "");
$contact_number = clean($_POST["contact_number"] ?? "");

$station_id = filter_input(
    INPUT_POST,
    "station_id",
    FILTER_VALIDATE_INT
);

$duration = filter_input(
    INPUT_POST,
    "duration",
    FILTER_VALIDATE_INT
);

$reservation_date = clean($_POST["reservation_date"] ?? "");
$start_time = clean($_POST["start_time"] ?? "");

$errors = [];

if ($student_name === "" || strlen($student_name) > 100) {
    $errors[] = "Invalid student name.";
}

if ($roll_number === "" || strlen($roll_number) > 30) {
    $errors[] = "Invalid roll number.";
}

if ($department === "" || strlen($department) > 100) {
    $errors[] = "Invalid department.";
}

if (!preg_match('/^[0-9]{10}$/', $contact_number)) {
    $errors[] = "Contact number must contain exactly 10 digits.";
}

if (!$station_id) {
    $errors[] = "Please select a gaming station.";
}

if (!$duration || $duration < 1 || $duration > 4) {
    $errors[] = "Duration must be between 1 and 4 hours.";
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $reservation_date)) {
    $errors[] = "Invalid reservation date.";
}

if (!preg_match('/^\d{2}:\d{2}$/', $start_time)) {
    $errors[] = "Invalid start time.";
}

if (!empty($errors)) {

    http_response_code(400);

    echo "<h2>Booking Error</h2>";

    foreach ($errors as $error) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }

    echo '<p><a href="book.php">Go Back</a></p>';

    exit;
}

/*
    Get station price securely.
*/

$stmt = $conn->prepare(
    "SELECT station_name, hourly_rate
     FROM stations
     WHERE station_id = ?
     AND status = 'Available'"
);

$stmt->bind_param("i", $station_id);
$stmt->execute();

$result = $stmt->get_result();

$station = $result->fetch_assoc();

$stmt->close();

if (!$station) {
    exit("Selected gaming station is not available.");
}

$hourly_rate = (float)$station["hourly_rate"];

$total_amount = $hourly_rate * $duration;


/*
    Check duplicate booking.
*/

$stmt = $conn->prepare(
    "SELECT reservation_id
     FROM reservations
     WHERE station_id = ?
     AND reservation_date = ?
     AND start_time = ?
     AND status = 'Confirmed'"
);

$stmt->bind_param(
    "iss",
    $station_id,
    $reservation_date,
    $start_time
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $stmt->close();

    exit(
        "This station is already booked for the selected date and time."
    );
}

$stmt->close();


/*
    Secure INSERT using prepared statement.
*/

$stmt = $conn->prepare(
    "INSERT INTO reservations
    (
        student_name,
        roll_number,
        department,
        station_id,
        reservation_date,
        start_time,
        duration,
        contact_number,
        total_amount,
        status
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Confirmed')"
);

$stmt->bind_param(
    "sssissisd",
    $student_name,
    $roll_number,
    $department,
    $station_id,
    $reservation_date,
    $start_time,
    $duration,
    $contact_number,
    $total_amount
);

if (!$stmt->execute()) {

    error_log("Reservation insert failed: " . $stmt->error);

    http_response_code(500);

    exit("Unable to save booking.");
}

$reservation_id = $stmt->insert_id;

$stmt->close();

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Booking Confirmed</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="confirmation">

    <div class="success-icon">✓</div>

    <span class="badge">BOOKING CONFIRMED</span>

    <h1>Your Gaming Slot is Booked!</h1>

    <p>Get ready to play and have fun.</p>

    <div class="booking-details">

        <p>
            <strong>Booking ID:</strong>
            <?= (int)$reservation_id ?>
        </p>

        <p>
            <strong>Student:</strong>
            <?= htmlspecialchars($student_name) ?>
        </p>

        <p>
            <strong>Station:</strong>
            <?= htmlspecialchars($station["station_name"]) ?>
        </p>

        <p>
            <strong>Date:</strong>
            <?= htmlspecialchars($reservation_date) ?>
        </p>

        <p>
            <strong>Time:</strong>
            <?= htmlspecialchars($start_time) ?>
        </p>

        <p>
            <strong>Duration:</strong>
            <?= (int)$duration ?> hour(s)
        </p>

        <p class="amount">
            Total Amount: ₹<?= number_format($total_amount, 2) ?>
        </p>

    </div>

    <div class="hero-buttons">

        <a href="index.php" class="btn secondary">
            Home
        </a>

        <a href="view.php" class="btn primary">
            View Reservations
        </a>

    </div>

</div>

</body>

</html>
