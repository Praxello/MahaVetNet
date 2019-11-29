<?php session_start();
if(!isset($_SESSION['branchId'])){
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>MahaVetNet | Login Screen</title>
    <!-- Meta tag Keywords -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Mahavetnet Login Animal Husbandary Department" />
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- Meta tag Keywords -->
    <!-- css files -->
    <link rel="stylesheet" href="css_1/style.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <link rel="icon" type="images/png" sizes="16x16" href="images/mlogo.png">
    <link rel="stylesheet" href="css_1/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <!-- //css files -->
    <!-- web-fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
    <link href="//fonts.googleapis.com/css?family=Marck+Script&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link
        href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=cyrillic,latin-ext"
        rel="stylesheet">
    <style>
    @media screen and (max-width: 1440px) {
        .footer {
            padding-bottom: 20vw;
        }
	}
	@media only screen and (max-device-width: 480px) {
.ahd{
	width:18%;
}
.praxello{
	width:20%;
	margin-top:-20%!important;
}
.example{
	margin-left:-22%;
	font-size: 30px;
}
}
    </style>

    <!-- //web-fonts -->
</head>

<body>

    <div class="video-w3l" data-vide-bg="video/cow">
        <!-- <div class="video-w3l" data-vide-bg="video/cow"> -->
        <div class="row">
            <h1>
            <span><img  src="images/mvn.png" alt=""> </span>
            </h1>
            <!-- <div class="col-sm-12">
                <h1>
                    <span><img class="ahd" src="images/AHD.png" alt="" style="float:left;"> </span>
                </h1>

            </div> -->
            <!-- <div class="col-sm-4">
                <h1>
                    <span style="color: black;font-family: Arial Rounded MT;font-weight: bold;"
                        class="example">MahaVetNet</span>
                </h1>
            </div>
            <div class="col-sm-4">
                <h1>
                    <span ><img class="praxello" src="images/praxello.png" alt="" style="float:right;"> </span></h1>
            </div> -->

        </div>

        <!-- title -->

        <!-- //title -->
        <!-- content -->
        <div class="sub-main-w3">

            <form id="signin" method="post">
            <!-- <strong style="color:red;text-align:center;">Note: Please confirm your VD by clicking on the option under profile settings on the top right menu item.</strong> -->
                <div id="wait"
                    style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
                    <img src='images/spinner.gif' width="64" height="64" />
                    <br>Loading..</div>
                <div class="form-style-agile">
                    <label style="color:black;">
                        <i class="fas fa-user" ></i>Username</label>
                    <input placeholder="Username" name="Name" type="text" required="" id="usrname" style="border: 1px solid black;">
                </div>
                <div class="form-style-agile">
                    <label  style="color:black;">
                        <i class="fas fa-unlock-alt"></i>Password</label>
                    <input placeholder="Password" name="Password" type="password" required="" id="passwrd" style="border: 1px solid black;">
                </div>
                <!-- switch -->
                <div class="checkout-w3l">
					<!-- <div class="demo5">
						<div class="switch demo3">
							<input type="checkbox">
							<label>
								<i></i>
							</label>
						</div>
					</div> -->

				</div>
                <!-- //switch -->
                <input type="submit" value="Log In">

            </form>
        </div>
        <!-- //content -->

        <!-- copyright -->

        <!-- //copyright -->
        <div class="footer">
            <p style="color:red;">&copy; 2020 All rights reserved | Design by
                <a href="http://praxello.com" target="_blank">Praxello Solutions.</a>
            </p>
        </div>
    </div>

    <script src="js_1/jquery-2.2.3.min.js"></script>
    <script src="jscode/apis.js"></script>
    <script src="jscode/login.js"></script>
    <!-- Jquery -->

    <!-- //Jquery -->

    <!-- Video js -->
    <script src="js_1/jquery.vide.min.js"></script>
    <!-- //Video js -->

</body>

</html>
<?php
}else{
header('Location:dashboard.php');
}?>
