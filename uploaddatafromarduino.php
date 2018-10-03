<?php 

$dataa="yy212";
$datab="yy212";
$datac="yy212";


$status1=$_GET['a'];
$status2=$_GET['b'];
$status3=$_GET['c'];
$timein1=$_GET['d'];
$timein2=$_GET['e'];
$timein3=$_GET['f'];
$timeout1=$_GET['g'];
$timeout2=$_GET['h'];
$timeout3=$_GET['i'];
$parked1=$_GET['j'];
$parked2=$_GET['k'];
$parked3=$_GET['l'];
$grace1=$_GET['m'];
$grace2=$_GET['n'];
$grace3=$_GET['o'];
$realtime1=$_GET['p'];
$realtime2=$_GET['q'];
$realtime3=$_GET['r'];




echo $status1;
echo " - ";
echo $status2;
echo " - ";
echo $status3;
echo " - ";




	
//insert to db
include('db.php');
$sql_update="UPDATE arduinorealtimemonitor set parkingstatus='".$status1."', activetime='".$realtime1."', transactiontime='".$timein1."', timeout='$timeout1', lastplate='".$dataa."' WHERE arduino_id=1";
$con->query($sql_update) or die (mysqli_error($con));


$sql_update="UPDATE arduinorealtimemonitor set parkingstatus='".$status2."', activetime='".$realtime2."', transactiontime='".$timein2."',timeout='".$timeout2."',lastplate='".$datab."' WHERE arduino_id=2";
$con->query($sql_update) or die (mysqli_error($con));

$sql_update="UPDATE arduinorealtimemonitor set parkingstatus='".$status3."', activetime='".$realtime3."', transactiontime='".$timein3."',timeout='".$timeout3."',lastplate='".$datac."' WHERE arduino_id=3";
$con->query($sql_update) or die (mysqli_error($con));


if($status1 == "Inactive"){

		$sql_update1="UPDATE arduinorealtimemonitor set activetime = 0 WHERE arduino_id=1";
$con->query($sql_update1) or die (mysqli_error($con));
}

if($status2 == "Inactive"){

		$sql_update2="UPDATE arduinorealtimemonitor set activetime = 0 WHERE arduino_id=2";
$con->query($sql_update2) or die (mysqli_error($con));
}

if($status3 == "Inactive"){

		$sql_update3="UPDATE arduinorealtimemonitor set activetime = 0 WHERE arduino_id=3";
$con->query($sql_update3) or die (mysqli_error($con));
}

if($status1 == "Active"){
		$sql_update1="UPDATE arduinorealtimemonitor set confirm = 'No' WHERE arduino_id=1";
$con->query($sql_update1) or die (mysqli_error($con));
}

if($status2 == "Active"){

		$sql_update2="UPDATE arduinorealtimemonitor set confirm = 'No' WHERE arduino_id=2";
$con->query($sql_update2) or die (mysqli_error($con));
}

if($status3 == "Active"){

		$sql_update3="UPDATE arduinorealtimemonitor set confirm = 'No' WHERE arduino_id=3";
$con->query($sql_update3) or die (mysqli_error($con));
}

/*if($realtime1 == '00:00:00'){

		$sql_insert = "INSERT INTO arduinotransactionhistory ()";

}*/

		

  ?>
