<?php 
include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

if(isset($_REQUEST['id']))
{
  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $timeout = $_REQUEST['time'];
    $plot = $_REQUEST['plot'];
    $discrepancy = $_REQUEST['discrepancy'];
    $sql_update = "UPDATE arduinotransactionhistory
    SET timeout = '$timeout', discrepancy = '$discrepancy'
    WHERE id=$id";
    $con->query($sql_update) or die(mysqli_error($con));

    $sql_violationtrigger = "INSERT INTO paviolationhistory (parkinglotprofile_ID, id, pavref_ID, dlqstatusref_ID)
    VALUES ($plot,$id,1,1)";
    $con->query($sql_violationtrigger) or die(mysqli_error($con));
    header('location: timeouttransaction.php');

  }
}
?>

<div class="col-lg-12">
  <div class="col-lg-3">
  </div>
  <form action="" method="POST" class="form-horizontal">
  <div class="card col-lg-6">
    <div class="card-header">
      <h1 class="text-center">Confirm Transaction?</h1>
    </div>
    <div class="card-body card-block">
      <div class="card-footer">
        <button type="submit" class="col-12 btn btn-primary btn-sm" name="submit"value="submit">
          <i class="fa fa-dot-circle-o"></i> YES
        </button>
      </div>

    </form>
  </div>
</div>
</div>