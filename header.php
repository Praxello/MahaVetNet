      <!-- header-starts -->
      <div class="sticky-header header-section ">
          <div class="header-left">

              <!--toggle button start-->
              <button id="showLeftPush"><i class="fa fa-bars"></i></button>
              <?php if($brId < 50000){
                     $center =  $_SESSION['center'];
                    ?>
             <!-- <code style="text-align:center;float:right;color:red;font-size:10px;">Please confirm your VDs first by clicking on user name on the right.(Click on 'NOT MY VD' button only if it is not your VD.) </code> -->
            <strong style="text-align:center;float:right;"><?php echo $center;?></strong><?php }?>
          </div>

          <div class="header-right">


              <!--search-box-->

              <!--//end-search-box-->

              <div class="profile_details">
                  <ul>
                      <li class="dropdown profile_details_drop">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <div class="profile_img">
                                  <?php if($_SESSION['branchId'] == 100001){?>
                                  <span class="prfil-img"><img src="images/100001.jpeg"
                                          alt="" width="55px" height="55px"> </span>
                                  <div class="user-name">
                                      <p><?php echo $_SESSION['username'];?></p>
                                      <span>Commissioner</span>
                                  </div>
                                  <?}else{
                                      $filename = "https://praxello.com/ahimsa/profilepics/". $_SESSION['branchId'].".jpg";
                                      if(!file_exists($filename)){
                                        $profile = "images/profile.jpeg";
                                      }else{
                                        $profile =  $filename;
                                         
                                      }
                                          ?>
                                  <span class="prfil-img"><img src="<?php echo $profile;?>" alt="" width="55px"
                                          height="55px"> </span>
                                  <div class="user-name">
                                      <p><?php echo $_SESSION['username'];?></p>
                                      <span><?php echo $_SESSION['designation'];?></span>
                                  </div>
                                  <?}?>
                                  <i class="fa fa-angle-down lnr"></i>
                                  <i class="fa fa-angle-up lnr"></i>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                          <ul class="dropdown-menu drp-mnu loadmobile" style="margin-left: -7px;">

                              <!-- <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
                                <li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li>
                                <li> <a href="#"><i class="fa fa-suitcase"></i> Profile</a> </li> -->
                              <li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                          </ul>
                      </li>
                  </ul>
              </div>
              <div class="clearfix"> </div>
          </div>
          </a>
          <ul class="dropdown-menu drp-mnu">

              <!-- <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
            <li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li>
            <li> <a href="#"><i class="fa fa-suitcase"></i> Profile</a> </li> -->
              <li> <a href="#"><i class="logout.php"></i> Logout</a> </li>
          </ul>
          </li>
          </ul>
      </div>
      <div class="clearfix"> </div>
      </div>
      <div class="clearfix"> </div>
      </div>
