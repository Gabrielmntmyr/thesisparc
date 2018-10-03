<?php 

//$dataa="yy212";
//$datab="yy212";
//$datac="yy212";


$data1=$_GET['a'];
$data2=$_GET['b'];
$data3=$_GET['c'];
$data4=$_GET['d'];
$data5=$_GET['e'];
$data6=$_GET['f'];

$data7=$_GET['g'];
$data8=$_GET['h'];
$data9=$_GET['i'];
$data10=$_GET['j'];
$data11=$_GET['k'];
$data12=$_GET['l'];


$data13=$_GET['m'];
$data14=$_GET['n'];
$data15=$_GET['o'];
$data16=$_GET['p'];
$data17=$_GET['q'];
$data18=$_GET['r'];





echo $data1;
echo $data2;
echo $data3;

	
//insert to db
include('db.php');
$s1="UPDATE arduinorealtimemonitor set parkingstatus='".$data1."',confirm='0',plate='',duration='".$data16."',activetime='".$data4."',transactiontime='',lastplate='".$dataa."' WHERE id=1";
mysql_query($s1) or die (mysql_error($con));
$s1="UPDATE arduinorealtimemonitor set parkingstatus='".$data2."',confirm='0',plate='',duration='".$data17."',activetime='".$data5."',transactiontime='',lastplate='".$datab."' WHERE id=2";
mysql_query($s1) or die (mysql_error($con));
$s1="UPDATE arduinorealtimemonitor set parkingstatus='".$data3."',confirm='0',plate='',duration='".$data18."',activetime='".$data6."',transactiontime='',lastplate='".$datac."' WHERE id=3";
mysql_query($s1) or die (mysql_error($con));








  ?>