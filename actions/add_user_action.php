<?php
// Include the connection file
include '../settings/connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];

    // Check if the email already exists in the Admin table
    $query = "SELECT * FROM Admin WHERE email = '$email'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        // Email already exists in the Admin table
        echo "Email already exists in the Admin table.";
    } else {
        // Check if the email already exists in the Manager table
        $query = "SELECT * FROM Manager WHERE email = '$email'";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            // Email already exists in the Manager table
            echo "Email already exists in the Manager table.";
        } else {
            // Insert the email into the appropriate table based on the role_id
            $role_id = $_POST['role_id'];

            if ($role_id == 1) {
                // Insert into Admin table
                $query = "INSERT INTO Admin (email) VALUES ('$email')";
            } elseif ($role_id == 2) {
                // Insert into Manager table
                $query = "INSERT INTO Manager (email) VALUES ('$email')";
            } else {
                // Invalid role_id
                echo "Invalid role_id.";
                exit(); // Stop further execution
            }

            // Execute the query
            if ($con->query($query) === TRUE) {
                // Redirect back to the user management dashboard
                echo "successfully added";
                // header("Location: ../admin/dashboard.php");
                // exit();
            } else {
                // Display error message if the query fails
                echo "Error: " . $query . "<br>" . $con->error;
                echo "<script type='text/javascript'>alert('Error: " . $query . "<br>" . $con->error . "')</script>";

            }
        }
    }
}
?>
