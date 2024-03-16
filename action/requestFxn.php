<?php
include '../action/allRequests.php';

$r_data = all_requests();

$data = '';

while($row = $r_data->fetch_assoc()){
    $requestID = $row['request_id'];
    $data  .=  "
    
    <tr>
    <td>".$row['subject']."</td>
    <td > 
        <div class='entries'>
        <input type='image' src='../assets/bin.png' alt='delete' title='delete request'
            style='width:2vw;'></div>
    </td>
</tr>
    
    ";
}




?>