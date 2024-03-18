<?php
include_once('../action/allRequests.php');

$r_data = all_requests();

$data = '';

while($row = $r_data->fetch_assoc()){
    $requestID = $row['request_id'];
    $data  .=  "
    <tr>
        <td>".$row['title']."</td>
        <td>".$row['request_text']."</td>
    </tr>
    ";
}
?>