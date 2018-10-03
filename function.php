 <?php  
 function getAppFolder()
 {
 	$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
 	$port      = $_SERVER['SERVER_PORT'];
 	$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
 	$domain    = $_SERVER['SERVER_NAME'];

 	return "${protocol}://${domain}${disp_port}" . "/parc/";
 }

 # checks if user has logged in; redirects to login page if not logged in
    function validateAccess()
    {
        if (!isset($_SESSION['userid']))
        {
            session_start();
            $admin_login = getAppFolder() . 'manage/login.php';
            $lastURL = $_SERVER['REQUEST_URI'];
            header('location: ' . $admin_login .'?url=' . $lastURL);
        }
    }

    #hides elements if usertype is not admin
    function toggleAdmin()
    {
        if (isset($_SESSION['typeid']))
        {
            $typeid = $_SESSION['typeid'];
            if ($typeid != 1)
            {
                echo 'style="display:none;"';
            }
        }
    }

    function togglePa()
    {
        if (isset($_SESSION['typeid']))
        {
            $typeid = $_SESSION['typeid'];
            if ($typeid != 3)
            {
                echo 'style="display:none;"';
            }
        }
    }

    function toggleAuditor()
    {
        if (isset($_SESSION['typeid']))
        {
            $typeid = $_SESSION['typeid'];
            if ($typeid != 2)
            {
                echo 'style="display:none;"';
            }
        }
    }
 ?>