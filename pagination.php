<?php
require 'db.php';
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM main_inventory ORDER BY pid ASC LIMIT ".$start_from.",".$limit;  
$rs_result = mysqli_query($conn, $sql);  
?>
<table class="table">
    <thead>
        <tr>
            <th class="text-center">P id</th>
            <th>Name</th>
            <th class="text-center">Quantity</th>
            <th class="text-right">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>
        <tr>
            <td class="text-center"><?php echo $row["pid"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td class="text-center"><?php echo $row["quantity"]; ?></td>
            <td class="text-right"><?php echo "&#8377;".$row["price"]; ?></td>
        </tr>
        <?php  
};  
?>
    </tbody>
</table>