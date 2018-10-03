<?php

    ob_start(); # Quick fix to 'Warning: Cannot modify header information - headers already sent by...'
    
    # sets path of application folder
    $protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
    $port      = $_SERVER['SERVER_PORT'];
    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
    $domain    = $_SERVER['SERVER_NAME'];

    define('app_path', "${protocol}://${domain}${disp_port}" . '/parc/');

    require($_SERVER['DOCUMENT_ROOT'] . '/parc/db.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/parc/function.php');

    session_start();
    if (isset($_SESSION['userid']) && isset($_SESSION['typeid']))
    {
       $userid = $_SESSION['userid'];
       $typeid = $_SESSION['typeid'];
       $sql_user = "SELECT u.firstname, u.lastname, t.userType
       FROM userprofile u INNER JOIN usertype t ON
       u.usertype_ID = t.usertype_ID WHERE u.userprofile_ID= $userid";

       $result_user = $con->query($sql_user) or die(mysqli_error($con));
       while ($row = mysqli_fetch_array($result_user))
       {
           $fn = $row['firstname'];
           $ln = $row['lastname'];
           $userType = $row['userType'];
           $userName = $ln . ', ' . $fn;
       }
   }

   ?>
   <!doctype html>
   <html>
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PARC</title>
    <meta name="description" content="PARC">
    <link rel="shortcut icon" type="image/png" href="<?php echo app_path ?>assets/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo app_path ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo app_path ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo app_path ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo app_path ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo app_path ?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo app_path ?>assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo app_path ?>assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo app_path ?>assets/scss/style.css">
    <link href="<?php echo app_path ?>assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style>
    .card-body{
        font-size: 14px;
        overflow-x:auto;
    }

    .card-header{
        background-color: #C45454;
        color: #ffffff;
    }

    .btn {
        white-space: normal !important;
        word-wrap: break-word;
    }


</style>

</head>
<body>


    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
			
            <div class="navbar-header">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo app_path ?>dashboard.php"><img class="img-responsive"  id="brand" src="<?php echo app_path ?>assets/images/logo.png" alt="Logo" style="width:60px;"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?php echo app_path ?>dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title" <?php toggleAdmin(); ?>>EMPLOYEE</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown" <?php toggleAdmin(); ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Employees</a>
                        <ul class="sub-menu children dropdown-menu">
                        	<li><i class="fa fa-puzzle-piece"></i><a href="<?php echo app_path ?>manage/viewemployee.php">Employee List</a></li>
                            <li><i class="fa fa-bars"></i><a href="<?php echo app_path ?>manage/activeemployee.php">Active</a></li>
                            <li><i class="fa fa-bars"></i><a href="<?php echo app_path ?>manage/pendingemployee.php">Pending</a></li>
                            <li><i class="fa fa-bars"></i><a href="<?php echo app_path ?>manage/archiveemployee.php">Archived</a></li>
                            <h3 class="menu-title"></h3>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo app_path ?>manage/addemployee.php">Add Employee</a></li>
                        </ul>
                    </li>
                    <li <?php toggleAdmin(); ?>>
                        <a href="<?php echo app_path ?>manage/viewparkinglotstatus.php"> <i class="menu-icon ti-email"></i>View Parking Slot Status</a>
                    </li>   

                    <h3 class="menu-title" <?php toggleAdmin(); ?>>MANAGE PARKING SLOT</h3>
                    <li <?php toggleAdmin(); ?>>
                        <a href="<?php echo app_path ?>manage/addparkingslot.php"> <i class="menu-icon ti-email"></i>Register Parking Slot</a>
                    </li>
                    <li <?php toggleAdmin(); ?>>
                        <a href="<?php echo app_path ?>manage/parkingslotlist.php"> <i class="menu-icon ti-email"></i>Parking Slot Lists</a>
                    </li>
                    <li <?php toggleAdmin(); ?>>
                        <a href="<?php echo app_path ?>manage/assignparkingattendant.php"> <i class="menu-icon ti-email"></i>Assign Parking Attendant</a>
                    </li>
                    <li <?php toggleAdmin();?>>
                        <a href="<?php echo app_path ?>manage/assignauditor.php"> <i class="menu-icon ti-email"></i>Assign Auditor</a>
                    </li>

                    <h3 class="menu-title" <?php toggleAdmin(); ?>>FLAGGED RECORDS</h3>
                    <li <?php toggleAdmin(); ?>>
                        <a href="<?php echo app_path ?>manage/manageflaggedrecords.php"> <i class="menu-icon ti-email"></i>
                        View parking Attendant Transaction History</a>
                    </li>
                    

                    <h3 class="menu-title" <?php toggleAuditor(); ?>>TRANSACTION HISTORY</h3>
                    <li <?php toggleAuditor(); ?>>
                        <a href="<?php echo app_path ?>manage/manageflaggedrecords.php"> <i class="menu-icon ti-email"></i>
                        Flagged Transaction List</a>
                    </li>
                    <li <?php toggleAuditor(); ?>>
                        <a href="<?php echo app_path ?>manage/viewparkingattendanttransaction.php"> <i class="menu-icon ti-email"></i>
                        View Parking Attendant Transaction History</a>
                    </li>

                    <h3 class="menu-title" <?php toggleAuditor(); ?>>FLAGGED RECORDS</h3>
                    <li <?php toggleAuditor(); ?>>
                        <a href="<?php echo app_path ?>manage/manageflaggedrecords.php"> <i class="menu-icon ti-email"></i>
                        Flagged Transaction List</a>
                    </li>





                    <h3 class="menu-title" <?php togglePa(); ?>>CONFIRM PARKING</h3>
                    <li <?php togglePa(); ?>>
                        <a href="<?php echo app_path ?>manage/parkingattendantconfirmtransaction.php"> <i class="menu-icon ti-email"></i>Parking List</a>
                    </li>
                    <li <?php togglePa(); ?>>
                        <a href="<?php echo app_path ?>manage/timeouttransaction.php"> <i class="menu-icon ti-email"></i>Timeout Confirm</a>
                    </li>


                    <h3 class="menu-title">REPORTS</h3>
                    <li <?php toggleAuditor(); ?>>
                        <a href="<?php echo app_path ?>manage/createreport.php"> <i class="menu-icon ti-email"></i>Generate Report</a>
                    </li>




                    <h3 class="menu-title">USER CONTROL</h3>
                    <li>

                        <a href="<?php echo app_path ?>manage/logout.php"> <i class="menu-icon ti-email"></i>Logout</a>
                    </li>  
                </ul>
            </div>
        </nav>
    </aside>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">
				<div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                    </div>
                </div>
                

                <div class="col-sm-12">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $userName . ' (' . $userType . ')'; ?> <i class="fa fa-user"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a href="<?php echo app_path ?>manage/logout.php"> <i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <!-- Right Panel -->