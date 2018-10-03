<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

$sql_getemployee = "SELECT parkinglotprofile_ID, parkinglotarea, parkingzonefield, parkinglotstreet, userprofile_ID FROM parkinglotprofile";

$result_employee = $con->query($sql_getemployee) or die(mysqli_error($con));
?>

<div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Parking Slot List</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Village</th>
                                  <th scope="col">Zone</th>
                                  <th scope="col">Street</th>
                                  <th scope="col">User ID</th>

                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $count = 1;
                                while ($row = mysqli_fetch_array($result_employee))
                                {
                                  $id = $row['parkinglotprofile_ID'];
                                  $village = $row['parkinglotarea'];
                                  $zone = $row['parkingzonefield'];
                                  $street = $row['parkinglotstreet'];
                                  $userprofileid = $row['userprofile_ID'];

                                  echo "
                                  <tr>
                                  <th scope='row'>$id</th>
                                  <td>$village</td>
                                  <td>$zone</td>
                                  <td>$street</td>
                                  <td>$userprofileid</td>
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
