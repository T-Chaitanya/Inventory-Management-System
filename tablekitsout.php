<?php 
require 'db.php';

$sql = "SELECT kid, kname, quantity, price FROM kitsout";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<tr class="newtr">
    <td class="text-center kl">' . $row["kid"]. '</td>
    <td class="kl">' . $row["kname"]. '</td>
    <td class="text-center kl">' . $row["quantity"]. '</td>
    <td class="text-center">'. $row["price"].'</td>
    <td class="td-actions text-right">
    <button  type="button" onClick="getlog('.$row["kid"].')" rel="tooltip" class="btn btn-rose btn-round tb">
                <i class="material-icons">note</i>
            </button>
                <button  type="button" onClick="addback('.$row["kid"].')" rel="tooltip" class="btn btn-info btn-round tb">
                <i class="material-icons">publish</i>
            </button>
                <button  type="button" onClick="delkit('.$row["kid"].')" rel="tooltip" class="btn btn-danger btn-round tb">
                    <i class="material-icons">delete_forever</i>
                </button>
            </td>
            </tr>';
  }
}


?>