<?php
require 'db.php';
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  

//SELECT * FROM `log_main` WHERE time BETWEEN "2020-08-26 11:44" and "2020-08-26 12:23"

$sql = "SELECT * FROM log_main  ORDER BY lid DESC LIMIT ".$start_from.",".$limit;  
$rs_result = mysqli_query($conn, $sql);  
?>
<table class="table">
    <thead>
        <tr>
            <th class="text-center">L id</th>
            <th>Name</th>
            <th class="text-center">Log</th>
            <th class="text-center">Time</th>
        </tr>
    </thead>
    <tbody>
        <?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>
        <tr>
            <td class="text-center"><?php echo $row["lid"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td class="text-center"><?php echo $row["log"]; ?></td>
            <td class="text-center"><?php echo $row["time"]; ?></td>
        </tr>
        <?php  
};  
?>
    </tbody>
</table>