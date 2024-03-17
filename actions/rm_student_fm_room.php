<?php
// Include the connection file
include '../settings/connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];

    // Find the user_id in RoomBookings
    $selectQuery = "SELECT user_id, room_id FROM RoomBookings WHERE user_id = $student_id";
    $result = $con->query($selectQuery);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $room_id = $row['room_id'];

        // Update has_room to false in Users table
        $updateUserQuery = "UPDATE Users SET has_room = FALSE WHERE user_id = $user_id";
        $con->query($updateUserQuery);

        // Increase capacity by 1 and update is_available if necessary in Rooms table
        $updateRoomQuery = "UPDATE Rooms SET capacity = capacity + 1 WHERE room_id = $room_id";
        $con->query($updateRoomQuery);

        // Check if is_available field was false and make it true
        $checkRoomQuery = "SELECT is_available FROM Rooms WHERE room_id = $room_id";
        $checkResult = $con->query($checkRoomQuery);
        $roomRow = $checkResult->fetch_assoc();
        $is_available = $roomRow['is_available'];
        if (!$is_available) {
            $updateAvailabilityQuery = "UPDATE Rooms SET is_available = TRUE WHERE room_id = $room_id";
            $con->query($updateAvailabilityQuery);
        }

        // Remove entry from RoomBookings
        $deleteBookingQuery = "DELETE FROM RoomBookings WHERE user_id = $user_id";
        $con->query($deleteBookingQuery);

        // Redirect back to the page where the form was submitted from
        header('Location: ../admin/hall.php?message=Successful');
        exit();
    } else {
        // Redirect back to the page where the form was submitted from with an error message
        header('Location: ../admin/hall.php?message=unSuccessful');
        exit();
    }
} else {
    // Redirect back to the page where the form was submitted from with an error message
    header('Location: ../admin/hall.php?message=unSuccessful');
    exit();
}
?>
