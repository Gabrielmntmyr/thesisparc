<?php 

include 'header.php';
include 'db.php';

$sql = "SELECT u.userprofile_ID, t.userType, CONCAT(u.firstname, ' ' ,u.lastname) AS name
FROM userprofile u INNER JOIN usertype t ON u.usertype_ID = t.usertype_ID
WHERE t.usertype_ID='2'";

$result = $con->query($sql) or die(mysqli_error($con));


include 'footer.php';

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
            <th scope="col">Position</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Discrepancy</th>
            <th scope="col">Control</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          while ($row = mysqli_fetch_array($result))
          {
            $id = $row['userprofile_ID'];
            $type = $row['userType'];
            $name = $row['name'];

            echo "
            <tr>
            <th scope='row'>$id</th>
            <td>$type</td>
            <td>$name</td>
            <td>Under Review</td>
            <td></td>
            <td>
            <a href='forreviewparkingattendant.php'><input type='button' class='btn btn-primary' name='archive' value='Review'></a>
            </td>
            </tr>
            ";
            $count++;
          }
          ?>     
        </tbody>
      </table>
    </div>
  </div>
</div>
