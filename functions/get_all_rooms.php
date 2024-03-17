<?php
// Include the connection file
include '../settings/connection.php';

// Fetch all users from the database
$selectQuery = "SELECT * FROM Rooms WHERE hall_id = $hall_id ORDER BY room_id DESC";
$result = $con->query($selectQuery);

// Display chore data in a tabular form
if ($result->num_rows > 0) {
   return $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    return $rooms = [];
}

