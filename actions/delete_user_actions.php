<?php
// Include the connection file
include '../settings/connection.php';

// Check if userId, role_id, and email are set and not empty
if (isset($_POST['userId']) && isset($_POST['role_id']) && isset($_POST['email']) && !empty($_POST['userId']) && !empty($_POST['role_id']) && !empty($_POST['email'])) {
    $userId = $_POST['userId'];

    // Prepare the delete statement for Users table
    $deleteQuery = "DELETE FROM users WHERE user_id = ?";
    // Prepare the delete statement for Admin table
    $deleteAd = "DELETE FROM Admin WHERE email = ?";
    // Prepare the delete statement for Manager table
    $deleteMn = "DELETE FROM Manager WHERE email = ?";

    // Check role_id to determine which table to delete from
    if ($_POST['role_id'] == 1) {
        // Delete from Admin table
        $stmt = $con->prepare($deleteAd);
    } elseif ($_POST['role_id'] == 2) {
        // Delete from Manager table
        $stmt = $con->prepare($deleteMn);
    } 

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $_POST['email']); // Assuming email is a string
    if ($stmt->execute()) {
        // If deletion from the role-specific table is successful, proceed to delete from the Users table
        $stmt->close();

        // Prepare and bind the statement for deleting from the Users table
        $stmt = $con->prepare($deleteQuery);
        $stmt->bind_param("i", $userId); // Assuming userId is an integer

        // Execute the statement
        if ($stmt->execute()) {
            $con->commit(); // Commit changes
            echo 'success';
        } else {
            echo 'error'; // Error deleting from Users table
        }
    } else {
        echo 'error'; // Error deleting from role-specific table
    }

    // Close the statement
    $stmt->close();
} else {
    // Missing required parameters
    echo 'missing_parameters';
}

// Close the connection
$con->close();
?>
