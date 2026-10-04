<?php

require_once "config.php";

$id = filter_input(
    INPUT_POST,
    "reservation_id",
    FILTER_VALIDATE_INT
);

if (!$id) {
    exit("Invalid reservation ID.");
}

$stmt = $conn->prepare(
    "UPDATE reservations
     SET status = 'Cancelled'
     WHERE reservation_id = ?
     AND status = 'Confirmed'"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$stmt->close();

header("Location: view.php");

exit;

?>
