<?php session_start();
if(isset($_SESSION['branchId']) && isset($_SESSION['email'])){
    $brId = $_SESSION['branchId'];
    $drid = $_SESSION['userId'];
    $email = $_SESSION['email'];
    $centretype = $_SESSION['center'];
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Mahavetnet | Reports</title>
    <?php include 'metatag.php';?>
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' /> -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"> -->
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="icon" type="images/png" sizes="16x16" href="images/mlogo.png">
    <!-- font-awesome icons CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons CSS -->

    <!-- side nav css file -->
    <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- side nav css file -->

    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet">
    <!--//webfonts-->

    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
    <link href="css/loader.css" rel="stylesheet">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include 'leftsidebar.php';?>
        <!--left-fixed -navigation-->

        <!-- header-starts -->
        <?php include 'header.php';?>

        <!-- main content start-->
        <div id="page-wrapper">
        <div id="wait" style="display:none;"></div>

            <input type="hidden" id="centerid" value="<?php echo $centretype;?>">
            <input type="hidden" id="branchid" value="<?php echo $brId;?>">
            <input type="hidden" id="emailid" value="<?php echo $email;?>">
            <div class="main-page">
                <div class="forms">
                    <div class="row">
                        <h3 class="title1">Case Paper:</h3>
                        <div class="form-three widget-shadow">
                            <form class="form-horizontal">
                                <div class="form-group">
                                   
                                    <div class="col-sm-3">
                                    <label for="focusedinput">From</label>
                                        <input type="date" class="form-control" id="from" />
                                    </div>
                                   
                                    <div class="col-sm-3">
                                    <label for="focusedinput">To</label>
                                        <input type="date" class="form-control" id="upto" />
                                    </div>
                                    <div class="col-sm-3">
                                    <label for="focusedinput" style="padding-top: 27px;">&nbsp;</label>
                                        <button class="btn btn-primary" type="button" onclick="loadcasepaper()">Search
                                        </button>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tables">
                            <div class="table-responsive bs-example widget-shadow">

                                <table class="table table-bordered table-striped  farmer-table">
                                    <thead id="farmer-head">
                                        <tr>
                                            <th>Animal Name/Tag</th>
                                            <th>Species</th>
                                            <th>Breed</th>
                                            <th>Farmer Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Symptoms</th>
                                            <th>Visit Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="farmer-data"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2020 All Rights Reserved | Design by <a href="http://praxello.com/" target="_blank">Praxello
                    Solutions</a></p>
        </div>
    </div>
    <!-- <script src='js/SidebarNav.min.js' type='text/javascript'></script>
    <script>
    $('.sidebar-menu').SidebarNav()
    </script> -->
    <script src="js/classie.js"></script>
    <script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
    </script>
    <!-- //Classie -->
    <!-- //for toggle left push menu script -->

    <!--scrolling js-->
    <link href="select2/select4.css" rel="stylesheet" />
    <script src="select2/select4.js" type="text/javascript"></script>
    <script src="datatables/datatables.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="jscode/apis.js" type="text/javascript"></script>
    <script src="js/casepaper.js" type="text/javascript"></script>
</body>

</html>
<?php
}else{
    header("Location:index.php");
}?>