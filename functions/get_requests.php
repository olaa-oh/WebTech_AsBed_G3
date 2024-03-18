<?php
// Include the connection file
include '../settings/connection.php';

// Fetch all users from the database
$selectQuery = "SELECT * FROM Requests ORDER BY title ASC" ;
$result = $con->query($selectQuery);

// Display chore data in a tabular form
if ($result->num_rows > 0) {
   return $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    return $requests = [];
}
