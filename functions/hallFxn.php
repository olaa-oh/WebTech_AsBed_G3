<?php
include_once('../action/getAllHalls.php');

$h_data = all_halls();

$hall_data = '';

while($row = $h_data->fetch_assoc()) {
    $hallID = $row['hall_id'];
    $hall_data .=  '

    <div class="hall_s" id="roomItem" hall_id=' . $row["hall_id"] .'>
        <img class="description-icon" src="../assets/hall1.jpg" alt="Description Icon">
        <div class="hall-box">
            <div class="hall-name">'.$row["hall_name"].'</div>
            <div class="room-count">Cap: '.$row["capacity"].'</div>
            <div class="room-availability">Available: ' . ($row["is_available"] == 1 ? 'true' : 'false') . '</div>
        </div>
    </div>';
}
?>