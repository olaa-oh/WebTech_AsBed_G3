<?php
// Include the connection file
include '../settings/connection.php';

// Fetch all users from the database
$selectQuery = "SELECT * FROM RoomBookings ORDER BY booking_id ASC" ;
$result = $con->query($selectQuery);

// Display chore data in a tabular form
if ($result->num_rows > 0) {
   return $roomb = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    return $roomb = [];
}
