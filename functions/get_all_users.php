<?php
// Include the connection file
include '../settings/connection.php';

// Fetch all users from the database
$selectQuery = "SELECT * FROM Users";
$result = $con->query($selectQuery);

// Display chore data in a tabular form
if ($result->num_rows > 0) {
   return $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    return $users = [];
}

