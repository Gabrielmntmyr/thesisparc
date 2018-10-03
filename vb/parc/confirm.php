

<?php 

$data1=$_GET['id'];
$data2=$_GET['a'];
	
	
//include('db.php');
//$s1="UPDATE arduinorealtimemonitor set confirm='1',plate='',transactiontime='',lastplate='".$data1."' WHERE id='".$dataa."'";
//mysql_query($s1) or die (mysql_error($con));








  ?>

 <form action='confirm1.php' method='post'>
  <table border="1">
	    <tr>
    <td width="80">Park #</td>
    <td width="80"><input name="id" title="id"value="<?php echo $data1;?>" readonly></td>


  
  
  
  
  </tr>

  	    <tr>
    <td width="80">Last Plate</td>

    <td width="80"><input name="a" title="a"value="<?php echo $data2;?>" readonly></td>
  </tr>
  	    <tr>
    <td width="80">Plate</td>

    <td width="80"><input type="text" name="b" title="b" ></td>
  </tr>
  
  
  
  <tr>
  
    <td>  </td>
	<td>  <input type="submit" name="sub" value="Confirm" /></td>

	  </tr>
  
  </table>

	</form>

  