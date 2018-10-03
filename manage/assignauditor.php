<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();
# displays list of auditor
$sql_getAuditor = "SELECT userprofile_ID, firstname, lastname FROM userprofile WHERE usertype_ID = 2 AND status='Active' ORDER BY lastname ";
$result_getAuditor = $con->query($sql_getAuditor) or die(mysqli_error($con));

$list_Auditor = "";
while ($row = mysqli_fetch_array($result_getAuditor))
{
  $aID = $row['userprofile_ID'];
  $name = $row['firstname']. ' ' .$row['lastname'] ;
  $list_Auditor .= "<option value='$aID'>$name</option>";
}

$sql_getFlagged = "SELECT pav.dlqstatusref_ID, pav.pavref_ID, pav.parkinglotprofile_ID, pav.pav_ID, a.dateoftransaction AS flaggeddate, d.description AS status,
v.violationName AS violation, p.parkinglotarea AS village, p.parkingzonefield AS zone
FROM paviolationhistory pav 
INNER JOIN delinquenciesstatusref d ON pav.dlqstatusref_ID = d.dlqstatusref_ID
INNER JOIN paviolationsref v ON pav.pavref_ID = v.pavref_ID
INNER JOIN parkinglotprofile p ON pav.parkinglotprofile_ID = p.parkinglotprofile_ID
INNER JOIN arduinotransactionhistory a ON pav.pav_ID = a.id
WHERE d.description = 'For Review'";
$result_getFlagged = $con->query($sql_getFlagged) or die(mysqli_error($con));

$list_Flagged = "";
while($row = mysqli_fetch_array($result_getFlagged))
{
  $fID = $row['pav_ID'];
  $status = $row['status'];
  $violation = $row['violation'];
  $village = $row['village'];
  $zone = $row['zone'];
  $flaggeddate = $row['flaggeddate'];
  $flaglist = $status. '- ' .$violation. '- ' .$village. ', Zone ' .$zone;
  $list_Flagged .= "<option value='$fID'>$flaglist</option>";
}

if (isset($_POST['assign']))
{
  $auditor = mysqli_real_escape_string($con, $_POST['auditor']);
  $flag = mysqli_real_escape_string($con, $_POST['flagged']);

  $sql_assign = "UPDATE paviolationhistory SET userprofile_ID=$auditor
  WHERE pav_ID='$flag'";
  $con->query($sql_assign) or die(mysqli_error($con));
}

?>


<div class="col-lg-12">
  <div class="col-lg-3"></div>
  <div class="card col-lg-6">
    <div class="card-header">
      <strong>Auditor Assignment </strong>Form
    </div>
    <div class="card-body card-block">
      <form action="" method="POST" class="form-horizontal">
        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Auditor</label></div>
          <div class="col-12 col-md-9">
            <select name="auditor" id="select" class="form-control">
              <option value="">Select Auditor</option>
              <?php 
              echo $list_Auditor; 
              ?>
            </select>
          </div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Flagged Transaction List</label></div>
          <div class="col-12 col-md-9">
            <select name="flagged" id="select" class="form-control">
              <option value="">Select Flagged Transaction</option>
              <?php 
              echo $list_Flagged; 
              ?>
            </select>
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm col-12" name="assign" value="Assign">
            <i class="fa fa-dot-circle-o"></i> Assign
          </button>
        </div>
      </form>
    </div>
  </div>
</div>