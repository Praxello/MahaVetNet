<?php session_start();
if(isset($_SESSION['branchId'])){
    $brId = $_SESSION['branchId'];
    $drid = $_SESSION['userId'];
?>
<!DOCTYPE HTML>
<html>

<head>
     <?php include "title.php"; ?>
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

        <!-- header-starts -->
       <?php include 'header.php';?>
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
            <div class="forms">
            <div class="row">
                            <h3 class="title1">Reports:</h3>
                            <div class="form-three widget-shadow">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Year</label>
                                        <div class="col-sm-2">
                                        <select  class="form-control"  id="year" style="width:100%;"  required>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        </select>
                                        </div>
                                        <label for="focusedinput" class="col-sm-2 control-label">Month</label>
                                        <div class="col-sm-2">
                                        <select  class="form-control"  id="month" style="width:100%;"  required>
                                        <?php
                                        for ($m=1; $m<=12; $m++) {
                                            $month = date('F', mktime(0,0,0,$m, 1, date('Y')));?>
                                               <option value="<?php echo $m;?>"><?php echo $month;?></option><?php
                                            }?>
                                         </select>
                                        </div>
                                        
                                        </div>
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label">Zone</label>
                                        <div class="col-sm-6">
                                        <select  class="form-control"  id="zone" style="width:100%;"  required>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label">District</label>
                                        <div class="col-sm-6">
                                        <select  class="form-control"  id="district" style="width:100%;"  required>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label">Taluka</label>
                                        <div class="col-sm-6">
                                        <select  class="form-control"  id="taluka" style="width:100%;"  required>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label">Dispencery</label>
                                        <div class="col-sm-6">
                                        <select  class="form-control"  id="dispencery" style="width:100%;"  required>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label">Dispencery</label>
                                        <div class="col-sm-6">
                                        <select  class="form-control"  id="operation" style="width:100%;"  required>
                                        <option value="AIFresh">Artificial Insemination(Fresh)</option>
                                        <option value="AIRepeat1">Artificial Insemination(Repeat-1)</option>
                                        <option value="AIRepeat2">Artificial Insemination(repeat-2)</option>
                                        <option value="AI">Total Artificial Inseminations</option>
                                        <option value="Delivery">Calves Born</option>
                                        <option value="Vaccine">Artificial Insemination(Repeat-1)</option>
                                        <option value="AIRepeat2">Artificial Insemination(repeat-2)</option>
                                        <option value="AI">Total Artificial Inseminations</option>
                                        </select>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
            </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/"
                    target="_blank">w3layouts</a></p>
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
    <script src="jscode/apis.js" type="text/javascript"></script>
    <script src="js/reports.js" type="text/javascript"></script>
</body>
</html>
<?php
}else{
    header("Location:index.php");
}?>
