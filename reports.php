<?php session_start();
if(isset($_SESSION['branchId']) && isset($_SESSION['email'])){
    $brId = $_SESSION['branchId'];
    $drid = $_SESSION['userId'];
    $email = $_SESSION['email'];
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Mahavetnet | Reports</title>
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

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include 'leftsidebar.php';?>
        <!--left-fixed -navigation-->

        <!-- header-starts -->
       <?php include 'header.php';?>
        <!-- main content start-->
        <div id="page-wrapper">
        <input type="hidden" id="branchid" value="<?php echo $brId;?>">
        <input type="hidden" id="emailid" value="<?php echo $email;?>">
            <div class="main-page">
            <div class="forms">
            <div class="row">
                            <h3 class="title1">Reports:</h3>
                            <div class="form-three widget-shadow">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Year</label>
                                        <div class="col-sm-3">
                                        <select  class="form-control"  id="year" style="width:100%;"  required>
                                        <option>2018</option>
                                        <option>2019</option>
                                        </select>
                                        </div>
                                        <label for="focusedinput" class="col-sm-2 control-label">Month</label>
                                        <div class="col-sm-3">
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
                                        <label for="disabledinput" class="col-sm-2 control-label zone">Zone</label>
                                        <div class="col-sm-3 zone">
                                        <select  class="form-control"  id="zone" style="width:100%;"  required onchange="loadDistricts(this.value,2)">
                                        </select>
                                        </div>
                                        <label for="disabledinput" class="col-sm-2 control-label district">District</label>
                                        <div class="col-sm-3 district">
                                        <select  class="form-control"  id="district" style="width:100%;"  onchange="loadTaluka(this.value,3)" required>
                                        </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label taluka">Taluka</label>
                                        <div class="col-sm-3 taluka">
                                        <select  class="form-control"  id="taluka" style="width:100%;" onchange="loadDispencery(this.value,4)" required>
                                        </select>
                                        </div>
                                        <label for="disabledinput" class="col-sm-2 control-label">Dispencery</label>
                                        <div class="col-sm-3">
                                        <select  class="form-control"  id="dispencery" style="width:100%;" onchange="getDispenceryBranch(this.value)" required>
                                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label">Report</label>
                                        <div class="col-sm-3">
                                        <select  class="form-control"  id="operation" style="width:100%;"  required>
                                        <option value="1">Artificial Insemination(Fresh)</option>
                                        <option value="2">Artificial Insemination(Repeat-1)</option>
                                        <option value="3">Artificial Insemination(repeat-2)</option>
                                        <option value="4">Total Artificial Inseminations</option>
                                        <option value="5">Calves Born</option>
                                        <option value="6">Vaccination</option>
                                        <option value="7">Infertility</option>
                                        <option value="8">Deworming</option>
                                        <option value="9">Cash Register</option>
                                        <option value="10">Castrations</option>
                                        <option value="11">Operations</option>
                                        <option value="12">Pregnancy Diagnosis</option>
                                        <option value="13">Inpatients</option>
                                        <option value="14">Outpatients</option>
                                        <option value="15">Day Book</option>
                                        <option value="16">Tour Book</option>
                                        </select>
                                        </div>
                                        <div class="col-sm-3">
                                      
                                        <button  class="btn btn-primary" type="button" onclick="get_reports()">Generate Report</button>
                                       
                                        </div>
                                        <div class="col-sm-3">
                                      
                                        <button  class="btn btn-success" type="button" onclick="get_mrp()">Download MPR</button>
                                       
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                            <div class="tables">
                    <div class="table-responsive bs-example widget-shadow">

                            <table class="table table-bordered table-striped  farmer-table">
                                <thead id="farmer-head">
                                    <tr>
                                        <th>Monthly</th>
                                        <th>Yearly</th>
                                        <th>Visit Date</th>
                                        <th>Name  </th>
                                        <th>Address</th>
                                        <th>Category</th>
                                        <th>Species</th>
                                        <th>Breed</th>
                                        <th>Scheme</th>  
                                        <th>Straw Number</th>  
                                        <th>AIType</th>   
                                        <th>Status of Reproductive Organ</th> 
                                        <th>Stage of Oestrus</th>
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
            <p>&copy; 2020 All Rights Reserved | Design by <a href="http://praxello.com/"
                    target="_blank">Praxello</a></p>
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
    <script src="js/reports.js" type="text/javascript"></script>
</body>
</html>
<?php
}else{
    header("Location:index.php");
}?>
