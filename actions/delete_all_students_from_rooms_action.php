<?php
// Include the connection file
include '../settings/connection.php';

// Check if the RoomBookings table exists
$checkTableQuery = "SHOW TABLES LIKE 'RoomBookings'";
$tableExists = $con->query($checkTableQuery);

if ($tableExists->num_rows > 0) {
    // Fetch all bookings from the RoomBookings table
    $selectBookingsQuery = "SELECT * FROM RoomBookings";
    $bookingsResult = $con->query($selectBookingsQuery);

    if ($bookingsResult->num_rows > 0) {
        // Loop through each booking
        while ($booking = $bookingsResult->fetch_assoc()) {
            // Retrieve student_id and room_id from the booking
            $studentId = $booking['user_id'];
            $roomId = $booking['room_id'];

            // Update the Rooms table to mark the room as available
            $updateRoomQuery = "UPDATE Rooms SET is_available = TRUE, capacity = capacity + 1 WHERE room_id = '$roomId'";
            if (!$con->query($updateRoomQuery)) {
                echo "Error updating Rooms table: " . $con->error;
                exit;
            }

            // Update the Users table to set has_room to false for the student
            $updateUserQuery = "UPDATE Users SET has_room = FALSE WHERE user_id = '$studentId'";
            if (!$con->query($updateUserQuery)) {
                echo "Error updating Users table: " . $con->error;
                exit;
            }
        }

        // Delete all entries from the RoomBookings table
        $deleteBookingsQuery = "TRUNCATE TABLE RoomBookings";
        if (!$con->query($deleteBookingsQuery)) {
            echo "Error deleting entries from RoomBookings table: " . $con->error;
            echo "Error deleting entries from RoomBookings table: " . $con->error;
            exit;
        }
        echo "All students' room bookings have been deleted successfully.";
        header("Location: ../admin/hall.php?message=All students' room bookings have been deleted successfully.");
        exit();
    } else {
        echo "No bookings found in the RoomBookings table.";
        header("Location: ../admin/hall.php?message=No bookings found in the RoomBookings table.");
        exit();
    }
} else {
    echo "RoomBookings table does not exist.";
    header("Location: ../admin/hall.php?message=RoomBookings table does not exist.");
    die();
}

// Close the database connection
$con->close();
?>
