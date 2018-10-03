<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title></head>
<script src="jquery.min.js"></script>

<body>
 
	  <h1>welcome admin</h1>
	  
	
  <script>
  
  
jQuery().ready(function(){
    setInterval("getResult()",800); //set theinterval for the update
});
function getResult(){   

    jQuery.post("updatedata.php",function(myfilename1) {$("#data1").html(myfilename1);});



}


</script>

  
  
  
  
  
  
  
<a id="data1"></a> 
	<form action='history.php' method='post'>
 
	  <input type="submit" name="sub" value="HISTORY" /></td>
</form> 
 
	  </div>
</body>
</html>
