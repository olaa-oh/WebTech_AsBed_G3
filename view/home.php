<?php
session_start()

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
        <h3 id = "brand"><a href="view\landing.html">
            AsBed</a></h3>
        <img src="../assets/home.png" alt="hostel icon" title=" asbed" style = "width: 5%;">
        <?php if (strtolower($_SESSION['role_id']) !== 1): ?>
            <a href="../admin/dashboard.php" class="btn btn-secondary" >DashBoard</a>

        <?php endif; ?>

        <div class="dropdown">
            <div class="welcome-user">user name</div>
            <div class="dropdown-content">
              <a href="#">Settings</a>
              <a href="#">Logout</a>
            </div>
          </div>
    </div>
    <div class="bio">
        <p>Welcome, to the student portal.</p>
        <br>
        <p>[You are in [Hall][room]</p>
        <!-- <p>You have not booked</p> -->
    </div>
    <div class="title">
        <div id="hallname">HALLS</div>
        <div id="requestname">
        REQUESTS  
        <input type="image" src="assets/send.png"  alt="Description Icon" title="Send a request" style="width: 4.5%;" id =button>
        <dialog id = "requestPo">
            <form action="" id ="form1" method="post">
                <label for="requestTitle">Title of Request</label>
                <input type="text" id = "Trequest" name ="Trequest">

                <label for="requestTitle"> Request Details</label>
                <textarea name="Drequest" id="Drequest" cols="30" rows="10"></textarea>

                <input type="submit" id = "Srequest" name = "Srequest">
            </form>
            <div id="close">
                <button id = "closeBtn">Close</button>
            </div>
            
        </dialog>
        <img class="description-icon" src="../assets/search.png" alt="Description Icon" title="Search" style="width: 4.5%;" id =plus>
        </div>
    </div>
    <div class="hallsRequest">

        <div class="halls">
        
            <div id = hall>
                <img class="description-icon" src="../assets/hall1.jpg" alt="Description Icon">
                <button id="hallBtn" class="hall-box" onclick="hallBio()">
                    <div class="hall-name">Hall A</div>
                    <div class="room-count">0/10 rooms</div> 
                </button>
                <dialog id = "rooms">
                    <div class="mainRooms">
                        <div class="room" id ="rA">
                            R1
                            <input type="image" class="description-icon" src="assets/plus.png" alt="Description Icon" style="width:15%;" >
                            <input type="image" class="description-icon" src="assets/minus-sign.png" alt="Description Icon" style="width: 15%;" >
                        </div>                 
                    </div>
                   <div class="cse">
                    <button id = "closeRoom">Close</button>
                   </div>
                    
                </dialog> 
            </div>
            <div id = hall>
                <img class="description-icon" src="../assets/hall1.jpg" alt="Description Icon">
                <button id="hallBtnB" class="hall-box" onclick="hallBio()">
                    <div class="hall-name">Hall B</div>
                    <div class="room-count">0/40 rooms</div> 
                </button>
                <dialog id = "roomsB">
                    <div class="mainRooms">
                        <div class="room" id ="rB">
                            R1
                            <input type="image" class="description-icon" src="assets/plus.png" alt="Description Icon" style="width:15%;" >
                            <input type="image" class="description-icon" src="assets/minus-sign.png" alt="Description Icon" style="width: 15%;" >
                    </div>
                </div>
                    <div class="cse">
                        <button id = "closeRoomB">Close</button>
                       </div>                </dialog>
            </div>

            <div id = hall>
                <img class="description-icon" src="../assets/hall1.jpg" alt="Description Icon">
                <button id="hallBtnC" class="hall-box" onclick="hallBio()">
                    <div class="hall-name">Hall C</div>
                    <div class="room-count">0/30 rooms</div> 
                </button>
                <dialog id = "roomsC">
                    <div class="mainRooms">
                        <div class="room" id ="rC">
                            R1
                            <input type="image" class="description-icon" src="assets/plus.png" alt="Description Icon" style="width:15%;" >
                            <input type="image" class="description-icon" src="assets/minus-sign.png" alt="Description Icon" style="width: 15%;" >
                    </div>
                </div>
                    <div class="cse">
                        <button id = "closeRoomC">Close</button>
                       </div>                </dialog>
            </div>

            <div id = hall>
                <img class="description-icon" src="../assets/hall1.jpg" alt="Description Icon">
                <button id="hallBtnD" class="hall-box" onclick="hallBio()">
                    <div class="hall-name">Hall D</div>
                    <div class="room-count">0/15 rooms</div> 
                </button>
                <dialog id = "roomsD">
                    <div class="mainRooms">
                        <div class="room" id ="rD">
                            R1
                            <input type="image" class="description-icon" src="assets/plus.png" alt="Description Icon" style="width:15%;" >
                            <input type="image" class="description-icon" src="assets/minus-sign.png" alt="Description Icon" style="width: 15%;" >
                    </div>
                </div>
                    <div class="cse">
                        <button id = "closeRoomD">Close</button>
                       </div>                </dialog>
            </div>

            <div id = hall>
                <img class="description-icon" src="../assets/hall1.jpg" alt="Description Icon">
                <button id="hallBtnE" class="hall-box" onclick="hallBio()">
                    <div class="hall-name">Hall E</div>
                    <div class="room-count">0/20 rooms</div> 
                </button>
                <dialog id = "roomsE">
                    <div class="mainRooms">
                        <div class="room" id ="rE">
                            R1
                            <input type="image" class="description-icon" src="assets/plus.png" alt="Description Icon" style="width:15%;" >
                            <input type="image" class="description-icon" src="assets/minus-sign.png" alt="Description Icon" style="width: 15%;" >
                    </div>
                </div>
                    <div class="cse">
                        <button id = "closeRoomE">Close</button>
                       </div>                </dialog>
            </div>
        </div>   
        <div class="requests">
            <table>
                <tr>

                    <!-- <th>Requests</th> -->
                    <!-- <th>Actions</th> -->
                </tr>
                <tr>
                    
                    <td > 
                        <div class="entries">
                        Faulty Sink 
                        <input type="image" src="assets/bin.png" alt="delete" title="delete request"
                            style="width:2vw;"></div>
                    </td>
                    <!-- <td> -->


                    <!-- </td> -->
                </tr>

            </table>
            
        </div>
    </div>
    <script src = "js/index.js"></script>
</body>
</html>