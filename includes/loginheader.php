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
    /*if (isset($_SESSION['userid']))
    {
        $userid = $_SESSION['userid'];
        $sql_user = "SELECT u.firstName, u.lastName, t.userType
        FROM users u INNER JOIN usertype t ON
                u.typeID = t.typeID WHERE u.userID= $userid";

        $result_user = $con->query($sql_user) or die(mysqli_error($con));
        while ($row = mysqli_fetch_array($result_user))
        {
            $fn = $row['firstName'];
            $ln = $row['lastName'];
            $userType = $row['userType'];
            $userName = $fn . ', ' . $ln;
        }
    }*/

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PARC</title>
	<meta name="description" content="PARC">
	<link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
	<style>
		body {
			background-color: #030C1D;
		}

		.card {
			
		}
		.parc-logo {
			width:650px;
		}

        .card-body{
        	margin-top:-50px;
            font-size: 14px;
            border-radius: 1px;
            background-color: #ffffff;
            padding-top: 30px;
        }

        .card-header{
            background-color: #ffffff;
            border: none;
        }
	</style>
</head>
<body>