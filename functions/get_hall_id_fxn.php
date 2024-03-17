<?php
// Include the connection file
include '../settings/connection.php';

function search_hall_id($hall_name, $capacity) {
    global $con;

    // Prepare and execute the SQL query to search for the hall_id
    $searchQuery = "SELECT hall_id FROM Halls WHERE hall_name = ? AND capacity = ?";
    $statement = $con->prepare($searchQuery);
    $statement->bind_param("si", $hall_name, $capacity);
    $statement->execute();
    $result = $statement->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Fetch the hall_id from the result
        $row = $result->fetch_assoc();
        $hall_id = $row['hall_id'];
        return $hall_id;
    } else {
        // Hall not found
        return null;
    }

    // Close the statement
    $statement->close();
}
?>
