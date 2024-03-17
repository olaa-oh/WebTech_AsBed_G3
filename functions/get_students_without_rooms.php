<?php
// Include the connection file
include '../settings/connection.php';

// Fetch all users from the database
$selectQuery = "SELECT username FROM Users WHERE has_room = FALSE AND role_id = 3 ORDER BY username ASC";
$result = $con->query($selectQuery);

// Display chore data in a tabular form
if ($result->num_rows > 0) {
   return $userswithoutrooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    return $userswithoutrooms = [];
}
