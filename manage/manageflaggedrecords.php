<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();


if(isset($_REQUEST['id'])){

$id = $_REQUEST['id'];
$sql= "SELECT pav.pav_ID, pav.dlqstatusref_ID, pav.pavref_ID, pav.parkinglotprofile_ID, pav.id, d.description AS status, v.violationName AS violation, p.parkinglotarea AS village, p.parkingzonefield AS zone, p.parkinglotstreet AS street, u.userprofile_ID AS auditorID, u.lastname, u.firstname, a.userprofile_ID AS parkingattendant
FROM paviolationhistory pav 
INNER JOIN userprofile u ON pav.userprofile_ID = u.userprofile_ID
INNER JOIN delinquenciesstatusref d ON pav.dlqstatusref_ID = d.dlqstatusref_ID
INNER JOIN paviolationsref v ON pav.pavref_ID = v.pavref_ID
INNER JOIN parkinglotprofile p ON pav.parkinglotprofile_ID = p.parkinglotprofile_ID
INNER JOIN arduinotransactionhistory a ON pav.id = a.id
WHERE a.userprofile_ID = $id";

$result = $con->query($sql) or die(mysqli_error($con));
}
else{
  $sql= "SELECT pav.pav_ID, pav.dlqstatusref_ID, pav.pavref_ID, pav.parkinglotprofile_ID, pav.id, d.description AS status, v.violationName AS violation, p.parkinglotarea AS village, p.parkingzonefield AS zone, p.parkinglotstreet AS street, u.userprofile_ID AS auditorID, u.lastname, u.firstname, a.userprofile_ID AS parkingattendant
FROM paviolationhistory pav 
INNER JOIN userprofile u ON pav.userprofile_ID = u.userprofile_ID
INNER JOIN delinquenciesstatusref d ON pav.dlqstatusref_ID = d.dlqstatusref_ID
INNER JOIN paviolationsref v ON pav.pavref_ID = v.pavref_ID
INNER JOIN parkinglotprofile p ON pav.parkinglotprofile_ID = p.parkinglotprofile_ID
INNER JOIN arduinotransactionhistory a ON pav.id = a.id";

$result = $con->query($sql) or die(mysqli_error($con));
}
?>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <strong class="card-title">Flagged List</strong>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Status</th>
            <th scope="col">Auditor</th>
            <th scope="col">Violation Type</th>
            <th scope="col">Parking Attendant</th>
            <th scope="col">Village</th>
            <th scope="col">Zone</th>
            <th scope="col">Street</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          while ($row = mysqli_fetch_array($result))
          {

            $id = $row['pav_ID'];
            $status = $row['status'];
            $auditorID = $row['auditorID'];
            $auditor = $row['firstname']. ' ' .$row['lastname'];
            $violation = $row['violation'];
            $paname = $row['parkingattendant'];
            $village = $row['village'];
            $zone = $row['zone'];
            $street = $row['street'];

            $sql_getPA = "SELECT firstname, lastname FROM userprofile WHERE userprofile_ID = $paname";

            $result_getPA = $con->query($sql_getPA) or die(mysqli_error($con));

            while($row = mysqli_fetch_array($result_getPA))
            {
              $parkingattendant = $row['firstname']. ' ' .$row['lastname'];
            }

            if ($typeid == 1)
            {
              echo "
              <tr>
                <th scope='row'>
                  <a href='detailedflaggedtransaction.php?id=$id'>VIO-$id</a>
                </th>
                <td>$status</td>
                <td>$auditor</td>
                <td>$violation</td>
                <td>$parkingattendant</td>
                <td>$village</td>
                <td>$zone</td>
                <td>$street</td>
              </tr>
              ";
              $count++;
            }

            if($userid == $paname)
            {
              echo "
              <tr>
                <th scope='row'>
                  <a href='detailedflaggedtransaction.php?id=$id'>VIO-$id</a>
                </th>
                <td>$status</td>
                <td>$auditor</td>
                <td>$violation</td>
                <td>$parkingattendant</td>
                <td>$village</td>
                <td>$zone</td>
                <td>$street</td>
              </tr>
              ";
              $count++;
            }

            if($userid == $auditorID)
            {
              echo "
              <tr>
                <th scope='row'>
                  <a href='detailedflaggedtransaction.php?id=$id'>VIO-$id</a>
                </th>
                <td>$status</td>
                <td>$auditor</td>
                <td>$violation</td>
                <td>$parkingattendant</td>
                <td>$village</td>
                <td>$zone</td>
                <td>$street</td>
              </tr>
              ";
              $count++;
            }            
          }

          ?>     
        </tbody>
      </table>
    </div>
  </div>
</div>
