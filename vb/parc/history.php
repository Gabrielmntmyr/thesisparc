<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title></head>

<body>
 
	  <h1>History</h1>
	  <?php
	  include('db.php');
	  $sql="select * from arduinotransactionhistory";
	  $row=mysql_query($sql) or die (mysql_error($con));
	 
	  ?><table border="1">
	  
	  <tr>
	    <td width="22">ID</td>
    <td width="128">Plate</td>
    <td width="120">Active Time</td>
    <td width="120">Time out</td>
    <td width="120">Transaction time</td>
    <td width="80">Price</td>
	<td width="120">Attendant Name</td>
	
	<td width="120">Attendant Time</td>
    <td width="80">Park No.</td>
	<td width="120">Date of Transaction</td>
	
	  </tr>
	  
	  <?php
	  //`arduinotransactionhistory`( `timeout`, ``, `price`, ``, ``, ``, ``
	  while($data=mysql_fetch_array($row))
	  {
	  ?>
	  <tr>
	  <td><?php echo $data[id]; ?></td>
	  <td><?php echo $data[plate]; ?></td>
	  <td><?php echo $data[activetime]; ?></td>
	  <td><?php echo $data[timeout]; ?></td>
	  <td><?php echo $data[transactiontime]; ?></td>
	  <td><?php echo $data[price]; ?></td>
	  
	  <td><?php echo $data[attendantname]; ?></td>
	  <td><?php echo $data[attendantconfirmtime]; ?></td>
	  <td><?php echo $data[parknumber]; ?></td>
	  
	  <td><?php echo $data[dateoftransaction]; ?></td>
	   

	  </tr>
	  <?php
	  }
	  
	  
	  ?>
	  
	  
	  </table>
	  <form action='reading.php' method='post'>
 
	  <input type="submit" name="sub" value="Reading" /></td>
</form>
	  </div>
</body>
</html>
