<?php
if(isset($_GET['kname'])){
    require 'db.php';
    $kname = $_GET['kname'];
    $no = $_GET['no'];
    $check = 'SELECT * FROM `kits` WHERE kname="'.$kname.'"';
    $result = $conn->query($check);
    $row = $result->fetch_assoc();
    
    if ($result->num_rows > 0) {
        $resp='';
        $id = $row['kid'];
    for ($i=0; $i < $no; $i++) {
        $fet = 'SELECT name, quantity FROM kit'.$id.' WHERE sno=1+'.$i;
        $res = $conn->query($fet);
        $ro = $res->fetch_assoc();
        $resp .= '<div id="fm"><div class="row" id="i'.$i.'">
        <div class="col-sm">
<input type="text" id="autocomplete'.$i.'" name="pname'.$i.'" value="'.$ro['name'].'" class="form-control" required
    placeholder="Product Name">
</div>
<div class="col-sm-3">
<input type="number" name="quan'.$i.'" value="'.$ro['quantity'].'" class="form-control" required
    placeholder="Quantity">
</div>
<div class="col-sm-2">
<button  type="button" onClick=delitem('.$i.') rel="tooltip" class="btn btn-danger btn-round tb">
                    <i class="material-icons">delete_forever</i>
                </button>
</div>
<hr>
<script>$("#autocomplete'.$i.'").autocomplete({

    lookup: comp

});</script></div></div>';
    }

    $resp.='<center><button  type="button" onClick="aditem()" rel="tooltip" class="btn btn-success btn-round tb">
    <i class="material-icons">add</i>
    </button></center>
<script src="tinymce.min.js"></script><br><div class="col" id="tanta" style="min-width:100%"><textarea placeholder="Add the declaration of kit here" name="mess" class="abc tan" id="tan"></textarea>
<script>
tinymce.init({
selector: ".tan",
height: 300
})


    

</script>  

</div>
';
    echo $resp;

    }else{
        $no = $_GET['no'];
    $resp='';
    for ($i=0; $i < $no; $i++) {
        $resp .= '<div class="row"><div class="col-sm">
<input type="text" id="autocomplete'.$i.'" name="pname'.$i.'" class="form-control" required
    placeholder="Product Name">
</div>
<div class="col-sm-3">
<input type="number" name="quan'.$i.'" class="form-control" required
    placeholder="Quantity">
</div><script>$("#autocomplete'.$i.'").autocomplete({

    lookup: comp

});</script></div><hr>';
    }

    $resp.='
<script src="tinymce.min.js"></script><br><div class="col" id="tanta" style="min-width:100%"><textarea placeholder="Add the declaration of kit here" name="mess" class="abc tan" id="tan"></textarea>
<script>
tinymce.init({
selector: ".tan",
height: 300
});
</script>  
</div>
0';
    echo $resp;

    }
    
    
}else{
    $no = $_GET['no'];
    $resp='';
    for ($i=0; $i < $no; $i++) {
        $resp .= '<div class="row"><div class="col-sm">
<input type="text" id="autocomplete'.$i.'" name="pname'.$i.'" class="form-control" required
    placeholder="Product Name">
</div>
<div class="col-sm-3">
<input type="number" name="quan'.$i.'" class="form-control" required
    placeholder="Quantity">
</div><script>$("#autocomplete'.$i.'").autocomplete({

    lookup: comp

});</script></div><hr>';
    }

    $resp.='
<script src="tinymce.min.js"></script><br><div class="col" id="tanta" style="min-width:100%"><textarea placeholder="Add the declaration of kit here" name="mess" class="abc tan" id="tan"></textarea>
<script>
tinymce.init({
selector: ".tan",
height: 300
});
</script>  

</div>
';
    echo $resp;
}
?>