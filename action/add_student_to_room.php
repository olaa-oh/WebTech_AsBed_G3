<?php
// Include the necessary files and initialize session
include '../settings/connection.php';
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and room name
    $username = $_POST['userInput'];
    $roomName = $_POST['room_name'];

    echo $username; 
    echo $roomName;

    // Search for the user_id based on the username
    $selectUserQuery = "SELECT user_id FROM Users WHERE username = '$username'";
    $userResult = $con->query($selectUserQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $userId = $userRow['user_id'];

        // Search for the room_id based on the room name
        $selectRoomQuery = "SELECT room_id FROM Rooms WHERE room_name = '$roomName'";
        $roomResult = $con->query($selectRoomQuery);

        if ($roomResult->num_rows > 0) {
            $roomRow = $roomResult->fetch_assoc();
            $roomId = $roomRow['room_id'];

            // Update the RoomBookings table
            $insertBookingQuery = "INSERT INTO RoomBookings (room_id, user_id) VALUES ('$roomId', '$userId')";
            if ($con->query($insertBookingQuery) === TRUE) {
                // Update the Users table to set has_room to true
                $updateUserQuery = "UPDATE Users SET has_room = TRUE WHERE user_id = '$userId'";
                if ($con->query($updateUserQuery) === TRUE) {
                    // Reduce the capacity of the room by one
                    $updateRoomQuery = "UPDATE Rooms SET capacity = capacity - 1 WHERE room_id = '$roomId'";
                    if ($con->query($updateRoomQuery) === TRUE) {
                        // Check if the room is now full and update is_available accordingly
                        $checkRoomCapacityQuery = "SELECT capacity FROM Rooms WHERE room_id = '$roomId'";
                        $capacityResult = $con->query($checkRoomCapacityQuery);
                        if ($capacityResult->num_rows > 0) {
                            $capacityRow = $capacityResult->fetch_assoc();
                            $capacity = $capacityRow['capacity'];
                            if ($capacity <= 0) {
                                $updateAvailabilityQuery = "UPDATE Rooms SET is_available = FALSE WHERE room_id = '$roomId'";
                                $con->query($updateAvailabilityQuery);
                            }
                        }
                        header("Location: ../admin/hall.php?message=Student added to room successfully.");
                        exit();
                        // Redirect or perform additional actions as needed
                    } else {
                        echo "Error updating room capacity: " . $con->error;
                    }
                } else {
                    echo "Error updating user: " . $con->error;
                }
            } else {
                echo "Error adding booking: " . $con->error;
            }
        } else {
            header("Location: ../admin/hall.php?message=Room not found.");
            exit();
        }
    } else {
        header("Location: ../admin/hall.php?message=User not found.");
        exit();
    }

    // Close the database connection
    $con->close();
} else {
    header("Location: ../admin/hall.php?message=Invalid request.");
    exit();
}
?>
