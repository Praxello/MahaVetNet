<!DOCTYPE HTML>
<html>

    <head>
        <title>MahaVetNet | Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />


        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />

        <!-- font-awesome icons CSS-->
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- //font-awesome icons CSS-->

        <!-- side nav css file -->
        <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
        <!-- side nav css file -->

        <!-- js-->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/modernizr.custom.js"></script>

        <!--webfonts-->
        <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <!--//webfonts-->

        <!-- Metis Menu -->
        <script src="js/metisMenu.min.js"></script>
        <script src="js/custom.js"></script>
        <link href="css/custom.css" rel="stylesheet">
        <!--//Metis Menu -->
         <style media="screen">
         body{
padding:0;
margin:0;
}
.vid-container{
position:relative;
height:100vh;
overflow:hidden;
}
.bgvid{
position:absolute;
left:0;
top:0;
width:100vw;
}
.inner-container{
width:400px;
height:400px;
position:absolute;
top:calc(50vh - 200px);
left:calc(50vw - 200px);
overflow:hidden;
}
.bgvid.inner{
top:calc(-50vh + 200px);
left:calc(-50vw + 200px);
filter: url("data:image/svg+xml;utf9,<svg%20version='1.1'%20xmlns='http://www.w3.org/2000/svg'><filter%20id='blur'><feGaussianBlur%20stdDeviation='10'%20/></filter></svg>#blur");
-webkit-filter:blur(10px);
-ms-filter: blur(10px);
-o-filter: blur(10px);
filter:blur(10px);
}
.box{
position:absolute;
height:100%;
width:100%;
font-family:Helvetica;
color:#fff;
background:rgba(0,0,0,0.13);
padding:30px 0px;
}
.box h1{
text-align:center;
margin:30px 0;
font-size:30px;
}
.box input{
display:block;
width:300px;
margin:20px auto;
padding:15px;
background:rgba(0,0,0,0.2);
color:#fff;
border:0;
}
.box input:focus,.box input:active,.box button:focus,.box button:active{
outline:none;
}
.box button{
background:#2ecc71;
border:0;
color:#fff;
padding:10px;
font-size:20px;
width:330px;
margin:20px auto;
display:block;
cursor:pointer;
}
.box button:active{
background:#27ae60;
}
.box p{
font-size:14px;
text-align:center;
}
.box p span{
cursor:pointer;
color:#666;
}
         </style>
    </head>

    <body>

        <div class="main-content">
            <!--left-fixed -navigation-->

            <!-- main content start-->

            <div class="vid-container">
              <video class="bgvid" autoplay="autoplay" muted="muted" preload="auto" loop>
                  <source src="cow.mp4" type="video/mp4">
              </video>
              <div class="inner-container">
                <video class="bgvid inner" autoplay="autoplay" muted="muted" preload="auto" loop>
                  <source src="cow.mp4" type="video/mp4">
                </video>
                <div class="box">
                  <h1>Login</h1>
                  <form id="signin" method="post">
                      <div class="form-group">
                          <input type="text" class="form-control" name="usrname" id="usrname" placeholder="Enter Your Username" required="">
                      </div>
                      <div class="form-group">
                          <input type="password" name="passwrd" id="passwrd" class="form-control" placeholder="Password" required="">
                      </div>
                      <div class="forgot-grid">
                          <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
                           <div class="clearfix"> </div>
                      </div>
                      <input type="submit" name="Sign In" value="Sign In">
                  </form>
                </div>
              </div>

            <!-- <video autoplay muted loop id="myVideo">
                <source src="cow.mp4" type="video/mp4">

            </video> -->
            <!-- <div id="page-wrapper">
                <div class="main-page login-page ">
                  <div class="vid-container">
                    <video class="bgvid" autoplay="autoplay" muted="muted" preload="auto" loop>
                        <source src="cow.mp4" type="video/mp4">
                    </video>
                    <div class="inner-container">
                      <video class="bgvid inner" autoplay="autoplay" muted="muted" preload="auto" loop>
                        <source src="cow.mp4" type="video/mp4">
                      </video>
                    <h2 class="title1">Login</h2>
                    <div class="widget-shadow">
                        <div class="login-body">
                            <form id="signin" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="usrname" id="usrname" placeholder="Enter Your Username" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="passwrd" id="passwrd" class="form-control" placeholder="Password" required="">
                                </div>
                                <div class="forgot-grid">
                                    <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
                                     <div class="clearfix"> </div>
                                </div>
                                <input type="submit" name="Sign In" value="Sign In">
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
            </div> -->
            <!--footer-->
            <div class="footer">
                <p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
            </div>
            <!--//footer-->
        </div>
        <script src="jscode/apis.js"></script>
        <script src="jscode/login.js"></script>
    </body>

</html>
