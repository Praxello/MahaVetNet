<?php session_start();
if(isset($_SESSION['branchId'])){
    $brId = $_SESSION['branchId'];
    $drid = $_SESSION['userId'];
?>
<!DOCTYPE HTML>
<html>
<head>
 <?php include "title.php"; ?>
 <link href="css/loader.css" rel="stylesheet">
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
 <style media="screen">
  .card-body .col-sm-6{
    background-color: white;
  }
 </style>
 <!-- <link href="sweetalert/sweetalert.css" rel="stylesheet"> -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
    <div id="wait"></div>
	  <?php include "leftsidebar.php"; ?>
		<?php include "header.php"; ?>
    <input type="hidden"  id="brid" value="<?php echo $brId ;?>"/>
    <input type="hidden"  id="drid" value="<?php echo $drid ;?>"/>
    <input type="hidden"  id="currentdate" value="<?php echo date('Y-m-d');?>"/>
		<div id="page-wrapper">
			<div class="main-page">
        <div id="firsttable">
				<h3 class="title1">All Patient</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
          <div class="row" id="customerstyletable" style="display:block;">
            <div class="col-md-12" >
            <div class="table-responsive">
              <table id="styletbl" class="display nowrap table table-hover  table-bordered">
                <thead>
                  <tr>
                    <!-- <th style="width:10%;">MVN ID</th>-->
                    <th style="width:20%;">Animal Name</th>
                    <th style="width:5%;">Species</th>
                    <th style="width:5%;">Breed</th>
                    <th style="width:5%;">Gender</th>
                    <th style="width:10%;">Owner</th>
                    <th style="width:35%;">Address</th>
                    <th style="width:10%;">Mobile no</th>
                    <th style="width:10%;">Action</th>
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

        <!-- The given code for OPD Case Paper page -->

          <div  id="fourthtable" style="display:none;">
            <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    <div id="opdcasemsg"></div>
                  </div>
              </div>
            </div>
            <input type="hidden"  id="opdoid" value=""/>
            <input type="hidden"  id="opdaid" value=""/>
            <!-- <div class="row">
              <div class="col-md-3">
              <h3 class="title1">OPD Case Paper</h3>
             </div>
             <div class="col-md-6">
             </div>
             <div class="col-md-3">
               <div class="r3_counter_box">

               </div>
            </div>
           </div> -->
            <div class="row">
              <div class="col_3">
                  <div class="col-md-3">
                    <div class="r3_counter_box">
                            <i class="pull-left fa fa-empty icon-rounded"></i>
                            <div class="stats">
                              <span><strong>Owner Name</strong></span>
                              <h5><div id="opdowner"></div></h5>
                            </div>
                        </div>
                  </div>
                  <div class="col-md-3">
                    <div class="r3_counter_box">
                            <!-- <i class="pull-left fa fa-empty user1 icon-rounded"></i> -->
                            <div class="col-sm-6">
                            <img id="setnavanimal" src='http://praxello.com/ahimsa/animalphotos/0.jpg'class="rounded-circle" style="width: 40px;height: 45px;" alt="No Img"></img>
                            </div>
                            <div class="col-sm-6">
                            <div class="stats">
                              <label>Animal Name</label>
                              <div id="opdanimalname"></div>
                            </div>
                            </div>
                        </div>
                  </div>
                  <div class="col-md-3">
                    <div class="r3_counter_box">
                            <div class="stats">
                              <label><font color='red'>Species</font>/<font color='green'>Breed</font>/<font color='blue'>Gender</font></label>
                              <div id="opdanimalage"></div>
                            </div>

                        </div>
                  </div>
                  <!-- <div class="col-md-3">
                  <div class="r3_counter_box">

                    <div class="stats">
                      <label>Gender</label>

                      <div id="opdanimalgender"></div>
                    </div>
                        </div>
                   </div> -->
                     <!-- <div id="opdanimalweight"></div>/ -->
                  <div class="col-md-3">
                    <div class="r3_counter_box">
                            <!-- <i class="pull-left fa fa-empty dollar2 icon-rounded"></i>
                            <div class="stats">
                              <span><strong>Gender</strong></span>
                              <h5><div id="opdanimalgender"></div></h5>
                            </div> -->

                        <label class="control-label">Select Date</label><font color="red">*</font>
                        <select  class="form-control"  id="opdcasepaperdate" style="width:100%;" onchange="selectcasepaper()">
                          <option value="">Select Case Paper Date</option>
                        </select>
                        </div>
                   </div>
                  <div class="clearfix"> </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-6 validation-grids widget-shadow" data-example-id="basic-forms" style="overflow-y: scroll; height:600px;">
                <div class="row">
  							<div class="form-title" style="background-color: yellow;">
                  <center><label>IPD Case Paper Form</label></center>
  							</div>
                <!-- collapse -->
  							<div class="form-body" >
  								<form id="opdform">
                    <div class="col-sm-6">
  									<div class="form-group">
                      <label class="control-label">Select Date</label><font color="red">*</font>
  										<input type="date" class="form-control" id="opdselectdate" placeholder="Select Date" required>
  									</div>
                    </div>
                    <div class="col-sm-6">
  									<div class="form-group">
                      <label class="control-label">Select Visit Type</label><font color="red">*</font>
                      <select  class="form-control"  id="opdvisittype" style="width:100%;" required>
                        <option value="">Select Visit Type</option>
                        <option value="HQ">HQ</option>
                        <!-- <option value="Tour">Tour</option>
                        <option value="Camp">Camp</option> -->
                      </select>
                    </div>
                    </div>
                    <div class="col-sm-6">
  									<div class="form-group">
                      <label class="control-label">Select Symptoms</label>
                      <input type="text" class="form-control" id="textsymptoms" placeholder="Select Symptoms" required>
  									</div>
                    </div>
                    <div class="col-sm-6">
  									<div class="form-group">
                      <label class="control-label">Select Symptoms (Dropdown)</label>
                      <select  class="form-control"  id="selectsymptoms" style="width:100%;" onchange="symtomsdrop();" multiple >

                        <!-- <option value="HQ">HQ</option>
                        <option value="Tour">Tour</option>
                        <option value="Camp">Camp</option> -->
                      </select>
  									</div>
                    </div>
                    <div class="col-sm-6">
  									<div class="form-group">
                      <label class="control-label">Diagnosis</label>
                      <input type="text" class="form-control" id="textdiagnosis" placeholder="Enter Diagnosis" required>
  									</div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                      <div style="padding-top: 21px;"></div>
                      <button type="reset" class="btn btn-warning" >Reset</button>
                    </div>
                  </div>
  								</form>
  							</div>
              </div>
              <div class="row">
                <div class="form-title" style="background-color: #aed5ae;">
                  <center><label>Medication</label></center>
  							</div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <select  class="form-control"  id="selectmedication" style="width:100%;" onchange="selectmedication();">

                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="table-responsive">
                  						<table class="table table-bordered">
                                <thead>
                                  <tr>
                                  <th style="width:60%;">Medicine Name</th>
                                  <th style="width:20%;">Instruction</th>
                                   <th style="width:10%;">Days</th>
                                   <th style="display:none;width:10%;">Mid</th>
                                   <th style="width:10%;">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="medicinetab">
                                </tbody>
                                </table>
                  </div>
					     </div>
              </div>

  						</div>
              <div class="col-md-6  widget-shadow" data-example-id="basic-forms" style="overflow-y: scroll; height:600px;">
                <div id="accordion">
                  <div class="card">
                    <div class="row">
                      <div class="form-title" style="background-color: #f4deb8;">
                        <center><label>Treatment Type</label></center>
        							</div>
                    </div>

                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        	<div class="form-title" style="background-color: beige;">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" style="width: 100%;text-align: left;" aria-expanded="true" aria-controls="collapseOne">
                          Castration<input id="shidden1" type="hidden" value="0"></input><div id="head1" style="float: right;"></div>
                        </button>

                          </div>
                      </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <form id="one1" method="post">
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Number of Animal</label>
                            <input type="text" class="form-control" id="nocastrated" onkeypress="javascript:return isNumberKey(event)" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Procedure</label>
                            <select  class="form-control"  id="noprocedurecas" style="width:100%;" required>
                              <option value="">Select Procedure</option>
                              <option value="Closed">Closed</option>
                              <option value="Open">Open</option>
                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                          <button type="submit"  class="btn btn-primary" >Save</button>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                          <button type="reset" class="btn btn-warning">Reset</button>
                          </div>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>


                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                        	<div class="form-title">
                        <button class="btn btn-link collapsed" style="width: 100%;text-align: left;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Artificial Insemination (AI)<input id="shidden2" type="hidden"value="0"></input><div id="head2" style="float: right;"></div>
                        </button>
                      </div>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body ">
                        <form id="two1" method="post">
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Select Type AI</label>
                            <select  class="form-control"  id="aistai" style="width:100%;">
                              <option value="">Select Type AI</option>
                              <option value="Fresh">Fresh</option>
                              <option value="Repeat 1">Repeat 1</option>
                              <option value="Repeat 2">Repeat 2</option>
                            </select>
                          </div>
                          </div>
                          <div class="col-sm-6 ">
                          <div class="form-group">
                            <label class="control-label">Select of Oestrus</label>
                            <select  class="form-control"  id="aisooes" style="width:100%;">
                              <option value="">Select of Oestrus</option>
                              <option value="Early">Early</option>
                              <option value="Middle">Middle</option>
                              <option value="Late Stage">Late Stage</option>
                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 ">
                          <div class="form-group">
                            <label class="control-label">Status of Reproductive Organs</label>
                            <input type="text" class="form-control" id="aisoror" placeholder="Status of Reproductive Organs" required>
                          </div>
                          </div>
                          <div class="col-sm-6 ">
                          <div class="form-group">
                            <label class="control-label">Select Scheme</label>
                            <select  class="form-control"  id="aissch" style="width:100%;">
                              <option value="">Select Scheme</option>
                              <option value="GK">GK</option>
                              <option value="Govenment">Govenment</option>
                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 ">
                          <div class="form-group">
                            <label class="control-label">Straw Number</label>
                            <input type="text" class="form-control" id="aisno" placeholder="Straw Number" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                        <div class="form-group">
                        </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                        <button type="reset" class="btn btn-warning" >Reset</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                    </div>


                    <div class="card-header" id="headingThree">
                      <h5 class="mb-0">
                        	<div class="form-title" style="background-color: beige;">
                        <button class="btn btn-link collapsed" data-toggle="collapse" style="width: 100%;text-align: left;" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Operation / Surgery<input id="shidden3" type="hidden" value="0"></input><div id="head3" style="float: right;"></div>
                        </button>
                      </div>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse " aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body ">
                        <form id="three1" method="post">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                            <label class="control-label">Surgery Type</label>
                            <select  class="form-control"  id="opsust" style="width:100%;">
                              <option value="">Select Surgery Type</option>
                              <option value="Abcess">Abcess</option>
                              <option value="Docking">Docking</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                          </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          </div>
                          <div class="col-sm-6">
                        <div class="form-group">
                          <button type="reset" class="btn btn-warning" >Reset</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                    </div>



                    <div class="card-header" id="headingFour">
                      <h5 class="mb-0">
                        	<div class="form-title">
                        <button class="btn btn-link collapsed" style="width: 100%;text-align: left;" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Delivery<input id="shidden4" type="hidden" value="0"></input><div id="head4" style="float: right;"></div>
                        </button>
                      </div>
                      </h5>
                    </div>
                    <div id="collapseFour" class="collapse " aria-labelledby="headingFour" data-parent="#accordion">
                      <div class="card-body ">
                        <form id="four1" method="post">
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Calf Details (TD/Tag)</label>
                            <input type="text" class="form-control" id="delcadet" placeholder="Enter Calf Details" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Calf Gender</label>
                            <select  class="form-control" id="delcage" style="width:100%;" required>
                              <option value="">Select Calf Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Calf Birth Date</label>
                            <input type="date" class="form-control" id="delcbirtdate" placeholder="Enter Calf Birth Date" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">AI Date</label>
                            <input type="date" class="form-control" id="delcaidate" placeholder="Enter Calf AI Date" required>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Select Type AI</label>
                            <select  class="form-control"  id="delstai" style="width:100%;" required>
                              <option value="">Select Type AI</option>
                              <option value="Fresh">Fresh</option>
                              <option value="Repeat 1">Repeat 1</option>
                              <option value="Repeat 2">Repeat 2</option>
                            </select>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Select Scheme</label>
                            <select  class="form-control"  id="delssch" style="width:100%;" required>
                              <option value="">Select Scheme</option>
                              <option value="GK">GK</option>
                              <option value="Govenment">Govenment</option>
                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Straw Number</label>
                            <input type="text" class="form-control" id="delstrawno" placeholder="Enter Straw Number" required>
                          </div>
                        </div>
                        <div class="col-sm-6">
                      <div class="form-group">
                      </div>
                    </div>
                      </div>
                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          </div>
                          <div class="col-sm-6">
                        <div class="form-group">
                          <button  type="reset" class="btn btn-warning" >Reset</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                    </div>

                    <div class="card-header" id="headingFive">
                      <h5 class="mb-0">
                        	<div class="form-title" style="background-color: beige;">
                        <button class="btn btn-link collapsed" style="width: 100%;text-align: left;" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          Infertility<input id="shidden5" type="hidden" value="0"></input><div id="head5" style="float: right;"></div>
                        </button>
                      </div>
                      </h5>
                    </div>
                    <div id="collapseFive" class="collapse " aria-labelledby="headingFive" data-parent="#accordion">
                      <div class="card-body ">
                        <form id="five1" method="post">
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Findings of Reproductive Organs</label>
                            <input type="text" class="form-control" id="inforo" placeholder="Enter Findings of Reproductive Organs" required>

                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Treatment Suggested</label>
                            <input type="text" class="form-control" id="ints" placeholder="Enter Treatment Suggested" required>

                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Probable cause of infertility</label>
                            <input type="text" class="form-control" id="inpcoi" placeholder="Enter Probable cause of infertility" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                          </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          </div>
                          <div class="col-sm-6">
                        <div class="form-group">
                          <button type="reset" class="btn btn-warning" >Reset</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                    </div>



                    <div class="card-header" id="headingSix">
                      <h5 class="mb-0">
                        	<div class="form-title">
                        <button class="btn btn-link collapsed" style="width: 100%;text-align: left;" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                         Pregnacy Diagnosis<input id="shidden6" type="hidden" value="0"></input><div id="head6" style="float: right;"></div>
                        </button>
                      </div>
                      </h5>
                    </div>
                    <div id="collapseSix" class="collapse " aria-labelledby="headingSix" data-parent="#accordion">
                      <div class="card-body ">
                        <form id="six1" method="post">
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Select AI Date</label>
                            <input type="date" class="form-control" id="pdsaidate" placeholder="AI Date" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Text Report</label>
                            <input type="text" class="form-control" id="pdtextreport" placeholder="Enter Text Report" required>
                          </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Select Type</label>
                              <select  class="form-control"  id="pdtype" style="width:100%;" required>
                                <option value="">Select Type</option>
                                <option value="NSPD">NSPD</option>
                                <option value="AIPD">AIPD</option>
                              </select>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Pregnant Type</label>
                            <select  class="form-control"  id="pdprety" style="width:100%;" onchange="chpregancyval()" required>
                              <option value="">Select Pregnant Type</option>
                              <option value="Is Pregnant">Is Pregnant</option>
                              <option value="Not Pregnant">Not Pregnant</option>

                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row" id="ispshow" style="display:none;">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Approx Month</label>
                            <input type="text" class="form-control" id="approxmon" placeholder="Enter Approx Month" onkeypress="javascript:return isNumberKey(event)" >
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Expected Delivery Date</label>
                            <input type="date" class="form-control" id="pdexpdeldate" placeholder="Expected Delivery Date" >
                          </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Select Type AI</label>
                            <select  class="form-control"  id="pdstai" style="width:100%;" required>
                              <option value="">Select Type AI</option>
                              <option value="Fresh">Fresh</option>
                              <option value="Repeat 1">Repeat 1</option>
                              <option value="Repeat 2">Repeat 2</option>
                            </select>

                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Select Scheme</label>
                            <select  class="form-control"  id="pdssch" style="width:100%;" required>
                              <option value="">Select Scheme</option>
                              <option value="GK">GK</option>
                              <option value="Govenment">Govenment</option>
                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Straw Number</label>
                            <input type="text" class="form-control" id="pdstrawno" placeholder="Enter Straw Number" required>

                          </div>
                        </div>
                        <div class="col-sm-6">
                      <div class="form-group">
                      </div>
                    </div>
                      </div>
                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          </div>
                          <div class="col-sm-6">
                        <div class="form-group">
                          <button  type="reset" class="btn btn-warning" >Reset</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                    </div>



                    <div class="card-header" id="headingSeven">
                      <h5 class="mb-0">
                        <div class="form-title" style="background-color: beige;">
                        <button class="btn btn-link collapsed" style="width: 100%;text-align: left;" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          Procedure<input id="shidden7" type="hidden" value="0"></input><div id="head7" style="float: right;"></div>
                        </button>
                        </div>
                      </h5>
                    </div>
                    <div id="collapseSeven" class="collapse " aria-labelledby="headingSeven" data-parent="#accordion">
                      <div class="card-body ">
                        <form id="seven1">
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Procedure Details</label>
                            <input type="text" class="form-control" id="pprocdetail" placeholder="Procedure Details" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">System</label>
                            <input type="text" class="form-control" id="pdsystem" placeholder="Enter System" required>
                          </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          </div>
                          <div class="col-sm-6">
                        <div class="form-group">
                          <button type="reset" class="btn btn-warning" >Reset</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                    </div>

                    <div class="card-header" id="headingeight">
                      <h5 class="mb-0">
                          <div class="form-title">
                        <button class="btn btn-link collapsed" style="width: 100%;text-align: left;" data-toggle="collapse" data-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
                          Treatment<input id="shidden8" type="hidden" value="0"></input><div id="head8" style="float: right;"></div>
                        </button>
                      </div>
                      </h5>
                    </div>
                    <div id="collapseeight" class="collapse " aria-labelledby="headingeight" data-parent="#accordion">
                      <div class="card-body ">
                        <form id="eight1">
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Treatment</label>
                            <input type="text" class="form-control" id="treatment" placeholder="Enter Treatment" required>
                          </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group">

                          </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          </div>
                          <div class="col-sm-6">
                        <div class="form-group">
                          <button type="reset" class="btn btn-warning" >Reset</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                    </div>

                    <!-- <div class="card-header" id="headingnine">
                      <h5 class="mb-0">
                          <div class="form-title">

                      </div>
                      </h5>
                    </div> -->
                    <div id="collapsenine"  aria-labelledby="headingnine" data-parent="#accordion">
                      <div class="card-body ">
                        <div class="row">
                        <div class="form-title" style="background-color: red;">
                          <center><label>Inoculation</label></center>
          							</div>
                        </div>
                        <form id="nine1">
                        <div class="row">
                          <!-- <div class="col-sm-6">
                          <div class="form-group">
                              <label class="control-label">Type of Inoculation</label>
                              <input type="text" class="form-control" id="tyofinoculation" placeholder="Enter Type of Inoculation" required>
                          </div>
                          </div> -->
                          <div class="col-sm-6">

                            <div class="col-sm-12">
                              <div class="form-group">
                                <label class="control-label">Inoculation</label>
                                <select  class="form-control"  id="inotype" style="width:100%;"  required>
                                </select>
                              </div>
                            </div>
                            <!-- <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Next Visit Date</label><font color="red">*</font>
                              <input type="date" class="form-control" id="nonvdate" placeholder="Select Next Visit Date" required>
                            </div>
                            </div> -->
                            <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Service Charge</label><font color="red">*</font>
                                <input type="text" class="form-control" id="nofserch" onkeypress="javascript:return isNumberKey(event)" placeholder="Enter Service Charge" value="1" required>
                            </div>
                            </div>
                            <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Select Present condition</label><font color="red">*</font>
                              <select  class="form-control"  id="selprecond" style="width:100%;" required>
                                <option value="">Select Present condition</option>
                                <option value="--">--</option>
                                <option value="Ailing">Ailing</option>
                                <option value="Dead">Dead</option>
                                <option value="Recovered">Recovered</option>
                              </select>
                            </div>
                            </div>

                          </div>
                          <div class="col-sm-6">
                            <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Select Present Condition Photo (optional)</label>
                              <!-- <form id='custstyleform' method='post' enctype='multipart/form-data'> -->
                              <input type="file" id="animalimgname" alt="no Image" accept="image/*" onchange="loadFile(event)"/>
                              <!-- <button type="button" class="btn btn-primary" onclick="imgup();" >Save</button> -->
                              <!-- </form> -->

                            </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">

                                  <!-- <input type='file' id='customerstylepic' accept='image/*'/> -->
                                 <img class='img-thumbnail'  src='http://praxello.com/ahimsa/animalphotos/1.jpg'  style='cursor: pointer;'  id="setimage" alt ='No Image' title='Upload Image' width='200px' height='400px'></img>

                                  <!-- <img src="images/1.jpg" alt="No Image Uploaded"/> -->
                              </div>
                            </div>
                            <div class="col-sm-12">
                          <div class="form-group">
                            <button type="reset" class="btn btn-warning" >Reset</button>
                          </div>
                          </div>
                          </div>
                        </div>


                      </form>
                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          <button type="button" class="btn btn-default" style="width: 100%;background-color: #5d793d;" onclick="backmain();">Main Page</button>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-sm-4">
          <button type="button" class="btn btn-success" style="width: 100%;background-color: #ae16bb;" onclick="savepage();">SAVE</button>
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
  <script src="javascript/ipdallpatients.js"></script>
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
