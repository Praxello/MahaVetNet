<!DOCTYPE HTML>
<html>
<head>
 <?php include "title.php"; ?>
 <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
  <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
 <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet"> -->
 <!-- <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

 <link href="bootstrap/asterisks.css" rel="stylesheet">
 <link href="css/style.css" rel='stylesheet' type='text/css' />
 <link href="css/font-awesome.css" rel="stylesheet">
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <link href="css/custom.css" rel="stylesheet">
 <link href="sweetalert/sweetalert.css" rel="stylesheet">
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
	  <?php include "leftsidebar.php"; ?>
		<?php include "header.php"; ?>
		<div id="page-wrapper">
			<div class="main-page">
				<h3 class="title1">Vaccination</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">

          <div class="row" id="customerstyletable" style="display:block;">
            <div class="row">
              <div class="col-md-12">
                <button type="button" id="button1" class="btn btn-success" onclick="addStyle()" style="float:right"> New Vaccination</button>
                <div id="data"></div>
            </div>
            </div>
            <div class="col-md-12" >
            <div class="table-responsive">
              <table id="styletbl" class="display nowrap table table-hover  table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                  </tr>
                </thead>
                <tbody id="styletbldata">
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            </div>

            </div>
            </div>
            <div class="row" id="customerstyletableform" style="display:none;">
              <div class="col-sm-12">
                <div class="card">
                  <div class="row">
                  <input type="hidden" id="styleid"/>

                    <div class="col-sm-12">
                      <div class="col-sm-12">
                    <div class="form-group required">
                      <label class="control-label">Medicine Name</label>
                      <select  class="form-control"  id="medicinename" style="width:100%;" onchange="addtablemedicine()" multiple>
                        <!-- <option value="">Select Medicine Name</option> -->
                        <option value="2">Medicine1</option>
                        <option value="3">Skuno</option>
                        <option value="4">Abc</option>
                        <option value="5">Pqr</option>
                        <option value="6">xyz</option>
                        <option value="7">stv</option>
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
                        <input type="text" class="form-control" id="nocalf"  title="No of Calf" placeholder="No of Calf" onkeypress="javascript:return isNumberKey(event)"/>

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Buffalo</label>
                        <input type="text" class="form-control" id="nobuffalo"  title="No of Buffalo" placeholder="No of Buffalo" onkeypress="javascript:return isNumberKey(event)"/>

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group ">
                        <label class="control-label">Redka</label>
                        <input type="text" class="form-control" id="noredka"  title="No of Redka" placeholder="No of Redka" onkeypress="javascript:return isNumberKey(event)"/>

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Sheep</label>
                        <input type="text" class="form-control" id="nosheep"  title="No of Sheep" placeholder="No of Sheep" onkeypress="javascript:return isNumberKey(event)"/>

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Poultry</label>
                        <input type="text" class="form-control" id="nopoultry"  title="No of Poultry" placeholder="No of Poultry" onkeypress="javascript:return isNumberKey(event)"/>

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
                        <label class="control-label">Total Animals </label><span id="totanimal"></span>


                      </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                        <button class="btn btn-success" id="savebtncustomerstyle" >Save</button>
                        <button class="btn btn-success" id="updatebtncustomerstyle" style="display:none;">Update</button>
                        <button class="btn btn-secondary" id="reloadbtn" >Back</button>
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
  <script src="javascript/apifile.js"></script>
  <script src="javascript/validation.js"></script>
  <!-- <script src="js/modernizr.custom.js"></script> -->
  <script src="js/metisMenu.min.js"></script>
  <script src="js/custom.js"></script>
	<!-- <script src='js/SidebarNav.min.js' type='text/javascript'></script> -->
	<!-- <script>
      $('.sidebar-menu').SidebarNav()
  </script> -->
  <!-- <script src="js/bootstrap.js"> </script> -->
  <!-- <script src="bootstrap/js/popper.min.js"></script> -->
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <link href="select2/select4.css" rel="stylesheet" />
  <script src="select2/select4.js" type="text/javascript"></script>
  <script src="datatables/datatables.min.js"></script>
  <!-- <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script> -->
  <!-- <script src="datatables/datatables-init.js"></script> -->
  <script src="sweetalert/sweetalert.min.js"></script>
  <script src="javascript/vaccination.js"></script>
  <script src="js/classie.js"></script>
  <script src="js/sidebarclose.js"></script>
  <script src="js/jquery.nicescroll.js"></script>
  <script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->


</body>
</html>
