<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

$sql = "SELECT a.id AS id, a.transactiontime AS timein, a.timeout AS timeout, 
a.price AS price, a.dateoftransaction AS transactiondate, u.userprofile_ID, u.firstname, u.lastname
FROM arduinotransactionhistory a
INNER JOIN userprofile u ON a.userprofile_ID = u.userprofile_ID";

$result = $con->query($sql) or die(mysqli_error($con));

?>

<script type="text/javascript">
	$(document).ready(function(){
		$(' .container').load(' .container');
		refresh();
	});

	function refresh(){
		setTimeout(function(){
			$(' .container').load(' .container');
			refresh();
		}, 3000);
	}
</script>

<div class="col-lg-12" id="employeelist">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Transaction List</strong>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Time-in</th>
                                  <th scope="col">Time-out</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Transaction Date</th>
                                  <th scope="col">Name</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $count = 1;
                                while ($row = mysqli_fetch_array($result))
                                {
                                  $id = $row['id'];
                                  $timein = $row['timein'];
                                  $timeout = $row['timeout'];
                                  $price = $row['price'];
                                  $transactiondate = $row['transactiondate'];
                                  $name = $row['firstname']. ' ' .$row['lastname']; 

                                  echo "
                                  <tr>
                                  <th scope='row'>$id</th>
                                  <td>$timein</td>
                                  <td>$timeout</td>
                                  <td>$price</td>
                                  <td>$transactiondate</td>
                                  <td>$name</td>
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

                