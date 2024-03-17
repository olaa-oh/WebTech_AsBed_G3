<?php
// Include the connection file
include '../settings/connection.php';

// Fetch all users from the database
$selectQuery = "SELECT room_name FROM Rooms WHERE hall_id = $hall_id AND capacity >= 1 ORDER BY room_id DESC";
$result = $con->query($selectQuery);

// Display chore data in a tabular form
if ($result->num_rows > 0) {
   return $hroomsa = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    return $hroomsa = [];
}
