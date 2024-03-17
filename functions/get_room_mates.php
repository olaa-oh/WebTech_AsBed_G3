<?php
// Include the connection file
include '../settings/connection.php';

// Check if room_id is provided in the URL
// if(isset($_GET['room_id'])) {
    // Get the room_id from the URL
    $room_id = $_GET['room_id'];
    
    // Fetch room-mates from the RoomBookings table
    $selectQuery = "SELECT rb.user_id, u.username
                    FROM RoomBookings rb
                    INNER JOIN Users u ON rb.user_id = u.user_id
                    WHERE rb.room_id = $room_id";
    
    $result = $con->query($selectQuery);

    // Display chore data in a tabular form
    if ($result->num_rows > 0) {
        $roommates = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $roommates = [];
    }
   

    foreach ($roommates as $roommate) {
        echo 'User ID: ' . $roommate['user_id'] . ', Username: ' . $roommate['username'] . '<br>';
    }
    $roommates;
// } else {
//     // Redirect or display an error message if room_id is not provided
//     // For example: header('Location: error.php');
//     // You can customize this part based on your application's logic
//     header('Location: '. $_SERVER['HTTP_REFERER'] . '?error=unable_to_get_roommates');
//     exit();
// }

// You can use $roomMates array to display the room-mates as needed
?>
