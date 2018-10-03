  <?php 

include_once('../includes/header.php');
validateAccess();
# displays list of parking attendant
$sql_getPA = "SELECT userprofile_ID, firstname, lastname FROM userprofile WHERE usertype_ID = 3 AND status='Active' ORDER BY lastname ";
$result_getPA = $con->query($sql_getPA) or die(mysqli_error($con));

$list_PA = "";
while ($row = mysqli_fetch_array($result_getPA))
{
  $paID = $row['userprofile_ID'];
  $name = $row['firstname']. ' ' .$row['lastname'] ;
  $list_PA .= "<option value='$paID'>$name</option>";
}

$sql_getLocation = "SELECT parkinglotprofile_ID, parkinglotarea, parkingzonefield, parkinglotstreet FROM parkinglotprofile";
$result_getLocation = $con->query($sql_getLocation) or die(mysqli_error($con));

$list_Location = "";
while ($row = mysqli_fetch_array($result_getLocation))
{
  $parkinglotID = $row['parkinglotprofile_ID'];
  $parkinglotarea = $row['parkinglotarea'];
  $parkingzonefield = $row['parkingzonefield'];
  $parkinglotstreet = $row['parkinglotstreet'];
  $location = $parkinglotarea. ', Zone ' .$parkingzonefield. ', ' .$parkinglotstreet;
  $list_Location .= "<option value='$parkinglotID'>$location</option>";

}

if (isset($_POST['assign']))
{
  $pa = mysqli_real_escape_string($con, $_POST['pa']);
  $area = mysqli_real_escape_string($con, $_POST['village']);

  $sql_assign = "UPDATE parkinglotprofile SET userprofile_ID=$pa
  WHERE parkinglotprofile_ID='$area'";
  $con->query($sql_assign) or die(mysqli_error($con));
}

?>


<div class="col-lg-12">
  <div class="col-lg-3"></div>
  <div class="card col-lg-6">
    <div class="card-header">
      <strong>Parking Attendant Street Assignment </strong>Form
    </div>
    <div class="card-body card-block">
      <form action="" method="POST" class="form-horizontal">


        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Parking Attendant:</label></div>
          <div class="col-12 col-md-9">
            <select name="pa" id="select" class="form-control">
            <option value="">Select Parking Attendant</option>
            <?php 
                echo $list_PA; 
              ?>
            </select>
          </div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Village</label></div>
          <div class="col-12 col-md-9">
            <select name="village" id="select" class="form-control">
            <option value="">Select Location</option>
              <?php 
                echo $list_Location; 
              ?>
            </select>
          </div>
        </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm" name="assign" value="Assign">
          <i class="fa fa-dot-circle-o"></i> Assign
        </button>
      </div>
    </form>
  </div>
</div>
</div>

<?php 

include_once('../includes/footer.php');

?>