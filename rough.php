'<div class="row" id="i'+i+'">
        <div class="col-sm">
<input type="text" id="autocomplete'+i+'" name="pname'+i+'" class="form-control" required
    placeholder="Product Name">
</div>
<div class="col-sm-3">
<input type="number" name="quan'+i+'" class="form-control" required
    placeholder="Quantity">
</div>
<div class="col-sm-2">
<button  type="button" onClick=delitem('+i+') rel="tooltip" class="btn btn-danger btn-round tb">
                    <i class="material-icons">delete_forever</i>
                </button>
</div>
<hr>'



var js = document.createElement('<script>$("#autocomplete'.$i.'").autocomplete({lookup: comp});</script>');
    