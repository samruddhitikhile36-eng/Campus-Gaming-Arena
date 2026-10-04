<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Gaming Arena</title>
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

<section class="hero">

    <div class="hero-content">
        <span class="badge">CAMPUS GAMING HUB</span>

        <h1>Play. Compete.<br><span>Have Fun.</span></h1>

        <p>
            Reserve your favorite gaming station on campus
            and enjoy an unforgettable gaming experience.
        </p>

        <div class="hero-buttons">
            <a href="book.php" class="btn primary">🎮 Book Your Slot</a>
            <a href="view.php" class="btn secondary">🔎 View Reservations</a>
        </div>
    </div>

    <div class="hero-card">
        <div class="controller">🎮</div>
        <h3>Game On!</h3>
        <p>Your next gaming session starts here.</p>
    </div>

</section>

<section class="section">

    <div class="section-heading">
        <span>OUR ARENA</span>
        <h2>Choose Your Gaming Station</h2>
        <p>Something exciting for every type of gamer.</p>
    </div>

    <div class="station-grid">

<?php

require_once "config.php";

$sql = "SELECT station_id, station_name, game_type, location, hourly_rate, status
        FROM stations
        ORDER BY station_id";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0):

    while ($station = $result->fetch_assoc()):

?>

        <div class="station-card">

            <div class="station-icon">
                <?php
                $icons = [
                    "Console Gaming" => "🎮",
                    "Racing" => "🏎️",
                    "Virtual Reality" => "🥽",
                    "PC Gaming" => "🖥️",
                    "Arcade" => "🕹️",
                    "Sports Gaming" => "⚽"
                ];

                echo $icons[$station["game_type"]] ?? "🎯";
                ?>
            </div>

            <div class="station-category">
                <?= htmlspecialchars($station["game_type"]) ?>
            </div>

            <h3>
                <?= htmlspecialchars($station["station_name"]) ?>
            </h3>

            <p>
                📍 <?= htmlspecialchars($station["location"]) ?>
            </p>

            <div class="station-bottom">

                <strong>
                    ₹<?= htmlspecialchars($station["hourly_rate"]) ?>/hr
                </strong>

                <?php if ($station["status"] === "Available"): ?>

                    <span class="available">● Available</span>

                <?php else: ?>

                    <span class="maintenance">● Maintenance</span>

                <?php endif; ?>

            </div>

        </div>

<?php

    endwhile;

else:

?>

        <p>No gaming stations available.</p>

<?php endif; ?>

    </div>

</section>

<section class="feature-section">

    <div class="feature">
        <div>⚡</div>
        <h3>Quick Booking</h3>
        <p>Reserve your station in just a few clicks.</p>
    </div>

    <div class="feature">
        <div>🔐</div>
        <h3>Secure System</h3>
        <p>Bookings are protected using prepared SQL statements.</p>
    </div>

    <div class="feature">
        <div>💰</div>
        <h3>Instant Pricing</h3>
        <p>Your total booking amount is calculated automatically.</p>
    </div>

</section>

<footer>
    <p>© 2026 Campus Gaming Arena | DBMS Secure Hosted Mini Project</p>
</footer>

</body>
</html>
