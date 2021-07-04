<!DOCTYPE html>

<?php
require 'db.php';
$limit = 10;
$sql = "SELECT COUNT(pid) FROM main_inventory";
$rs_result = mysqli_query($conn, $sql);

$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$sql = "SELECT COUNT(lid) FROM log_main";
$rs_result2 = mysqli_query($conn, $sql);

$row2 = mysqli_fetch_row($rs_result2);
$total_records2 = $row2[0];
$total_pages2 = ceil($total_records2 / $limit);
?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" type="text/css" href="assets/css/googleapi_fonts.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
    <link href="assets/css/material-kit.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/superslides.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
    <script src="sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>IS</title>

    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="jquery.autocomplete.js"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
    <script src="assets/js/material-kit.js?v=2.0.4" type="text/javascript"></script>
    <script src="assets/js/plugins/moment.min.js"></script>
    <script src="assets/js/plugins/bootstrap-datetimepicker.js"></script>


</head>

<style>
body {
    padding-left: 30px;
    padding-right: 30px;
    overflow-x: hidden;
    background-color: white;

}

input {
    text-align: center;
}

.alert {
    padding: 0px;
}

.info {
    padding: 30px 0 30px;
}

.kl {
    cursor: pointer;
}

.autocomplete-suggestions {
    border: 1px solid #999;
    background: #FFF;
    overflow: auto;
}

.autocomplete-suggestion {
    padding: 2px 5px;
    white-space: nowrap;
    overflow: hidden;
}

.autocomplete-selected {
    background: #F0F0F0;
}

.autocomplete-suggestions strong {
    font-weight: normal;
    color: #3399FF;
}

.autocomplete-group {
    padding: 2px 5px;
}

.autocomplete-group strong {
    display: block;
    border-bottom: 1px solid #000;
}


/* Microsoft Edge */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.sol td {
    background-color: rgba(255, 0, 0, 0.2);
    padding: 10px;
}

.pimg {
    width: 120px !important;
}

td {
    vertical-align: middle !important;
}

tr {
    vertical-align: middle !important;
}

.card {
    min-width: 440px;
}

.tb {
    padding: 8px !important;
    margin: 1px !important;
}

.ca {

    border-radius: 51px 51px;
    width: 70px;
    transition: all 0.3s cubic-bezier(.25, .8, .25, 1);


}

.ca:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}

.info {
    max-width: max-content !important;
}

#loading-image img {
    display: block;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

}
</style>

<body>
    <!--loading-->

    <div id="loading-image">
        <img src="./assets/load.gif">

    </div>



    <!--model-->

    <div class="modal fade bd-example-modal-lg" id="ki" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="model_titleki"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-bodyki">


                </div>

            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal" id="kimg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title">Capture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="my_camera" style="max-height:370px;z-index:99;"></div>
                            <br />

                            <input type="hidden" name="imagemd" class="image-tag">

                            <div id="results"></div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <br />
                        <input type=button class="btn btn-rose" value="Capture" onClick="take_snapshot()">
                        <input type=button class="btn btn-success" id="kimgb" name="submit" value="Submit">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- body -->

    <div id="backg" style="display: none" class="alert">



        <ul class="nav nav-pills nav-pills-icons info nav-pills-info" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" href="#dashboard-1" role="tab" data-toggle="tab">
                    <i class="material-icons">ballot</i>
                    Inventory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#schedule-1" role="tab" data-toggle="tab">
                    <i class="material-icons">build</i>
                    Kit
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#log1" role="tab" data-toggle="tab">
                    <i class="material-icons">menu</i>
                    Log
                </a>
            </li>

        </ul>

        <div class="tab-content tab-space">


            <div class="tab-pane active" id="dashboard-1">
                <div class="row">

                    <div class="col-xl">

                        <div class="card">
                            <div class="card-header card-header-icon card-header-warning">
                                <div class="card-icon">
                                    <div class="row">
                                        <div class="col-md">
                                            <font style="font-size: 20px;padding: 0px 10px;">Manage Components in
                                                inventory</font>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <!-- <form action="updateinv.php" method="POST"> -->
                                <div class="row">

                                    <div class="col-sm-2">
                                        <input type="hidden" name="pid" id="pidh">
                                        <input disabled type="text" name="pidi" id="pid" class="form-control"
                                            placeholder="Product ID">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="pname" id="auto" class="form-control" required
                                            placeholder="Product Name">
                                        <?php require 'get.php' ?>
                                        <script>
                                        $('#auto').devbridgeAutocomplete({
                                            lookup: comp

                                        });
                                        </script>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" id="quan" name="quan" class="form-control" required
                                            placeholder="Quantity">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="price" id="pri" step="any" class="form-control"
                                            required placeholder="Price">
                                    </div>
                                    <div class="col-sm">
                                        <div class="col-sm-2" style="float:right;padding-left:25px"" >
                                        <input type=" text" style="float:right;" name="tray" id="tid"
                                            class="form-control" required autofill="off" placeholder="Tray">
                                        </div>
                                        <div class="col-sm-2" style="float:right;">
                                            <span style="float:right;" class="badge badge-info" id="avail"></span>
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <div class="row">


                                    <br>
                                    <input type="hidden" name="image" id="image" class="image-tag">
                                    <div id="pimg" class="fileinput fileinput-new text-center"
                                        data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-raised">
                                            <img id="tempimg" src="" alt="">
                                        </div>
                                        <div id="imgp" class="fileinput-preview fileinput-exists thumbnail img-raised">
                                        </div>
                                        <br>
                                        <div>
                                            <span class="btn btn-raised btn-round btn-default btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="..." />
                                            </span>
                                            <a href="#" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput">
                                                <i class="fa fa-times"></i> Remove</a>
                                            &nbsp;&nbsp;
                                            <input type=button id="cap" class="btn btn-raised btn-round btn-warning"
                                                value="Capture">
                                        </div>

                                    </div>

                                    <div class="col-sm" style="margin-left:150px">
                                        <textarea rows="10" name="log" class="form-control" id="com" autofill="off"
                                            placeholder="Comment"></textarea>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <div class="row">

                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="togglebutton col-md-8">
                                                <label style="float:right;margin-right:20px;">
                                                    <input name="editf" id="editf" type="checkbox">
                                                    <span class="toggle"></span>
                                                    Edit
                                                </label>
                                            </div>
                                            <button onClick="additem()" type="submit" id="add" name="add"
                                                style="float:right;margin-right:20px;" class="btn btn-success"><i
                                                    class="material-icons">
                                                    add
                                                </i>&nbsp;Add </button>

                                            <button onClick="removeitem()" type="submit" name="remove" id="remove"
                                                style="float:right;margin-right:20px;" class="btn btn-danger"><i
                                                    class="material-icons">
                                                    remove
                                                </i>&nbsp;Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>




                                <!--  </form> -->

                            </div>

                        </div><br>


                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header card-header-icon card-header-info">
                                    <div class="card-icon">
                                        <div class="row">
                                            <div class="col-md">
                                                <font style="font-size: 20px;padding: 0px 10px;">Components
                                                </font>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div id="target-content">loading...</div>

                                    <div class="clearfix">

                                        <ul class="pagination pagination-info justify-content-center">
                                            <?php
                                                if (!empty($total_pages)) {
                                                    for ($i=1; $i<=$total_pages; $i++) {
                                                        if ($i == 1) {
                                                            ?>
                                            <li class="page-item page-item1 active" id="<?php echo $i; ?>"><a
                                                    href="JavaScript:Void(0);" data-id="<?php echo $i; ?>"
                                                    class="page-link page-link1"><?php echo $i; ?></a></li>

                                            <?php
                                                        } else {
                                                            ?>
                                            <li class="page-item page-item1" id="<?php echo $i; ?>"><a
                                                    href="JavaScript:Void(0);" class="page-link page-link1"
                                                    data-id="<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                        </ul>
                                        </ul>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>



                </div>


            </div>

            <div class="tab-pane" id="schedule-1">

                <div class="row">

                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header card-header-icon card-header-success">
                                <div class="card-icon">
                                    <div class="row">
                                        <div class="col-sm">
                                            <font style="font-size: 20px;padding: 0px 10px;">Create New Kit</font>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="createkit.php" method="POST">
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" name="kname" id="kname" class="form-control" required
                                                placeholder="Kit Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="quanc" name="quanc" class="form-control" required
                                                placeholder="No. of Components">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="price" name="price" class="form-control" required
                                                placeholder="Price of kit">
                                        </div>
                                    </div>
                                    <br>
                                    <div id="df">

                                    </div>

                                    <br>


                                    <button type="submit" style="float:right;margin-right:70px;"
                                        class="btn btn-success">Submit Kit</button>


                                </form>

                            </div>

                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md">
                            <div class="card">
                                <div class="card-header card-header-icon card-header-info">
                                    <div class="card-icon">
                                        <div class="row">
                                            <div class="col-md">
                                                <font style="font-size: 20px;padding: 0px 10px;">Kits in Inventory
                                                </font>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table class="table" id="kits">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kit id</th>
                                                <th>Kit Name</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include 'tablekits.php' ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header card-header-icon card-header-warning">
                                    <div class="card-icon">
                                        <div class="row">
                                            <div class="col-md">
                                                <font style="font-size: 20px;padding: 0px 10px;">Kits out of Inventory
                                                </font>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table class="table" id="kits">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kit id</th>
                                                <th>Kit Name</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Actions</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include 'tablekitsout.php' ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header card-header-icon card-header-rose">
                                    <div class="card-icon">
                                        <div class="row">
                                            <div class="col-md">
                                                <font style="font-size: 20px;padding: 0px 10px;">Note
                                                </font>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body" id="gtn">


                                </div>
                            </div>
                        </div>


                    </div>



                </div>
            </div>

            <div class="tab-pane" id="log1">
                <div class="row">

                    <div class="col-sm">
                        <div class="form-group">
                            <label class="label-control">Start Datetime</label>
                            <input type="text" class="form-control datetimepicker" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <center>
                            <h2>to</h2>
                            <button id="showlog" class="btn btn-success">Show</button>
                        </center>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label class="label-control">End Datetime</label>
                            <input type="text" class="form-control datetimepicker2" />
                        </div>
                    </div>


                </div>
                <br><br>
                <div class="row">
                    <div class="col-xl" id="nill">
                        <div id="target-content2">loading...</div>

                        <div class="clearfix">

                            <ul class="pagination pagination-info justify-content-center">
                                <?php
            if (!empty($total_pages2)) {
                for ($i=1; $i<=$total_pages2; $i++) {
                    if ($i == 1) {
                        ?>
                                <li class="page-item page-item2 active" id="<?php echo $i; ?>"><a
                                        href="JavaScript:Void(0);" data-id="<?php echo $i; ?>"
                                        class="page-link page-link2"><?php echo $i; ?></a></li>

                                <?php
                    } else {
                        ?>
                                <li class="page-item page-item2" id="<?php echo $i; ?>"><a href="JavaScript:Void(0);"
                                        class="page-link page-link2" data-id="<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                                <?php
                    }
                }
            }
        ?>
                            </ul>
                            </ul>
                        </div>



                    </div>


                </div>
                <div class="row">
                    <div class="col-xl" id="notnill">
                        <div id="target-content3"></div>


                    </div>
                </div>
            </div>



        </div>
    </div>

</body>

<script src="webcam.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>


<?php if (isset($_GET['error'])) {
    echo '<script>if(typeof window.history.pushState == "function") {
        window.history.pushState({}, "Hide", "http://localhost/is/");
    }</script>';
    if ($_GET['error']=="kit") {
        echo '<script>$(".nav li:eq(1) a").tab("show");</script>';
        echo '<script>Swal.fire({
            title: "Kit is already Out",
            text: "You can not edit kits already Out",
            icon: "error"
        });</script>';
    }
}
if (isset($_GET['tab'])) {
    echo '<script>if(typeof window.history.pushState == "function") {
        window.history.pushState({}, "Hide", "http://localhost/is/");
    }</script>';
    if ($_GET['tab']==1) {
        echo '<script>$(".nav li:eq(1) a").tab("show");
    </script>';
    }
}
?>



<script language="JavaScript">
$('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});
$('.datetimepicker2').datetimepicker({

    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});
$(function() {
    $('.datetimepicker').data("DateTimePicker").format('YYYY-MM-DD HH:mm');
    $('.datetimepicker2').data("DateTimePicker").format('YYYY-MM-DD HH:mm');
    $('.datetimepicker').datetimepicker();
    $('.datetimepicker2').datetimepicker({
        useCurrent: false //Important! See issue #1075
    });
    $(".datetimepicker").on("dp.change", function(e) {
        $('.datetimepicker2').data("DateTimePicker").minDate(e.date);
    });
    $(".datetimepicker2").on("dp.change", function(e) {
        $('.datetimepicker').data("DateTimePicker").maxDate(e.date);
    });
});

$(document).ready(function() {
    $('#loading-image').hide();
    $('#backg').show();
});
$('#loading-image').bind('ajaxStart', function() {
    $(this).show();
}).bind('ajaxStop', function() {
    $(this).hide();
});
$('#cap').click(function() {
    Webcam.set({
        width: 426,
        height: 240,
        dest_width: 426,
        dest_height: 240,
        image_format: 'jpeg',
        jpeg_quality: 100,
        force_flash: false
    });
    Webcam.attach('#my_camera');
    $('#kimg').modal('show');
});


function take_snapshot() {
    Webcam.snap(function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';

    });
}
var pri = 0;

function checkf() {
    if ($("#auto").val() == "") {
        $("#auto").focus();
        return false;
    } else if ($("#quan").val() == "") {
        $("#quan").focus();
        return false;
    } else if ($("#pri").val() == "") {
        $("#pri").focus();
        return false;
    } else if ($("#tid").val() == "") {
        $("#tid").focus();
        return false;
    } else {
        return true;
    }
}

function checkf2() {
    if ($("#auto").val() == "") {
        $("#auto").focus();
        return false;
    } else if ($("#quan").val() == "") {
        $("#quan").focus();
        return false;
    } else {
        return true;
    }
}

function additem() {
    if (checkf()) {
        if ($("#pidh").val() == "") {
            $.ajax({
                url: "updateinv.php",
                type: "POST",
                data: {
                    add: "add",
                    editf: "not",
                    pname: $("#auto").val(),
                    quan: $("#quan").val(),
                    price: $("#pri").val(),
                    log: $("#com").val(),
                    tray: $("#tid").val(),
                    image: $("#image").val()
                },
                cache: false,
                success: function(dataResult) {
                    location.reload();

                }
            });


        } else {


            $.ajax({
                url: "updateinv.php",
                type: "POST",
                data: {
                    pid: $("#pidh").val(),
                    add: "add",
                    editf: ($('#editf').is(":checked")),
                    pname: $("#auto").val(),
                    quan: $("#quan").val(),
                    price: $("#pri").val(),
                    log: $("#com").val(),
                    tray: $("#tid").val(),
                    image: $("#image").val()
                },
                cache: false,
                success: function(dataResult) {
                    location.reload();

                }
            });



        }

    }
}

function removeitem() {
    if (checkf2()) {
        if ($("#pidh").val() == "") {

            alert("not ok");

        } else {
            $.ajax({
                url: "updateinv.php",
                type: "POST",
                data: {
                    pid: $("#pidh").val(),
                    remove: "remove",
                    editf: ($('#editf').is(":checked")),
                    pname: $("#auto").val(),
                    quan: $("#quan").val(),
                    price: $("#pri").val(),
                    log: $("#com").val(),
                    tray: $("#tid").val(),
                    image: $("#image").val()
                },
                cache: false,
                success: function(dataResult) {
                    location.reload();

                }
            });


        }

    }
}

function getlog(id) {

    $.ajax({
        url: "getnote.php",
        type: "GET",
        data: {
            id: id
        },
        cache: false,
        success: function(dataResult) {

            $("#gtn").html(dataResult);
        }
    });
}

function sendNote(id) {
    $.ajax({
        url: "getnote.php",
        type: "GET",
        data: {
            id: id,
            data: $('#logl').val()
        },
        cache: false,
        complete: function(data) {
            Swal.fire({
                title: 'Done!',
                text: 'Note Updated',
                icon: 'success'
            });
        }
    });
}

function printk() {

    $("tr").each(function() {
        $(this).children("td:eq(4)").remove();
        $(this).children("th:eq(4)").remove();
        $(this).children("td:eq(4)").remove();
        $(this).children("th:eq(4)").remove();


    });

    var htm = $("#modal-bodyki").html();

    var tit = $("#model_titleki").html();
    var newWin = window.open('', 'Print-Window');
    var tbp =
        '<html><head><link href="assets/css/material-kit.css" type="text/css" rel="stylesheet" /><style>.table td {padding: inherit;}.btn{visibility: hidden !important;}.pimg {width: 120px !important;}td {vertical-align: middle !important;}tr {vertical-align: middle !important;}</style></head><body onload="window.print()"><img id="tempimg" src="logo3.png" alt=""><center><h2>' +
        tit + '</h2></center><br>' + htm + '</body></html>';

    newWin.document.open();

    newWin.document.write(tbp + '<h3>Price : ' + pri + '</h3>');

    newWin.document.close();

    setTimeout(function() {
        newWin.close();
        location.replace(location.href + "?tab=1");
    }, 10)

};
$('#kimgb').click(function() {
    var imgt = $(".image-tag").val();
    $('#tempimg').attr('src', imgt);
    $('#kimg').modal('hide');
});
</script>
<script>
$('#pimg').on('DOMSubtreeModified', '#imgp', function() {
    var dv = document.getElementById("imgp");
    var im = dv.getElementsByTagName("img");
    $(im).width(200);
    var image = $(im).attr('src');
    $(".image-tag").val(image);

});

function delitem(i) {
    $('#i' + i).remove();
    $("#quanc").val($("#quanc").val() - 1);
};

function aditem() {
    var i = $("#quanc").val();
    var b = '<div class="row" id="i' + i + '"><div class="col-sm"><input type="text" id="autocomplete' + i +
        '" name="pname' + i +
        '" class="form-control" required placeholder="Product Name"></div><div class="col-sm-3"><input type="number" name="quan' +
        i +
        '" class="form-control" required placeholder="Quantity"></div><div class="col-sm-2"><button  type="button" onClick=delitem(' +
        i +
        ') rel="tooltip" class="btn btn-danger btn-round tb"><i class="material-icons">delete_forever</i></button></div><hr>';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    var code = 'setTimeout(function(){ $("#autocomplete' + i + '").autocomplete({lookup: comp}); }, 1000);';
    try {
        s.appendChild(document.createTextNode(code));
        document.getElementById("fm").appendChild(s);
    } catch (e) {

    }
    $('#fm').append(b);
    $("#quanc").val(parseInt($("#quanc").val()) + 1);
}

function sen(id) {
    var q = 0
    Swal.fire({
        title: 'No. of kits',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Check',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            q = login;
            return fetch(`requestkits.php?kid=${id}&quan=${login}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.value.ok) {
            Swal.fire({
                title: 'Are you sure to send kits?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "sendkitsout.php",
                        type: "GET",
                        data: {
                            id: id,
                            quan: q

                        },
                        cache: false,
                        success: function(dataResult) {
                            Swal.fire({
                                title: 'Done!',
                                text: 'Kits has been sent.',
                                icon: 'success'
                            }).then((result) => {
                                if (result.value) {

                                    location.replace(location.href + "?tab=1");
                                }
                            });
                        }
                    });



                }
            });



        } else {
            Swal.fire({
                title: `${result.value.resp}`,
                icon: 'error'
            });
        }
    });
};

function efr(id) {

    $.getJSON('infok.php', {
        id: id
    }, function(data, textStatus, jqXHR) {
        $('#kname').val(data.kname);
        $('#quank').val(data.quan);
        $('#quanc').val(data.com);
        $('#price').val(data.pri);
        $("#quanc").blur();
    });

};

function addback(id) {
    var q = 0
    Swal.fire({
        title: 'No. of kits to add back',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Check',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            q = login;
            return fetch(`requestkitsout.php?kid=${id}&quan=${login}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.value.ok) {
            Swal.fire({
                title: 'Are you sure to add back kits?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "sendkitsin.php",
                        type: "GET",
                        data: {
                            id: id,
                            quan: q
                        },
                        cache: false,
                        success: function(dataResult) {
                            Swal.fire({
                                title: 'Done!',
                                text: 'Kits has been added in.',
                                icon: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    location.replace(location.href + "?tab=1");
                                }
                            });
                        }
                    });



                }
            });



        } else {
            Swal.fire({
                title: `${result.value.resp}`,
                icon: 'error'
            });
        }
    });
}


function delkit(id) {



    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "deletekitout.php",
                type: "GET",
                data: {
                    id: id
                },
                cache: false,
                success: function(dataResult) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Kit has been deleted.',
                        icon: 'success'
                    }).then((result) => {
                        if (result.value) {

                            location.replace(location.href + "?tab=1");
                        }
                    });



                }
            });

        }
    });

}

function mfr(id) {


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "deletekit.php",
                type: "GET",
                data: {
                    id: id
                },
                cache: false,
                success: function(dataResult) {
                    Swal.fire(
                        'Deleted!',
                        'Kit has been deleted.',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.replace(location.href + "?tab=1");
                        }
                    });



                }
            });

        }
    });


};
$("#quanc").on('blur', function() {
    var no = $(this).val();
    var kitn = $("#kname").val()
    if (kitn == "") {
        $.ajax({
            url: "getform.php",
            type: "GET",
            data: {
                no: no
            },
            cache: false,
            success: function(dataResult) {
                $("#df").html(dataResult);

            }
        });
    } else {
        $.ajax({
            url: "getform.php",
            type: "GET",
            data: {
                kname: kitn,
                no: no
            },
            cache: false,
            success: function(dataResult) {

                $("#df").html(dataResult);


            },
            complete: function(data) {
                $.ajax({
                    url: "getbody.php",
                    type: "GET",
                    data: {
                        kname: kitn,
                        no: no
                    },
                    cache: false,
                    success: function(dataResult) {
                        setTimeout(function() {
                            tinymce.get("tan").setContent(dataResult);
                        }, 1000);

                    }
                });
            }
        });
    }
});
$(document).ready(function() {
    $("#target-content").load("pagination.php");
    $(".page-link1").click(function() {
        var id = $(this).attr("data-id");
        var select_id = $(this).parent().attr("id");
        $.ajax({
            url: "pagination.php",
            type: "GET",
            data: {
                page: id
            },
            cache: false,
            success: function(dataResult) {
                $("#target-content").html(dataResult);
                $(".page-item1").removeClass("active");
                $("#" + select_id).addClass("active");

            }
        });
    });
    $("#target-content2").load("pagination2.php");
    $(".page-link2").click(function() {
        var id = $(this).attr("data-id");
        var select_id = $(this).parent().attr("id");
        $.ajax({
            url: "pagination2.php",
            type: "GET",
            data: {
                page: id
            },
            cache: false,
            success: function(dataResult) {
                $("#target-content2").html(dataResult);
                $(".page-item2").removeClass("active");


            }
        });
    });
    $("#showlog").click(function() {
        if ($(".datetimepicker").val() == "") {
            $(".datetimepicker").focus();
        } else if ($(".datetimepicker2").val() == "") {
            $(".datetimepicker2").focus();
        } else  {
            
            
            $("#notnill").show();
            $("#nill").hide();

            var str = $(".datetimepicker").val()
            var en = $(".datetimepicker2").val()
            $.ajax({
                url: "getlog.php",
                type: "GET",
                data: {
                    start: str,
                    end: en
                },
                cache: false,
                success: function(dataResult) {

                    $("#target-content3").html(dataResult);



                }
            });

        }
    });
    var quan = 0;
    $("#editf").click(function() {
        if ($("#editf").prop("checked") == false) {
            $("#add").html('<i class="material-icons">add</i>&nbsp;Add');
            $("#remove").html('<i class="material-icons">remove</i>&nbsp;Remove');
            $('#quan').val(null);
        } else {
            $("#add").html('<i class="material-icons">edit</i>&nbsp;Edit')
            $("#remove").html('<i class="material-icons">delete_forever</i>&nbsp;Delete')
            $('#quan').val(quan);
        }

    });
    $("#auto").blur(function() {
        var cname = $(this).val();
        if ($("#editf").prop("checked") == false) {
            $.getJSON('info.php', {
                name: cname
            }, function(data, textStatus, jqXHR) {
                $('#pid').val(data.pid);
                $('#pidh').val(data.pid);
                $('#pri').val(data.pri);
                $('#com').val(data.com);
                $('#avail').html("Available: " + data.quan);
                quan = data.quan;
                $('#tid').val(data.tray);
                if (data.im == "") {
                    $('#tempimg').attr('hidden', 'true')
                } else {
                    $('#tempimg').removeAttr('hidden');
                    $('#tempimg').attr('src', data.im);
                }
                $('#tempimg').width(200);
            });

        }



    });



    $("#kits tr").each(function(r) {
        var row = r;
        $("td", this).each(function(d) {
            var cell = d;
            $(this)
                .data("rowIndex", row)
                .data("cellIndex", cell)
                .data("kit", $("#kits tr")[row].cells[0].innerHTML)
                .data("name", $("#kits tr")[row].cells[1].innerHTML)
                .data("pri", $("#kits tr")[row].cells[3].innerHTML)
                .click(function() {
                    pri = $(this).data("pri");
                    var name = $(this).data("name");
                    if (cell < 4) {
                        $.ajax({
                            url: "getkit.php",
                            type: "GET",
                            data: {
                                id: $(this).data("kit")
                            },
                            cache: false,
                            success: function(dataResult) {
                                $('#ki').modal('show');
                                $('#model_titleki').html("<b>" + name +
                                    "</b>");
                                $("#modal-bodyki").html(dataResult);

                            }
                        });
                    }

                })

        });
    });



});
</script>


</html>