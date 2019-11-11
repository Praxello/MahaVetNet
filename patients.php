<?php session_start();
if(isset($_SESSION['branchId'])){
    $brId = $_SESSION['branchId'];
    $drid = $_SESSION['userId'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Mahavetnet | Vaccination | Deworming</title>
 <script type="application/x-javascript">
 addEventListener("load", function() {
     setTimeout(hideURLbar, 0);
 }, false);

 function hideURLbar() {
     window.scrollTo(0, 1);
 }
 </script>
 <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
 <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
 <!-- <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
 <!-- Custom CSS -->
 <link href="css/style.css" rel='stylesheet' type='text/css' />
 <link rel="icon" type="images/png" sizes="16x16" href="images/mlogo.png">
 <!-- font-awesome icons CSS -->
 <link href="css/font-awesome.css" rel="stylesheet">
 <!-- //font-awesome icons CSS -->
<link href="bootstrap/asterisks.css" rel="stylesheet">
 <!-- side nav css file -->
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
 <!-- side nav css file -->

 <!-- js-->


 <!--webfonts-->
 <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
     rel="stylesheet">
 <!--//webfonts-->

 <!-- Metis Menu -->

 <link href="css/custom.css" rel="stylesheet">
 <!-- <link href="sweetalert/sweetalert.css" rel="stylesheet"> -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
	  <?php include "leftsidebar.php"; ?>
		<?php include "header.php"; ?>
    <input type="hidden"  id="brid" value="<?php echo $brId ;?>"/>
    <input type="hidden"  id="drid" value="<?php echo $drid ;?>"/>
		<div id="page-wrapper">
			<div class="main-page">
        <div id="firsttable">
				<h3 class="title1">Vaccination / Deworming</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
          <div class="row" id="customerstyletable" style="display:block;">
            <div class="col-md-12" >
            <div class="table-responsive">
              <table id="styletbl" class="display nowrap table table-hover  table-bordered">
                <thead>
                  <tr>
                    <!-- <th style="width:10%;">MVN ID</th>
                    <th style="width:20%;">Animal Name</th>
                    <th style="width:10%;">Species/ Breed</th> -->
                    <th style="width:10%;">Owner</th>
                    <th style="width:60%;">Address</th>
                    <th style="width:10%;">Mobile no</th>
                    <th style="width:10%;">Vaccination</th>
                    <th style="width:10%;">Deworming</th>
                  </tr>
                </thead>
                <tbody id="styletbldata">
                </tbody>
              </table>
            </div>
            </div>
            </div>
				</div>
        </div>
        <!-- The given code for vaccination page -->

          <div  id="secondtable" style="display:none;">
            <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    <div id="vaccinationmsg"></div>
                  </div>
              </div>
            </div>
            <input type="hidden"  id="oid" value=""/>
            <input type="hidden"  id="aid" value=""/>
            <h3 class="title1">Vaccination</h3>
            <div class="blank-page widget-shadow scroll" id="style-2 div1">
              <div class="row" id="vaccinationtable" style="display:block;">
                <div class="row">
                  <div class="col-md-6">
                    <button type="button"  class="btn btn-primary" onclick="backmain1()" style="float:left"> Main Page</button>

                </div>
                  <div class="col-md-6">
                    <button type="button" id="button1" class="btn btn-success" onclick="addStyle()" style="float:right"> New Vaccination</button>
                    <div id="data"></div>
                </div>
                </div>
                <div class="col-md-12" >
                <div class="table-responsive">
                  <table id="vaccinationtbl" class="display nowrap table table-hover  table-bordered">
                    <thead>
                      <tr>
                        <th>Medicine Name</th>
                        <th>Visit Date</th>
                        <th>Batch Number</th>
                        <th>Expiry Date</th>
                        <th>Total Animal</th>
                        <th>Total Fees</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="vaccinationtbldata">
                    </tbody>
                  </table>
                </div>
                </div>
                </div>
                <div class="row" id="vaccinationtableform" style="display:none;">

                  <div class="col-sm-12">
                    <div class="card">
                      <div class="row">
                      <input type="hidden" id="treatmentid"/>

                        <div class="col-sm-12">
                          <div class="col-sm-12">
                          <div class="form-group required">
                          <label class="control-label">Medicine Name</label>
                          <select  class="form-control"  id="medicinename" style="width:100%;"  multiple>
                          </select>
                          </div>
                          </div>
                        </div>
                      <div class="col-sm-12">
                        <div class="col-sm-6">
                          <div class="form-group required">
                            <label class="control-label">Visit Date</label>
                            <input type="date" class="form-control" id="visitdate"  title="Visit Date"/>

                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group required">
                            <label class="control-label">Batch Number</label>
                            <input type="text" class="form-control" id="batchnumber"  title="Batch Number"/>

                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group required">
                            <label class="control-label">Vaccine Expiry Date</label>
                            <input type="date" class="form-control" id="expirydate"  title="Vaccine Expiry Date"/>

                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group ">
                            <label class="control-label">Wastage Quantity</label>
                            <input type="text" class="form-control" id="wastageqty"  title="Wastage Quantity" placeholder="Wastage Quantity" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Goat</label>
                            <input type="text" class="form-control" id="nogoat"  title="No of Goat" value="0" placeholder="No of Goat" onkeyup="vacciamount()" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Cow</label>
                            <input type="text" class="form-control" id="nocow"  title="No of Cow" value="0" placeholder="No of Cow"  onkeyup="vacciamount()" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Bull</label>
                            <input type="text" class="form-control" id="nobull"  title="No of Bull" value="0" placeholder="No of Bull" onkeyup="vacciamount()" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Calf</label>
                            <input type="text" class="form-control" id="nocalf"  title="No of Calf" value="0" placeholder="No of Calf" onkeyup="vacciamount()" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Buffalo</label>
                            <input type="text" class="form-control" id="nobuffalo"  title="No of Buffalo" value="0" placeholder="No of Buffalo"  onkeyup="vacciamount()" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group ">
                            <label class="control-label">Redka</label>
                            <input type="text" class="form-control" id="noredka"  title="No of Redka" value="0" placeholder="No of Redka" onkeyup="vacciamount()" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Sheep</label>
                            <input type="text" class="form-control" id="nosheep"  title="No of Sheep" value="0" placeholder="No of Sheep" onkeyup="vacciamount()" onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Poultry</label>
                            <input type="text" class="form-control" id="nopoultry"  title="No of Poultry" value="0" placeholder="No of Poultry" onkeyup="vacciamount()"onkeypress="javascript:return isNumberKey(event)"/>

                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Fees</label>
                            <input type="text" class="form-control" id="nofees"  title="Total Fees"/>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Total Animals = &nbsp;</label><span class="badge badge-info" id="totanimal"></span>
                          </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                            <button class="btn btn-success" id="savevaccinationbtn" >Save</button>
                            <button class="btn btn-success" id="updatevaccinationbtn" style="display:none;">Update</button>
                            <button class="btn btn-secondary" id="reloadbtn1" >Back</button>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- The given code for Deworming page -->

          <div  id="thirdtable" style="display:none;">
            <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    <div id="dewormingmsg"></div>
                  </div>
              </div>
            </div>
            <input type="hidden"  id="doid" value=""/>
            <input type="hidden"  id="daid" value=""/>
          <h3 class="title1">Deworming</h3>
            <div class="blank-page widget-shadow scroll" id="style-2 div1">
              <div class="row" id="dewormingtable" style="display:block;">

                <div class="row">
                  <div class="col-md-6">
                    <button type="button"  class="btn btn-primary" onclick="backmain()" style="float:left"> Main Page</button>

                </div>
                  <div class="col-md-6">
                    <button type="button" id="button1" class="btn btn-success" onclick="daddStyle()" style="float:right"> New Deworming</button>
                    <div id="data"></div>
                </div>
                </div>
                <div class="col-md-12" >
                <div class="table-responsive">
                  <table id="dewormingtbl" class="display nowrap table table-hover  table-bordered">
                    <thead>
                      <tr>
                        <tr>
                          <th>Medicine Name</th>
                          <th>Visit Date</th>
                          <!-- <th>Batch Number</th>
                          <th>Expiry Date</th> -->
                          <th>Total Animal</th>
                          <th>Total Fees</th>
                          <th>Action</th>
                        </tr>
                      </tr>
                    </thead>
                    <tbody id="dewormingtbldata">
                    </tbody>
                  </table>
                </div>
                </div>
                </div>
                <div class="row" id="dewormingtableform" style="display:none;">

                  <div class="col-sm-12">
                    <div class="card">
                      <div class="row">
                      <input type="hidden" id="dtreatmentid"/>

                      <div class="col-sm-12">
                        <div class="col-sm-12">
                      <div class="form-group required">
                        <label class="control-label">Medicine Name</label>
                        <select  class="form-control"  id="dmedicinename" style="width:100%;"  multiple>
                          <!-- <option value="">Select Medicine Name</option> -->

                        </select>
                      </div>
                      </div>
                      </div>

                    <div class="col-sm-12">
                      <div class="col-sm-6">
                        <div class="form-group required">
                          <label class="control-label">Visit Date</label>
                          <input type="date" class="form-control" id="dvisitdate"  title="Visit Date"/>

                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group required">
                          <label class="control-label">Type</label>
                          <select  class="form-control"  id="dmedicinetype" style="width:100%;">
                            <option value="">Select Type</option>
                            <option value="Endoparasite">Endoparasite</option>
                            <option value="Ectoparasite">Ectoparasite</option>
                          </select>

                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Goat</label>
                          <input type="text" class="form-control" id="dnogoat"  title="No of Goat" value="0" placeholder="No of Goat" onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Cow</label>
                          <input type="text" class="form-control" id="dnocow"  title="No of Cow" value="0" placeholder="No of Cow"  onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Bull</label>
                          <input type="text" class="form-control" id="dnobull"  title="No of Bull" value="0" placeholder="No of Bull" onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Calf</label>
                          <input type="text" class="form-control" id="dnocalf"  title="No of Calf" value="0" placeholder="No of Calf" onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Buffalo</label>
                          <input type="text" class="form-control" id="dnobuffalo"  title="No of Buffalo" value="0" placeholder="No of Buffalo"  onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group ">
                          <label class="control-label">Redka</label>
                          <input type="text" class="form-control" id="dnoredka"  title="No of Redka" value="0" placeholder="No of Redka" onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Sheep</label>
                          <input type="text" class="form-control" id="dnosheep"  title="No of Sheep" value="0" placeholder="No of Sheep" onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Poultry</label>
                          <input type="text" class="form-control" id="dnopoultry"  title="No of Poultry" value="0" placeholder="No of Poultry" onkeyup="damount()" onkeypress="javascript:return isNumberKey(event)"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Fees</label>
                          <input type="text" class="form-control" id="dnofees"  title="Total Fees"/>

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Total Animals = &nbsp;</label><span class="badge badge-info" id="dtotanimal"></span>


                        </div>
                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">
                          <button class="btn btn-success" id="dsavebtncustomerstyle" >Save</button>
                          <button class="btn btn-success" id="dupdatebtncustomerstyle" style="display:none;">Update</button>
                          <button class="btn btn-secondary" id="dreloadbtn" >Back</button>
                        </div>
                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        </div>

			</div>
		</div>


		<?php include "footer.php"; ?>
	</div>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/metisMenu.min.js"></script>
  <script src="js/custom.js"></script>
  <!-- <script src="js/jquery-1.11.1.min.js"></script> -->
  <script src="jscode/apis.js" type="text/javascript"></script>
  <script src="javascript/validation.js"></script>
  <!-- <script src="js/modernizr.custom.js"></script> -->
  <!-- <script src="js/metisMenu.min.js"></script>
  <script src="js/custom.js"></script> -->
	<!-- <script src='js/SidebarNav.min.js' type='text/javascript'></script> -->
	<!-- <script>
      $('.sidebar-menu').SidebarNav()
  </script> -->
  <!-- <script src="js/bootstrap.js"> </script> -->
  <script src="bootstrap/js/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <link href="select2/select4.css" rel="stylesheet" />
  <script src="select2/select4.js" type="text/javascript"></script>
  <script src="datatables/datatables.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
  <script src="datatables/datatablebootstrap4.min.js"></script>
  <!-- <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script> -->
  <!-- <script src="datatables/datatables-init.js"></script> -->
  <!-- <script src="sweetalert/sweetalert.min.js"></script> -->
  <script src="javascript/patients.js"></script>
  <!-- <script src="javascript/vaccination.js"></script> -->
  <script src="js/classie.js"></script>
  <script src="js/sidebarclose.js"></script>
  <script src="js/jquery.nicescroll.js"></script>
  <script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->


</body>
</html>
<?php
}else{
    header("Location:index.php");
}?>
