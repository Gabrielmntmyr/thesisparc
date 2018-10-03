<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

$sql_transactionhistory = "SELECT id, a.arduino_id AS arduino, a.parkingstatus AS status, a.confirm1, t.transactiontime 
AS timein, a.timeout AS timeout, a.lastplate AS lastplate, t.plate AS plate, a.activetime AS realtime, a.parkinglotprofile_ID AS plot, t.confirm as confirm
FROM arduinotransactionhistory t 
INNER JOIN arduinorealtimemonitor a ON a.arduino_id = t.arduino_id
WHERE a.confirm1 = 'Yes'";

$result_transactionhistory  = $con->query($sql_transactionhistory) or die(mysqli_error($con));



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
		}, 1000);
	}
</script>
<form action="" method="POST" class="form-horizontal">
	<div class="container">
		<div class="col-12">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Confirm Time-out</strong>
					</div>
					<div class="card-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">Transaction ID</th>
									<th sope="col">Sensor ID</th>
									<th scope="col">Time-in</th>
									<th scope="col">Time-out</th>
									<th scope="col">Plate</th>
									<th scope="col">Control</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1;
								while ($row = mysqli_fetch_array($result_transactionhistory))
								{
									$id = $row['id'];
									$arduino = $row['arduino'];
									$transactiontime = $row['timein'];
									$timeout = $row['timeout'];
									$lastplate = $row['lastplate'];
									$plate = $row['plate'];
									$plot = $row['plot'];
									$confirm = $row['confirm'];

									$datetime1 = new DateTime($transactiontime);
									$datetime2 = new DateTime($timeout);
									$interval = $datetime1->diff($datetime2);
									$discrepancy = $interval->format('%h%i%s');

									if($confirm == 'Yes'){

									echo "
									<tr>
									<th scope='row'>$id</th>
									<th scope='row'>$arduino</th>
									<td class='timein'>$transactiontime</td>
									<td>$timeout</td>
									<td>$plate</td>
									<td>
									<a href='confirmtimeout.php?id=$id&time=$timeout&discrepancy=$discrepancy&plot=$plot'><input type='button' class='btn btn-primary' name='confirm' value='Confirm'	></a>
									</td>
									</tr>
									";
									$count++;
								}
								else{
									echo"
									<tr>
									<th scope='row'>$id</th>
									<th scope='row'>$arduino</th>
									<td class='timein'>$transactiontime</td>
									<td>$timeout</td>
									<td>$plate</td>
									<td>
									<a href='confirmtimeout.php?id=$id&time=$timeout&discrepancy=$discrepancy&plot=$plot'><input type='button' class='btn btn-primary' name='confirm' value='Confirm' ></a>
									</td>
									</tr>
									";
									$count++;
								}

								}

								echo "

								";
								?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
