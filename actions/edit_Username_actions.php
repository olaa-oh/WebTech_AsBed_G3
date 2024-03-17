<?php
// Include the connection file
include '../settings/connection.php';

// Check if choreId and choreName are set and not empty
if (isset($_POST['editNameBtn'])) {
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    echo $choreId;
    // Update chore in database
    $updateQuery = "UPDATE users SET username = '$userName' WHERE user_id = $userId";
    if ($con->query($updateQuery) === TRUE) {
        echo 'Chore updated successfully.';
        header("Location: ../admin/user.php?success=username_updated");
        exit();
    } else {
        echo 'Error updating chore: ' . $con->error;
        header("Location: ../admin/user.php?error=update_failed");
        die();
    }
} else {
    echo 'Name ID and name are required.';
    header('Location: ../admin/user.php?error=required_fields');
    die();
}
?>