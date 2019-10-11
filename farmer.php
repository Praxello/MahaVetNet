<!DOCTYPE HTML>
<html>

<head>
    <title>MahaVetNet | Farmer List | add farmer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
            <div class="main-page general">
                <h2 class="title1">General Elements</h2>
                <div class="modals widget-shadow">
                    <h4 class="title2">Import Farmers</h4>
                    <h6 class="title2"><code>use sample csv</code></h6>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <form id="farmerUpload" name="farmerup" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="farmerfile">File</label>
                                <input type="file" class="form-control form-control-sm"
                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                    id="farmerfile" name="farmerfile" runat="server" required />
                            </div>
                            <input type="submit" name="submit" class="btn btn-success submitBtn" value="Import" />
                            <a href="sample_download_farmer.php" type="button" class="btn btn-warning">Download Sample
                                File</a>
                        </form>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div id="farmerPage">
                    <input type="hidden"  id="brid" value="<?php echo $_SESSION['branchId'];?>"/>
                    <input type="hidden"  id="drid" value="<?php echo $_SESSION['userId'];?>"/>
                <div class="tables">
                    <div class="table-responsive bs-example widget-shadow">

                       
                            <h4>Farmer List:</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="button1" class="btn btn-success" style="float:right"
                                        data-toggle="modal" data-target="#farmerModal"> New
                                        Farmer</button>
                                </div>
                            </div>
                            <table class="table table-bordered farmer-table">
                                <thead>
                                    <tr>
                                        <th>Owner Name</th>
                                        <th>Contact Number</th>
                                        <th>Gender</th>
                                        <th>
                                            Contact Address
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="farmer-data"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="loadAnimalPage" style="display:none;">
                <div class="tables">
                    <div class="table-responsive bs-example widget-shadow">

                       
                            <h4>Animal List:</h4>
                            <div class="row">
                                <div class="col-md-12">
                                <button type="button" id="loadfirstpage" class="btn btn-success"> Back</button>
                                        
                                    <button type="button" id="button1" class="btn btn-success" style="float:right"
                                        data-toggle="modal" data-target="#animalModal"> New
                                        Animal</button>
                                </div>
                            </div>
                            <table class="table table-bordered animal-table">
                                <thead>
                                    <tr>
                                        <th>Animal Name</th>
                                        <th>Breed</th>
                                        <th>Gender</th>
                                        <th>
                                            Species
                                        </th>
                                        <th>Weight</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="animal-data">
                            </table>
                        </div>
                    </div>
                </div>
                <?php include 'add_farmer_modal.php';?>
                <?php include 'edit_farmer_modal.php';?>
                <?php include 'add_animal_modal.php';?>
                <?php include 'edit_animal_modal.php';?>

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
    <script src="jscode/animal.js" type="text/javascript"></script>
</body>

</html>