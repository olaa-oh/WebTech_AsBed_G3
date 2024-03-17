<?php
// Start session
session_start();

// Include the connection file
include_once '../settings/connection.php';

// Check if login button was clicked
if (!isset($_POST['signinBtn'])) {
    // Redirect to login page with appropriate message
    header("Location: ../login_view.php?error=login_button_not_clicked");
    exit();
} else {
    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Write a query to SELECT a record from the people table using the email
    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any row was returned
    if ($result->num_rows == 0) {
        // Redirect to login page with appropriate message
        header("Location: ../login/login_view.php?error=user_not_registered");
        exit();
    } else {
        // Fetch the record
        $row = $result->fetch_assoc();

        // Verify password
        if (!password_verify($password, $row['password'])) {
            // Redirect to login page with appropriate message
            header("Location: ../login/login_view.php?error=incorrect_password");
            exit();
        } else {
            // Create session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            // Redirect to homepage
            header("Location: ../view/home.php");
            exit();
        }
    }
}
?>
