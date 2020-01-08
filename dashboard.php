<?php session_start();
if(isset($_SESSION['branchId'])){
    $brId = $_SESSION['branchId'];
    $drid = $_SESSION['userId'];
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>MahaVetNet | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Mahavetnet AHD" />
    <!-- <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script> -->

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link rel="icon" type="images/png" sizes="16x16" href="images/mlogo.png">
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />

    <!-- font-awesome icons CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons CSS-->

    <!-- side nav css file -->
    <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- //side nav css file -->

    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>

    <!--webfonts-->
    <!-- <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet"> -->
    <!--//webfonts-->

    <!-- chart -->
    <script src="js/Chart.js"></script>
    <!-- //chart -->

    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
    <style>
    #animaldiv {
        width: 100%;
        height: 400px;
        margin: 0 auto
    }

    #chartdiv1 {
        min-width: 300px;
        height: 358px;
        margin: 0 auto
    }
    .widget2{
        width: 295px;
    }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141032238-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-141032238-1');
</script>

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-141032238-1', 'auto');
ga('send', 'pageview');
</script>

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N9B5PM5');</script>

    <!--pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <script src="js/pie-chart.js" type="text/javascript"></script>

    <!-- //pie-chart -->
    <!-- index page sales reviews visitors pie chart -->

    <!-- requried-jsfiles-for owl -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <script src="js/owl.carousel.js"></script>

    <!-- //requried-jsfiles-for owl -->
</head>

<body class="cbp-spmenu-push">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9B5PM5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <input type="hidden" id="branchid" value="<?php echo $brId;?>">
    <div class="main-content">
        <?php include 'leftsidebar.php';?>
        <!--left-fixed -navigation-->

        <!-- header-starts -->
        <?php include 'header.php';?>
        <!--left-fixed -navigation-->


        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="col_3">
                    <div class="col-md-3 widget2">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-rupee icon-rounded"></i>
                            <div class="stats">
                                <h5><strong id="revenue"></strong></h5>
                                <span>Total Revenue</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  widget2">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong id="vdmarked"></strong></h5>
                                <span>Total VD Marked</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widget2">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-money user2 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong id="caseshandled"></strong></h5>
                                <span>Cases Handled</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widget2">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong id="totalAi"></strong></h5>
                                <span>Active Institues</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widget2">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                            <div class="stats">
                                <h5><strong id="totalartins"></strong></h5>
                                <span>Total AI</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <?php if($brId > 6000){?>
                  
                <div class="row-one widgettable">
                    <div class="col-md-7 content-top-2 card">
                        <div class="agileinfo-cdr">
                            <div class="card-header">
                                <h3>Downloads</h3>
                            </div>

                            <div id="chartdiv1">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 stat">
                        <div class="content-top-1">
                            <div class="col-md-6 top-content">
                                <h5>Castration</h5>
                                <label id="castration"></label>
                            </div>
                            <div class="col-md-6 top-content">
                                <h5>Calf Born</h5>
                                <label id="totalCB"></label>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="content-top-1">
                            <div class="col-md-6 top-content">
                                <h5>Vaccinations</h5>
                                <label id="vaccinations"></label>
                            </div>
                            <div class="col-md-6 top-content">
                                <h5>Total PD</h5>
                                <label id="totalPD"></label>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="content-top-1">
                            <div class="col-md-6 top-content">
                                <h5>Deworming</h5>
                                <label id="deworming"></label>
                            </div>
                            <div class="col-md-6 top-content">
                                <h5>IPD</h5>
                                <label id="ipd"></label>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="col-md-2 stat">
                        <div class="content-top">
                            <div class="top-content facebook">
                                <a href="#"><i class="fa fa-download">
                                    <span style="font-size: xx-large;font-weight: bolder;">Downloads</span>
                                </i></a>
                            </div>
                            <ul class="info">
                                <li class="col-md-6"><b id="totalApps"></b>
                                    <p>Total</p>
                                </li>
                                <li class="col-md-6"><b id="totalDownload"></b>
                                    <p>Downloads</p>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                        <div class="content-top">
                            <div class="top-content twitter">
                                <a href="#"><i class="fa fa-paw">
                                <span style="font-size: xx-large;font-weight: bolder;">Animals</span>
                                </i></a>
                            </div>
                            <ul class="info">
                                <li class="col-md-6"><b id="totalAnimals"></b>
                                    <p>Animals</p>
                                </li>
                                <li class="col-md-6"><b id="taggedAnimal"></b>
                                    <p>Tagged</p>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                        <div class="content-top">
                            <div class="top-content google-plus">
                                <a href="#"><i class="fa fa-users">
                                <span style="font-size: xx-large;font-weight: bolder;">Farmers</span>
                                </i></a>
                            </div>
                            <ul class="info">
                                <li class="col-md-6"><b id="totalFarmers"></b>
                                    <p>Farmers</p>
                                </li>
                                <li class="col-md-6"><b id="mobiles"></b>
                                    <p>Downloads</p>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="charts">
                    <div class="col-md-4 charts-grids widget">
                        <div class="card-header">
                            <h3>Revenue</h3>
                        </div>
                        <div id="totalRevenue"></div>
                    </div>
                    <div class="col-md-4 charts-grids widget states-mdl">
                        <div class="card-header">
                            <h3>Active Institues</h3>
                        </div>
                        <div id="totalVds"></div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                
                <div class="charts">
                    <div class="col-md-4 charts-grids widget">
                    <div class="card-header">
                            <h3></h3>
                        </div>
                        <div id="castrationDiv"></div>
                    </div>
                    <div class="col-md-4 charts-grids widget states-mdl">
                    <div class="card-header">
                            <h3></h3>
                        </div>
                        <div id="animaldiv"></div>

                    </div>
                    <div class="clearfix"> </div>
                </div>
              

                <div class="charts">
                    <div class="col-md-4 charts-grids widget">
                        <div class="card-header">
                            <h3>Dewoming | Vaccinations</h3>
                        </div>
                        <div id="dewormingmap"></div>
                    </div>
                    <div class="col-md-4 charts-grids widget states-mdl">
                        <div class="card-header">
                        <h3>Animals | Farmers</h3>
                        </div>
                        <div id="farmersanimalDiv"></div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                
                <div class="charts">
                    <div class="col-md-12 charts-grids states-mdl">
                        <div class="card-header">
                            <h3>Symptoms</h3>
                        </div>
                        <div id="symptomschart"></div>
                    </div>
                    
                    <div class="clearfix"> </div>
                </div>
           <?php 
                }?>
            </div>
        </div>
        <!--footer-->
        <div class="footer">
            <p>&copy; 2020 All Rights Reserved | Design by <a href="http://praxello.com/"
                    target="_blank">Praxello Solutions</a></p>
        </div>
        <!--//footer-->
    </div>

    <!-- new added graphs chart js-->

    <script src="js/Chart.bundle.js"></script>
    <script src="js/utils.js"></script>


    <!-- new added graphs chart js-->

    <!-- Classie -->
    <!-- for toggle left push menu script -->
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
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->


    <!-- //side nav js -->

    <!-- for index page weekly sales java script -->
    <script src="js/SimpleChart.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <!-- //for index page weekly sales java script -->

    <script src="jscode/apis.js" type="text/javascript"></script>
    <script src="js/index3.js" type="text/javascript"></script>
    <script src="js/index_4.js" type="text/javascript"></script>
    <script src="js/index_5.js" type="text/javascript"></script>
    <script src="js/animal_map.js" type="text/javascript"></script>
    <script src="js/activeInst.js" type="text/javascript"></script>
    <script src="js/total_revenue_map.js" type="text/javascript"></script>
    <script src="js/dashboard_data.js" type="text/javascript"></script>
    <script src="js/index_6.js" type="text/javascript"></script>
    <script src="js/index_7.js" type="text/javascript"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
    <!-- //Bootstrap Core JavaScript -->
</body>

</html>
<?php
}else{
    header("Location:index.php");
}?>
