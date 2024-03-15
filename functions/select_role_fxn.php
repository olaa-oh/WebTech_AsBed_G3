<?php
// Include the connection file
include '../settings/connection.php';

// SELECT query on the “family_name” table
$query = "SELECT * FROM Roles";

// Execute the query using the connection
$result = $con->query($query);

// Check if execution worked
if (!$result) {
    die("Query execution failed: " . $con->error);
}

// Fetch the results
$roles = [];
while ($row = $result->fetch_assoc()) {
    // Store the fetched results in an array
    $roles[] = $row;
}


// Close the connection
// $con->close();
?>
