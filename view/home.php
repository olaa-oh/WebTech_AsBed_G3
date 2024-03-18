<?php
session_start();

// ensure user is logged in
if (!(isset($_SESSION["user_id"]))) {
    // redirect to login
    header("Location: ../login/login_view.php");
    exit();
}

// include '../settings/core.php';
include_once('../functions/requestFxn.php');
include_once('../functions/hallFxn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student_portal</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="header">
        <h3 id = "brand"><a href="../index.html">
            AsBed</a></h3>
        <img src="../assets/home.png" alt="hostel icon" title=" asbed" style = "width: 5%;">
        <?php if (strtolower($_SESSION['role_id']) == 1 || strtolower($_SESSION['role_id']) == 2): ?>
            <a href="../admin/dashboard.php" class="btn btn-secondary" >DashBoard</a>

        <?php endif; ?>
        <div class="dropdown">
            <div class="dropdown-content">
              <!-- <a href="#">Settings</a> -->
              <a href="../login/logout_view.php">Logout</a>
            </div>
          </div>
    </div>
    <div class="bio">
        <div>
            Welcome, <span class="welcome-user"><?php echo $_SESSION["username"] ?></span> to the student portal.
        </div>
        <?php  
            include_once("../action/getRoomNumber.php");
            $room_data = getRoomNumber($_SESSION["user_id"]);

            if ($room_data == -1) {
                echo '<div>You have not booked a room.</div>';
            } else {
                echo '<div>
                    You are in Hall: <span class="name-type">' . $room_data[1] . '</span> Room: <span class="name-type">' . $room_data[0] . '</span>
                </div>';
            }
        ?>
    </div>
    <div class="title">
        <div id="hallname">HALLS</div>
        <div id="requestname">
        REQUESTS  
        <input type="image" src="../assets/send.png"  alt="Description Icon" title="Send a request" style="width: 4.5%;" id =button>
        <dialog id = "requestPo">
            <form action="../action/add_request.php" id ="form1" method="post">
                <label for="requestTitle">Title</label>
                <input type="text" id = "Trequest" name ="Trequest">

                <label for="requestTitle"> Request Details</label>
                <textarea name="Drequest" id="Drequest" cols="30" rows="10"></textarea>

                <input type="submit" id = "Srequest" name = "Srequest">
            </form>
            <div id="close">
                <button id = "closeBtn">Close</button>
            </div>
            
        </dialog>
        </div>
    </div>
    <?php
        if (isset($_SESSION["room_full"])) {
            echo '<div style="color: red;">The room is full!</div>';
            unset($_SESSION["room_full"]);
        }
    ?>
    <div class="hallsRequest">
        <div class="halls">
        <?php
            echo  $hall_data;
        ?>

        <!-- HALL MODAL -->
        <div id="hall-modal" class="modal-container">
            <div class="modal-content" id="hall-modal-content">
                <!-- <div class="block_item">
                    <a class="block_title">Hall Name:</a>
                    <a class="block_value">Water Sisulu</a>
                </div>
                <div class="block_item">
                    <a class="block_title">Capacity:</a>
                    <a class="block_value">10</a>
                </div>
                <div class="block_item">
                    <a class="block_title">Location:</a>
                    <a class="block_value">On Campus</a>
                </div>
                <div class="rooms">
                    <div class="room">
                        <div class="room_name">R1</div>
                        <div class="members">
                            <a class="members_title">Members:</a>
                            <ol class="member_list">
                                <li class="memberName">Amma Tired</li>
                                <li class="memberName">Amma Energetic</li>
                            </ol>
                        </div>
                        <div class="joined_status">
                            <a class="join-button">
                                <img class="description-icon" src="../assets/plus1.png" alt="Description Icon" style="width:15%;">
                            </a>
                        </div>
                    </div>

                    <div class="room">
                        <div class="room_name">R2</div>
                        <div class="members">
                            <a class="members_title">Members:</a>
                            <ol class="member_list">
                                <li class="memberName">Amma Tired</li>
                                <li class="memberName">Amma Energetic</li>
                            </ol>
                        </div>
                        <div class="joined_status">
                            <a class="join-button">
                                <img class="description-icon" src="../assets/plus1.png" alt="Description Icon" style="width:15%;">
                            </a>
                        </div>
                    </div>

                    <div class="room">
                        <div class="room_name">R3</div>
                        <div class="members">
                            <a class="members_title">Members:</a>
                            <ol class="member_list">
                                <li class="memberName">Amma Tired</li>
                                <li class="memberName">Amma Energetic</li>
                            </ol>
                        </div>
                        <div class="joined_status">
                            <a class="join-button">
                                <img class="description-icon" src="../assets/plus1.png" alt="Description Icon" style="width:15%;">
                            </a>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; padding-top: 1em">
                    <button type="button" id="close-button" class="close-button" onclick="closeHallInfoModalContainer()">
                        <span>
                            Cancel
                        </span>
                    </button>
                </div> -->
            </div>
        </div>


              <!-- <div class = hall_s>
                <img class="description-icon" src="../assets/hall1.jpg" alt="Description Icon">
                <button id="hallBtnB" class="hall-box" >
                    <div class="hall-name">Hall B</div>
                    <div class="room-count">0/40 rooms</div> 
                </button>
                <dialog id = "roomsB">
                    <div class="mainRooms">
                        <div class="room" id ="rB">
                            R1
                            <input type="image" class="description-icon" src="../assets/plus.png" alt="Description Icon" style="width:15%;" >
                            <input type="image" class="description-icon" src="../assets/minus-sign.png" alt="Description Icon" style="width: 15%;" >
                    </div>
                </div>
                    <div class="cse">
                        <button id = "closeRoomB">Close</button>
                       </div>                
                    </dialog>
            </div> -->
        </div>   
        <div class="requests">
            <table>
             <tr>
                <th>Title</th>
                <th>Concern<th>
             </tr>
                <?php
                echo $data;
                ?>
            </table>
            
        </div>
    </div>
    <script src = "../js/index.js"></script>
</body>
</html>