<?php 

/*

$sql = 'SELECT pav.pav_ID, pav.dlqstatusref_ID, pav.pavref_ID, pav.parkinglotprofile_ID, pav.id, a.attendantname, d.description AS status, v.violationName AS violation, p.parkinglotarea AS village, p.parkingzonefield AS zone, p.parkinglotstreet AS street
FROM paviolationhistory pav 
INNER JOIN delinquenciesstatusref d ON pav.dlqstatusref_ID = d.dlqstatusref_ID
INNER JOIN paviolationsref v ON pav.pavref_ID = v.pavref_ID
INNER JOIN parkinglotprofile p ON pav.parkinglotprofile_ID = p.parkinglotprofile_ID
INNER JOIN arduinotransactionhistory a ON pav.id = a.id';

$result = $con->query($sql) or die(mysqli_error($con));*/

if(isset($_REQUEST['id']))
{
  if(ctype_digit($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    include_once('../includes/header.php');
    include_once('../includes/footer.php');
    validateAccess();
    $sql = "SELECT pav.dlqstatusref_ID, pav.pavref_ID, pav.parkinglotprofile_ID, pav.id, pav.lastmodified AS lastUpdate, a.dateoftransaction AS flaggeddate, 
    d.description AS status, v.violationName AS violation, p.parkinglotarea AS village, p.parkingzonefield AS zone, p.parkinglotstreet AS street, 
    a.userprofile_ID AS parkingattendant, u.firstname, u.lastname, a.discrepancy AS disc, a.transactiontime AS timein, a.timeout AS timeout, pav.violationstatus AS violationstatus
    FROM paviolationhistory pav 
    INNER JOIN delinquenciesstatusref d ON pav.dlqstatusref_ID = d.dlqstatusref_ID
    INNER JOIN paviolationsref v ON pav.pavref_ID = v.pavref_ID
    INNER JOIN parkinglotprofile p ON pav.parkinglotprofile_ID = p.parkinglotprofile_ID
    INNER JOIN arduinotransactionhistory a ON pav.id = a.id
    INNER JOIN userprofile u ON pav.userprofile_ID = u.userprofile_ID
    WHERE pav_ID = $id";
    $result = $con->query($sql) or die(mysqli_error($con));

    $sql_reason = "SELECT reason FROM paviolationhistory WHERE pav_ID = $id";
    $result_reason = $con->query($sql_reason) or die(mysqli_error($con));
    $sql_remarks = "SELECT remarks FROM paviolationhistory WHERE pav_ID = $id";
    $result_remarks = $con->query($sql_remarks) or die(mysqli_error($con));

    while($row = mysqli_fetch_array($result))
    {
      $transactionID = $row['id'];
      $status = $row['status'];
      $violation = $row['violation'];
      $village = $row['village'];
      $zone = $row['zone'];
      $street = $row['street'];
      $paname = $row['parkingattendant'];
      $auditorfn = $row['firstname'];
      $auditorln = $row['lastname'];
      $auditor = $auditorfn. ' ' .$auditorln;
      $flaggeddate = $row['flaggeddate'];
      $lastupdate = $row['lastUpdate'];
      $disc = $row['disc'];
      $timein = $row['timein'];
      $timeout = $row['timeout'];
      $violationstatus = $row['violationstatus'];


      $sql_getPA = "SELECT firstname, lastname FROM userprofile WHERE userprofile_ID = $paname";
      $result_getPA = $con->query($sql_getPA) or die(mysqli_error($con));
      while($row = mysqli_fetch_array($result_getPA))
      {
        $parkingattendant = $row['firstname']. ' ' .$row['lastname'];
      }
    }

    if(isset($_POST['start']) && $status == "For review"){
      $sql_status = "UPDATE paviolationhistory SET dlqstatusref_ID = 2 WHERE id = $transactionID";
      $con->query($sql_status) or die(mysqli_error($con));
      header("location: detailedflaggedtransaction.php?id=$id");
    }
    if(isset($_POST['start']) && $status == "Ongoing"){
      $sql_status = "UPDATE paviolationhistory SET dlqstatusref_ID = 3 WHERE id = $transactionID";
      $con->query($sql_status) or die(mysqli_error($con));
      header("location: detailedflaggedtransaction.php?id=$id");
    }
    if(isset($_POST['start']) && $status == "Investigating"){
      $sql_status = "UPDATE paviolationhistory SET dlqstatusref_ID = 4, violationstatus = 'Confirmed Violation' WHERE id = $transactionID";
      $con->query($sql_status) or die(mysqli_error($con));
      header("location: detailedflaggedtransaction.php?id=$id");
    }

    if(isset($_POST['reason']) && $status == "Investigating"){
      $reason = mysqli_real_escape_string($con, $_POST['PAComment']);
      $sql_reason = "UPDATE paviolationhistory SET reason = '$reason', lastModified = NOW() WHERE pav_ID = $id";
      $con->query($sql_reason) or die(mysqli_error($con));
      header("location: detailedflaggedtransaction.php?id=$id");
    }

    if(isset($_POST['assessment']) && $status == "Investigating"){
      $comment = mysqli_real_escape_string($con, $_POST['comment']);
      $sql_reason = "UPDATE paviolationhistory SET remarks = '$comment', lastModified = NOW() WHERE pav_ID = $id";
      $con->query($sql_reason) or die(mysqli_error($con));
      header("location: detailedflaggedtransaction.php?id=$id");
    }

  }
}

?>  

<!-- Left  panel --> 
<form method="POST" action="">
  <div class="col-lg-7">
    <div class="card">
      <div class="card-header">


        <strong class="card-title">VIO-<?php echo $id ?></strong>
        <br/>
        <?php echo $violation ?> - <?php echo $parkingattendant; ?> [Date Created - Timestamp]
        <br/>
        <br/>
        <?php 
        if($status == "For review" && $typeid == 2){
          echo "<input type='submit' class='btn btn-danger col-sm-3' name='start' value='Start'>";
        }

        else if($status == "Ongoing" && $typeid == 2){
          echo "<button type='button' class='btn btn-danger mb-1' data-toggle='modal' data-target='#staticModal'>
          Confirm Violation
        </button>

        <div class='modal fade' id='staticModal' tabindex='-1' role='dialog' aria-labelledby='staticModalLabel' aria-hidden='true' data-backdrop='static'>
          <div class='modal-dialog modal-md' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title' id='staticModalLabel'></h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>
              <div class='modal-body'>
                <p>
                  This Violation ticket will be transferred to the Head of Operations.             
                </p>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                <input type='submit' class='btn btn-danger' name='start' value='Post'>
              </div>
            </div>
          </div>
        </div>
        ";
      }
      else if($status == "Investigating" && $typeid == 1){
        echo "
        <button type='button' class='btn btn-danger mb-1' data-toggle='modal' data-target='#staticModal'>
          Process
        </button>

        <div class='modal fade' id='staticModal' tabindex='-1' role='dialog' aria-labelledby='staticModalLabel' aria-hidden='true' data-backdrop='static'>
          <div class='modal-dialog modal-md' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title' id='staticModalLabel'></h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>
              <div class='modal-body'>
                <p>
                  Final Assessment             
                </p>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                <input type='submit' class='btn btn-danger' name='start' value='Issue Delinquency Ticket'>
              </div>
            </div>
          </div>
        </div>
        ";
      }
      else if($status == "Processed"){
        echo "
        <input type='submit' class='btn btn-danger col-sm-3' name='generate_pdf' value='Generate Reports' onclick='myFunction()'>";
      }

      ?>
    </div>
    <div class="card-body">
      <div class="col-3">
        Status: <?php echo $status ?>
        Violation: <?php echo $violation ?>
      </div>
      <div class="col-9">
        Village: <?php echo $village ?>
        <br/>
        Zone: <?php echo $zone ?>
        <br/>
        Street: <?php echo $street ?>
      </div>
    </div>
  </div>
  
  <?php

  while($row = mysqli_fetch_array($result_reason))
  {
    $reason = $row['reason'];

    echo "<h2>Parking Attendant's Reason: </h2>
    <br/>
    <p>$reason</p>";
  }
  ?>
  <hr>
  <div class="col-12 col-md-12">
    <?php 
    if($status == "Investigating" && $typeid == 3){

      echo "
      <textarea name='PAComment' id='textarea-input' rows='5' placeholder='Add...' class='form-control'></textarea><br/>
      <div class='col-lg-5'></div>
      <button class='btn btn-primary' name='reason'>Add Comment</button>
      ";
    }
    else{
      echo"";
    }
    ?>
  </div>
  
  <?php
  while($row = mysqli_fetch_array($result_remarks))
  {
    $remarks = $row['remarks'];

    echo "<h3>Head of Operations added a Final Assessment</h3>
    <br/>
    <p>$remarks</p>";
  }
  ?>
  <hr>
  <div class="col-12 col-md-12">
    <?php 
    if($status == "Investigating" && $typeid == 1){

      echo "
      <textarea name='comment' id='textarea-input' rows='5' placeholder='Add...' class='form-control'></textarea><br/>
      <div class='col-lg-5'></div>
      <button class='btn btn-primary' name='assessment'>Add Comment</button>
      ";
    }
    else{
      echo"";
    }
    ?>
  </div>
</div>



<!-- Right panel --> 
<div class="col-lg-5">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">People</h3>
      </div>
      <div class="card-body">
        <div class="col-12">
          Parking Attendant: &nbsp<strong><?php echo $parkingattendant ?></strong>
          <br/>
          <hr>
          Auditor: &nbsp<strong><?php echo $auditor ?></strong>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Date</h3>
      </div>
      <div class="card-body">
        <div class="col-12 col-sm-12">
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class="form-control-sm form-control-label">Flagged Date</label></div>
            <div class="col-12 col-md-7"><input value="<?php echo $flaggeddate ?>" type="text" id="hf-email" name="hf-email" class="form-control from-control-sm" readonly></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class="form-control-sm form-control-label">Last Update</label></div>
            <div class="col-12 col-md-7"><input value="<?php echo $lastupdate ?>" type="text" id="hf-email" name="hf-email" class="form-control" readonly ></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Flagging History</h3>
      </div>
      <div class="card-body">
        <div class="col-12 col-sm-12">
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class=" form-control-label">Transaction Type:</label></div>
            <div class="col-12 col-md-7"> (2) Hours</div>
          </div>
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class=" form-control-label">Flagged Date:</label></div>
            <div class="col-12 col-md-7"><input type="text" id="hf-email" name="hf-email" class="form-control" readonly value="<?php echo $flaggeddate ?>"></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class=" form-control-label">Start:</label></div>
            <div class="col-12 col-md-7"><input type="text" id="hf-email" name="hf-email" class="form-control" value="<?php echo $timein ?>" readonly ></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class=" form-control-label">End:</label></div>
            <div class="col-12 col-md-7"><input type="text" id="hf-email" name="hf-email" class="form-control" value="<?php echo $timeout ?>"  readonly ></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class=" form-control-label">Discrepancy</label></div>
            <div class="col-12 col-md-7"><input type="text" id="hf-email" name="hf-email" class="form-control" value="<?php echo $disc ?>" readonly></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-5"><label for="hf-email" class=" form-control-label">Violation Status</label></div>
            <div class="col-12 col-md-7"><?php 
            if($status == "Processed"){

              echo $violationstatus;
            }
                

             ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  function myFunction() {
    window.print();
  }
</script>