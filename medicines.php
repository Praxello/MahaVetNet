<?php session_start();
if(isset($_SESSION['branchId'])){
    $brId = $_SESSION['branchId'];
    $drid = $_SESSION['userId'];
?>
<!DOCTYPE HTML>
<html>

<head>
<title>Mahavetnet | Medicines</title>
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

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
    <?php include 'leftsidebar.php';?>
        <!--left-fixed -navigation-->
<?php include 'header.php';?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">

        <input type="hidden"  id="brid" value="<?php  echo $brId ;?>"/>
        <input type="hidden"  id="drid" value="<?php echo $drid ;?>"/>
            <div class="main-page general">
                <h2 class="title1">General Elements</h2>
                <div class="modals widget-shadow">
                    <h4 class="title2">Import Medicines</h4>
                    <h6 class="title2"><code>use sample csv</code></h6>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <form id="fupForm" name="fupForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="hidden" name="branchId" id="branchId" value="<?php  echo $brId ;?>">
                                <input type="file" class="form-control form-control-sm"
                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                    id="medicinefile" name="file" runat="server" required />
                            </div>
                            <input type="submit" name="submit" class="btn btn-success submitBtn" value="Import" />
                            <a href="sample_download_medicine.php" type="button" class="btn btn-warning">Download Sample
                                File</a>
                        </form>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="tables">
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Medicine List:</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="button1" class="btn btn-success" style="float:right"
                                    data-toggle="modal" data-target="#medicinemodal"> New
                                    Medicine</button>
                            </div>
                        </div>
                        <table class="table table-bordered medicine-table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Trade Name</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="medicine-data">
                        </table>
                    </div>
                </div>
                <?php include 'add_medicine_modal.php';?>
                <?php include 'edit_medicine_modal.php';?>

            </div>
        </div>
        <div class="footer">
            <!-- <p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/"
                    target="_blank">w3layouts</a></p> -->
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
    <script src="datatables/datatables.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="jscode/apis.js" type="text/javascript"></script>
    <script src="jscode/app.js" type="text/javascript"></script>
    <script src="jscode/farmer.js" type="text/javascript"></script>
    <script src="jscode/medicine.js" type="text/javascript"></script>
    <script src="jscode/import_medicine.js" type="text/javascript"></script>

</body>

</html>
<?php
}else{
    header("Location:index.php");
}?>
