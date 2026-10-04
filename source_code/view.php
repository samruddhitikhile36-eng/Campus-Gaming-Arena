<?php

require_once "config.php";

$search = trim($_GET["search"] ?? "");

if ($search !== "") {

    $like = "%" . $search . "%";

    $stmt = $conn->prepare(
        "SELECT
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
         ON r.station_id = s.station_id
         WHERE
            r.student_name LIKE ?
            OR r.roll_number LIKE ?
            OR s.station_name LIKE ?
         ORDER BY r.reservation_id DESC"
    );

    $stmt->bind_param(
        "sss",
        $like,
        $like,
        $like
    );

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $stmt = $conn->prepare(
        "SELECT
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
         ON r.station_id = s.station_id
         ORDER BY r.reservation_id DESC"
    );

    $stmt->execute();

    $result = $stmt->get_result();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reservations</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar">

    <div class="logo">
        🎮 Campus Gaming Arena
    </div>

    <div class="nav-links">

        <a href="index.php">Home</a>

        <a href="book.php">Book a Station</a>

        <a href="view.php">Reservations</a>

    </div>

</nav>

<section class="section">

    <div class="section-heading">

        <span>BOOKING MANAGEMENT</span>

        <h1>Gaming Reservations</h1>

        <p>
            Search, view and cancel your reservations.
        </p>

    </div>

    <form method="GET" class="search-box">

        <input
            type="text"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
            placeholder="Search by student, roll number or station..."
        >

        <button class="btn primary" type="submit">
            🔎 Search
        </button>

        <a href="view.php" class="btn secondary">
            Reset
        </a>

    </form>

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Student</th>
                    <th>Roll No.</th>
                    <th>Department</th>
                    <th>Station</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Duration</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

<?php if ($result->num_rows > 0): ?>

<?php while ($row = $result->fetch_assoc()): ?>

                <tr>

                    <td>
                        #<?= (int)$row["reservation_id"] ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row["student_name"]) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row["roll_number"]) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row["department"]) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row["station_name"]) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row["reservation_date"]) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row["start_time"]) ?>
                    </td>

                    <td>
                        <?= (int)$row["duration"] ?> hr
                    </td>

                    <td>
                        ₹<?= number_format($row["total_amount"], 2) ?>
                    </td>

                    <td>

<?php if ($row["status"] === "Confirmed"): ?>

                        <span class="status confirmed">
                            Confirmed
                        </span>

<?php else: ?>

                        <span class="status cancelled">
                            Cancelled
                        </span>

<?php endif; ?>

                    </td>

                    <td>

<?php if ($row["status"] === "Confirmed"): ?>

                        <form
                            action="cancel.php"
                            method="POST"
                            onsubmit="return confirm('Cancel this reservation?');"
                        >

                            <input
                                type="hidden"
                                name="reservation_id"
                                value="<?= (int)$row["reservation_id"] ?>"
                            >

                            <button
                                type="submit"
                                class="cancel-btn"
                            >
                                Cancel
                            </button>

                        </form>

<?php else: ?>

                        —

<?php endif; ?>

                    </td>

                </tr>

<?php endwhile; ?>

<?php else: ?>

                <tr>

                    <td colspan="11" class="empty">
                        No reservations found.
                    </td>

                </tr>

<?php endif; ?>

            </tbody>

        </table>

    </div>

</section>

<footer>

    <p>
        © 2026 Campus Gaming Arena
    </p>

</footer>

</body>

</html>
