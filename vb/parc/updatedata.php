	
  
    <table border="1">
	    <tr>
    <td width="22">ID</td>
    <td width="80">Status</td>
    <td width="60">Confirm</td>

    <td width="60">Duration</td>
    <td width="180">Active time</td>
    <td width="180">Transaction time</td>
    <td width="80">Last Plate</td>
	<td width="60">Extend</td>
   
    <td width="80"></td>
    <td width="80"></td>
  
  
  
  
  
  </tr>

	  
	  <?php
	  include('db.php');
	  $sql="select * from arduinorealtimemonitor where id=1";
	  $row=mysql_query($sql) or die (mysql_error($con));
	 
	  while($data=mysql_fetch_array($row))
	  {
		  		  
		  if (($data[parkingstatus]=="Active") && ($data[confirm]==0))
		  { $uextend1=1; $alert1=1;}

	  ?>
	  <tr>
	  <td><?php echo $data[id]; ?></td>
	  <td><?php echo $data[parkingstatus]; ?></td>
	  <td><?php echo $data[confirm]; ?></td>
<td><?php $dur=$data[duration]; echo gmdate("H:i:s", $dur); ?></td>

	  <td><?php echo $data[activetime]; ?></td>
	  <td><?php echo $data[transactiontime]; ?></td>
	  <td><?php echo $data[lastplate]; ?></td>
	  <td><?php echo $data[extend]; ?></td>
	  
	  <td><a href="confirm.php?id=<?php echo $data[id]; ?>&a=<?php echo $data[lastplate]; ?>">Confirm</a></td>
	  <td><a href="extend.php?id=<?php echo $data[id]; ?>">Extend</a></td>
	  </tr>
	  <?php
	  }
	  
	  
	  
	  
	  
	  
	  $sql="select * from arduinorealtimemonitor where id=2";
	  $row=mysql_query($sql) or die (mysql_error($con));
	 
	  while($data=mysql_fetch_array($row))
	  {
		  
		  		  
		  if (($data[parkingstatus]=="Active") && ($data[confirm]==0))
		  {$uextend2=1;  $alert2=2;}

	  ?>
	  <tr>
	  <td><?php echo $data[id]; ?></td>
	  <td><?php echo $data[parkingstatus]; ?></td>
	  <td><?php echo $data[confirm]; ?></td>

<td><?php $dur=$data[duration]; echo gmdate("H:i:s", $dur); ?></td>
	  <td><?php echo $data[activetime]; ?></td>
	  <td><?php echo $data[transactiontime]; ?></td>
	  <td><?php echo $data[lastplate]; ?></td>
	  <td><?php echo $data[extend]; ?></td>
	  
	  <td><a href="confirm.php?id=<?php echo $data[id]; ?>&a=<?php echo $data[lastplate]; ?>">Confirm</a></td>
	  <td><a href="extend.php?id=<?php echo $data[id]; ?>">Extend</a></td>
	  </tr>
	  <?php
	  }
	  
	  
	  
	  

	  $sql="select * from arduinorealtimemonitor where id=3";
	  $row=mysql_query($sql) or die (mysql_error($con));
	 
	  while($data=mysql_fetch_array($row))
	  {
		  
		  if (($data[parkingstatus]=="Active") && ($data[confirm]==0))
		  { $uextend3=1; $alert3=3;}
		  
	  ?>
	  <tr>
	  <td><?php echo $data[id]; ?></td>
	  <td><?php echo $data[parkingstatus]; ?></td>
	  <td><?php echo $data[confirm]; ?></td>

<td><?php $dur=$data[duration]; echo gmdate("H:i:s", $dur); ?></td>
	  <td><?php echo $data[activetime]; ?></td>
	  <td><?php echo $data[transactiontime]; ?></td>
	  <td><?php echo $data[lastplate]; ?></td>
	  <td><?php echo $data[extend]; ?></td>

	  <td><a href="confirm.php?id=<?php echo $data[id];?>&a=<?php echo $data[lastplate]; ?>">Confirm</a></td>
	  <td><a href="extend.php?id=<?php echo $data[id];?>">Extend</a></td>
	  </tr>
	  <?php
	  }
	  
if ($uextend1==1)
{
$s1="UPDATE arduinorealtimemonitor set extend='0',lastplate='".$dataa."' WHERE id=1";
mysql_query($s1) or die (mysql_error($con));
$uextend1=0;
}


if ($uextend2==1)
{
$s1="UPDATE arduinorealtimemonitor set extend='0',lastplate='".$dataa."' WHERE id=2";
mysql_query($s1) or die (mysql_error($con));
$uextend2=0;
}
if ($uextend3==1)
{
$s1="UPDATE arduinorealtimemonitor set extend='0',lastplate='".$dataa."' WHERE id=3";
mysql_query($s1) or die (mysql_error($con));
$uextend3=0;
}	  
	  
	  ?>

	  </table>
<b>	Alert:</b><?php Echo $alert1?><?php Echo $alert2?><?php Echo $alert3?>

