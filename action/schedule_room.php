<?php
// Include the connection file
require_once 'connection.php';

// Handle POST request for updating room schedule
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_id']) && isset($_POST['start_time']) && isset($_POST['end_time'])) {
    $room_id = $_POST['room_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Prepare SQL statement
    $stmt = $conn->prepare("UPDATE Schedule SET start_time=?, end_time=? WHERE room_id=?");
    $stmt->bind_param("ssi", $start_time, $end_time, $room_id);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Room schedule updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

// Close database connection (if not already included in connection.php)
$conn->close();
?>
