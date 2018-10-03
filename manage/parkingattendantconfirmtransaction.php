<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

$sql_realtimetransaction = "SELECT a.arduino_id AS id, a.parkingstatus AS status, a.confirm, a.activetime AS realtime, 
a.transactiontime AS timein, a.timeout AS timeout, a.lastplate AS lastplate, p.parkinglotprofile_ID, p.parkinglotstreet AS street, a.confirm1
FROM arduinorealtimemonitor a
INNER JOIN parkinglotprofile p ON  a.parkinglotprofile_ID = p.parkinglotprofile_ID
WHERE confirm = 'Yes'";

$result_realtimetransaction  = $con->query($sql_realtimetransaction) or die(mysqli_error($con));

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

<div class="container">
	<div class="col-12">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Confirm Transaction</strong>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Time-in</th>
								<th scope="col">Time-out</th>
								<th scope="col">Active time</th>
								<th scope="col">Street</th>
								<th scope="col">Control</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							while ($row = mysqli_fetch_array($result_realtimetransaction))
							{
								$id = $row['id'];
								$activetime = $row['realtime'];
								$transactiontime = $row['timein'];
								$timeout = $row['timeout'];
								$lastplate = $row['lastplate'];
								$street = $row['street'];
								$confirm1 = $row['confirm1'];

								if($confirm1 == 'Yes'){
									echo "
								<tr>
								<th scope='row'>$id</th>
								<td class='timein'>$transactiontime</td>
								<td class='timeout'>$timeout</td>
								<td class='realtime'><p class='timer'>$activetime</p></td>
								<td>$street</td>
								<td><a href='inputplate.php?id=$id&time=$transactiontime'><input type='button' class='btn btn-primary' name='confirm' value='Confirm' style='display:none;'></a>			
								</td>
								</tr>
								";
								$count++;
								}
								else{
								echo "
								<tr>
								<th scope='row'>$id</th>
								<td class='timein'>$transactiontime</td>
								<td class='timeout'>$timeout</td>
								<td class='realtime'><p class='timer'>$activetime</p></td>
								<td>$street</td>
								<td><a href='inputplate.php?id=$id&time=$transactiontime'><input type='button' class='btn btn-primary' name='confirm' value='Confirm'></a>			
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
