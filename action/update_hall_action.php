<?php
// Include the connection file
include '../settings/connection.php';

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $hall_id = $_POST['hall_id'];
    $hallName = $_POST['hallName'];
    $capacity = $_POST['capacity'];

    // Prepare the SQL statement to update the hall
    $updateQuery = "UPDATE Halls SET hall_name=?, capacity=? WHERE hall_id=?";
    
    // Prepare and bind parameters
    $statement = $con->prepare($updateQuery);
    $statement->bind_param("sii", $hallName, $capacity, $hall_id);
    
    // Execute the query
    if ($statement->execute()) {
        // Hall successfully updated
        echo '<script type="text/javascript">alert("Hall updated successfully.")</script>';
        header("Location: ../admin/hall.php?&hall_name=$hallName&capacity=$capacity");
        exit();
    } else {
        // Error occurred while updating hall
        echo "Error: " . $con->error;
    }

    // Close the statement
    $statement->close();
}

// Close the database connection
$con->close();
?>
