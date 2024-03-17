<?php
// Include the connection file
include '../settings/connection.php';

// Fetch all users from the database
$selectQuery = "SELECT * FROM Users WHERE has_room = TRUE AND role_id='3' ORDER BY username ASC";
$result = $con->query($selectQuery);

// Display chore data in a tabular form
if ($result->num_rows > 0) {
   return $userswithrooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    return $userswithrooms = [];
}
