<?php
// Include the connection file
include '../settings/connection.php';

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $hallName = $_POST['hallName'];
    $capacity = $_POST['capacity'];
    $location = $_POST['location'];

    // Prepare the SQL statement to insert the new hall
    $insertQuery = "INSERT INTO Halls (hall_name, capacity, location, is_available) VALUES (?, ?, ?, ?)";
    
    // Default values for location and is_available can be set here
    $is_available = true; // Assuming all new halls are initially available

    // Prepare and bind parameters
    $statement = $con->prepare($insertQuery);
    $statement->bind_param("siss", $hallName, $capacity, $location, $is_available);
    
    // Execute the query
    if ($statement->execute()) {
        // Hall successfully added
        echo '<script type="text/javascript">alert("Hall added successfully.")</script>';
       header("Location: ../admin/halls.php");
        exit();
    } else {
        // Error occurred while adding hall
        echo "Error: " . $con->error;
    }

    // Close the statement
    $statement->close();
}

// Close the database connection
$con->close();
?>
