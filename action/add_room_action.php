<?php
// Include the connection file
include '../settings/connection.php';

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $hallId = $_POST['hallId'];
    $roomName = $_POST['roomName'];
    $capacity = $_POST['roomCapacity'];

    // Prepare the SQL statement to insert the new room
    $insertQuery = "INSERT INTO Rooms (hall_id, room_name, capacity) VALUES (?, ?, ?)";
    
    // Prepare and bind parameters
    $statement = $con->prepare($insertQuery);
    $statement->bind_param("iss", $hallId, $roomName, $capacity);
    
    // Execute the query
    if ($statement->execute()) {
        // Room successfully added
        echo "success";
        header("Location: ../admin/hall.php?succ=Room added successfully.");
        exit();
    } else {
        // Error occurred while adding room
        echo "error";
    }

    // Close the statement
    $statement->close();
}

// Close the database connection
$con->close();
?>
