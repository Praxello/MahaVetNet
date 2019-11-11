<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <!--left-fixed -navigation-->
    <aside class="sidebar-left">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h5><a class="navbar-brand" href="dashboard.php">MahaVetNet</a></h5>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="dashboard.php">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="reports.php">
                            <i class="fa fa-file"></i> <span>Reports</span>
                        </a>
                    </li>
                    <?php if($brId < 50000){?>
                        <li class="treeview">
                        <a href="allpatients.php">
                            <i class="fa fa-user-md"></i> <span>All Patients (OPD)</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="ipdallpatients.php">
                            <i class="fa fa-stethoscope"></i> <span>All Patients (IPD)</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="patients.php">
                            <i class="fa fa-plus-square"></i> <span>Vaccination/Deworming</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="farmer.php">
                            <i class="fa fa-users"></i> <span>Farmers</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="medicines.php">
                            <i class="fa fa-medkit"></i> <span>Medicines</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="straw.php">
                            <i class="fa fa-dashboard"></i> <span>Straws</span>
                        </a>
                    </li>
                    <?php }?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </aside>
</div>
