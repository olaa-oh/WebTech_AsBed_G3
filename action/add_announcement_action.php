<?php
// Include the connection file
include '../settings/connection.php';

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $admin_id = $_SESSION['user_id']; // Assuming admin ID is stored in session
    $announcement_text = $_POST['announcement_text'];
    $date_posted = date("Y-m-d"); // Current date

    // Prepare the SQL statement to insert the announcement
    $insertQuery = "INSERT INTO Announcements (hall_id, announcement_text, date_posted) VALUES (?, ?, ?)";
    
    // Prepare and bind parameters
    $statement = $con->prepare($insertQuery);
    $statement->bind_param("iss", $admin_id, $announcement_text, $date_posted);
    
    // Execute the query
    if ($statement->execute()) {
        // Announcement successfully inserted
        echo "Announcement posted successfully.";
    } else {
        // Error occurred while inserting announcement
        echo "Error: " . $con->error;
    }

    // Close the statement
    $statement->close();
}

// Close the database connection
$con->close();
?>
