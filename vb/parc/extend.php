<?php
include('db.php');
$id=$_GET['id'];
$s1="UPDATE arduinorealtimemonitor set extend='1' WHERE id='".$id."'";
mysql_query($s1) or die (mysql_error($con));

header("location:reading.php");
?>
