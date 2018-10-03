<?php 
include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

if(isset($_REQUEST['id']))
{
  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $transactiontime = $_REQUEST['time'];
    $userid = $_SESSION['userid'];    
    $plate = mysqli_real_escape_string($con, $_POST['plate']);
    $sql_update = "UPDATE arduinorealtimemonitor SET plate = '$plate', transactiontime = now(), confirm1 = 'Yes'
    WHERE arduino_id=$id";
    $sql_inserttransaction = "INSERT INTO arduinotransactionhistory (userprofile_ID, arduino_id, plate, attendantconfirmtime, price, transactiontime, dateoftransaction, confirm) VALUES ($userid,$id,'$plate',now(),50,'$transactiontime',now(), 'Yes')"; 

    $con->query($sql_inserttransaction) or die(mysqli_error($con));
    $con->query($sql_update) or die(mysqli_error($con));
    header('location: parkingattendantconfirmtransaction.php');

  }
}
?>

<div class="col-lg-12">
  <div class="col-lg-3">
  </div>
  <div class="card col-lg-6">
    <div class="card-header">
      <h1 class="text-center">Plate No.</h1>
    </div>
    <div class="card-body card-block">
     <form action="" method="POST" class="form-horizontal">

      <div class="row form-group">
        <div class="col-12 col-sm-12"><input type="text" class="col-sm-12 form-control" name="plate" style="border-top:none; border-right: none;border-left: none;">          
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="col-12 btn btn-primary btn-sm" name="submit"value="submit">
          <i class="fa fa-dot-circle-o"></i> Submit
        </button>
      </div>

    </form>
  </div>
</div>
</div>