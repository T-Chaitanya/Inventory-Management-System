<?php
require 'db.php';
$id = $_GET['id'];
$check = 'SELECT decl FROM `kits` WHERE kid='.$id;
$result = $conn->query($check);
$row = $result->fetch_assoc();
$body = $row['decl'];
$res = "";
$res .='<table  class="table table-shopping" id="kits">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S No</th>
                                                <th>Name</th>
                                                <th class="text-center"></th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Tray</th>
                                                <th class="text-center">Check</th>

                                            </tr>
                                        </thead>
                                        <tbody>';
                                        $sqlu = 'SELECT * FROM '."kit".$id;
                                        
                                        $result = $conn->query($sqlu);
                                        
                                        if ($result->num_rows > 0) {
                                          while($row = $result->fetch_assoc()) {
                                            $res .= '<tr><td  class="text-center">'.$row["sno"].'</td>
                                            <td class="td-name"><h4><b>'.$row["name"].'</b></h4></td>
                                            <td>';
                                            if($row["img"]!=""){
                                                $res .= '<div class="img-container">
                                                    <img class="pimg" src="'.$row["img"].'" alt="">
                                                </div>';
                                            }
                                            $res .='</td>
                                            <td class="text-center">'.$row["quantity"].'</td>
                                            <td class="text-center">'.$row["tray"].'</td>
                                            <td class="text-center">
                                            <div class="form-check">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="checkbox" value="">
                                              <span class="form-check-sign">
                                                <span class="check"></span>
                                              </span>
                                            </label>
                                          </div></td></tr>';
                                          }
                                        }

$res.='</tbody>
</table>
'.$body.'
<center><button id="printkit" type=button class="btn btn-rose" onClick="printk()"><i class="material-icons">
print
</i>&nbsp;Print</button</center>';
echo $res;

?>