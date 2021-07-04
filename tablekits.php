<?php 
require 'db.php';

$sql = "SELECT kid, kname, quantity, price FROM kits";
$result = $conn->query($sql);
$res="";
$res2="";
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<tr class="newtr">
    <td name="clickab" class="text-center kl">' . $row["kid"]. '</td>
    <td name="clickab" class="kl">' . $row["kname"]. '</td>
    <td name="clickab" class="text-center kl">' . $row["quantity"]. '</td>
    <td name="clickab" class="text-center">'. $row["price"].'</td>
    <td class="td-actions text-right">
                <button  type="button" onClick="efr('.$row["kid"].')" rel="tooltip" class="btn btn-info btn-round tb">
                    <i class="material-icons">edit</i>
                </button>

                <button  type="button" onClick="sen('.$row["kid"].')" rel="tooltip" class="btn btn-warning btn-round tb">
                    <i class="material-icons">get_app</i>
                </button>

                <button  type="button" onClick="mfr('.$row["kid"].')" rel="tooltip" class="btn btn-danger btn-round tb">
                    <i class="material-icons">delete_forever</i>
                </button>
                
            </td>
            </tr>';
  }
}


?>