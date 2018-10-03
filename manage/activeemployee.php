<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

$sql = "SELECT u.userprofile_ID, t.userType, u.firstname, u.lastname,
  u.status FROM userprofile u INNER JOIN usertype t ON u.usertype_ID = t.usertype_ID
  WHERE u.status='Active'";

$result = $con->query($sql) or die(mysqli_error($con));
?>

<div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Active Employee List</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">User Type</th>
                                  <th scope="col">First Name</th>
                                  <th scope="col">Last Name</th>
                                  <th scope="col">Status</th>
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
                                  $fn = $row['firstname'];
                                  $ln = $row['lastname'];
                                  $status = $row['status'];

                                  echo "
                                  <tr>
                                  <th scope='row'>$id</th>
                                  <td>$type</td>
                                  <td>$fn</td>
                                  <td>$ln</td>
                                  <td>$status</td>
                                  <td>
                                  <a href='editemployee.php'><input type='button' class='btn btn-primary' name='edit' value='Edit'></a>
                                    <a href='archiveemployee.php'><input type='button' class='btn btn-danger' name='archive' value='Archive'></a>
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
