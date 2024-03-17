<?php
// Include the connection file
include '../settings/connection.php';

// Check if request_id is set in the POST request
if(isset($_POST['request_id'])) {
    // Sanitize the input
    $request_id = mysqli_real_escape_string($con, $_POST['request_id']);

    // Update the is_resolved field in the database
    $updateQuery = "UPDATE Requests SET is_resolved = FALSE WHERE request_id = '$request_id'";
    $result = $con->query($updateQuery);

    // Check if the update was successful
    if ($result) {
        // Send a success response
        echo json_encode(array('success' => true));
    } else {
        // Send an error response
        echo json_encode(array('success' => false));
    }
} else {
    // Send an error response if request_id is not set
    echo json_encode(array('success' => false, 'message' => 'Request ID is not set.'));
}
?>
