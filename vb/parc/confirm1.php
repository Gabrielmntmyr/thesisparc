

<?php 

$data1=$_POST['id'];
$data2=$_POST['a'];
$data3=$_POST['b'];
	
		
date_default_timezone_set('Asia/Taipei'); 
	echo $data1;
	echo $data2;
	echo $data3;
$data4=date("d/m/Y h:i:s A");
if  ($data2==$data3)
{
	
}	
else
{
	
	
include('db.php');
$s1="UPDATE arduinorealtimemonitor set confirm='1',plate='".$data3."',transactiontime='".$data4."',lastplate='".$data3."' WHERE id='".$data1."'";
mysql_query($s1) or die (mysql_error($con));
header("location:reading.php");
}


//





  ?>
