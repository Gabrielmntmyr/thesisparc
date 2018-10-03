<?php 

include_once('includes/header.php');
include_once('includes/footer.php');

$sql = "SELECT COUNT(parkingstatus) AS active FROM arduinorealtimemonitor WHERE parkingstatus = 'active'"; 
$sql1 = "SELECT COUNT(parkingstatus) AS inactive FROM arduinorealtimemonitor WHERE parkingstatus = 'inactive'";
$sqlnotif = "SELECT COUNT(activetime) AS notif FROM arduinorealtimemonitor WHERE activetime >= 6900";
$sql_realtimetransaction = "SELECT arduino_id, parkingstatus, confirm, plate, activetime, timeout, transactiontime, lastplate FROM arduinorealtimemonitor";


$result = $con->query($sql) or die(mysqli_error($con));
$result1 = $con->query($sql1) or die(mysqli_error($con));
$resultnotif = $con->query($sqlnotif) or die(mysqli_error($con));
$result_realtimetransaction = $con->query($sql_realtimetransaction) or die(mysqli_error($con));

$sql_PAnotif = 'SELECT pav.pav_ID, pav.dlqstatusref_ID, pav.pavref_ID, pav.parkinglotprofile_ID, pav.id, d.description AS status, v.violationName AS violation, p.parkinglotarea AS village, p.parkingzonefield AS zone, p.parkinglotstreet AS street, u.userprofile_ID, u.lastname, u.firstname, a.userprofile_ID AS parkingattendant
FROM paviolationhistory pav 
INNER JOIN userprofile u ON pav.userprofile_ID = u.userprofile_ID
INNER JOIN delinquenciesstatusref d ON pav.dlqstatusref_ID = d.dlqstatusref_ID
INNER JOIN paviolationsref v ON pav.pavref_ID = v.pavref_ID
INNER JOIN parkinglotprofile p ON pav.parkinglotprofile_ID = p.parkinglotprofile_ID
INNER JOIN arduinotransactionhistory a ON pav.id = a.id';

$result_PAnotif  = $con->query($sql_PAnotif) or die(mysqli_error($con));


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

<div class="col-sm-12" <?php togglePa(); ?>>
	<?php 
	while ($row = mysqli_fetch_array($result_PAnotif))
	{

		$paname = $row['parkingattendant'];
		$status = $row['status'];
		

		if($status == "Investigating" && $userid == $paname)
		{
			echo "
			<a href='manage/manageflaggedrecords.php?id=$userid'>
			<div class='alert alert-danger text-center'>
			You have a pending flagged transaction<br/>
			<small><strong>Click</strong> here to View</small>
			</div>
			</a>";
		}


	}

	?>


</div>

<div class="col-sm-12" <?php togglePa(); ?>>
	
	<?php
	while ($row = mysqli_fetch_array($resultnotif))
	{
		$notif = $row['notif'];
		echo " <div class ='alert alert-danger'><h4><strong>$notif</strong></h4> parking slot about to reach 2 hours in 5 mins</div>";  
	}
	?>  


</div>

<div class="container">
	<div class="col-12">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<div class="stat-widget-one">
						<div class="stat-icon dib"><i class="ti-car text-success border-success"></i></div>
						<div class="stat-content dib">
							<div class="stat-text">Occupied</div>
							<div class="stat-digit">
								<?php
								$count = 1;
								while ($row = mysqli_fetch_array($result))
								{
									$active = $row['active'];

									echo "$active";
									$count++;
								}
								?>  
							</div>    
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<div class="stat-widget-one">
						<div class="stat-icon dib"><i class="ti-car text-danger border-danger"></i></div>
						<div class="stat-content dib">
							<div class="stat-text">Available</div>
							<div class="stat-digit">
								<?php
								$count = 1;
								while ($row = mysqli_fetch_array($result1))
								{
									$inactive = $row['inactive'];

									echo "$inactive";
									$count++;
								}
								?>      
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Monitor</strong>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Parking Status</th>
								<th scope="col">Confirmation Status</th>
								<th scope="col">Plate</th>
								<th scope="col">Timer</th>
								<th scope="col">Time-in</th>
								<th scope="col">Last Plate</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$count = 1;
							while ($row = mysqli_fetch_array($result_realtimetransaction))
							{
								$id = $row['arduino_id'];
								$parkingstatus = $row['parkingstatus'];
								$confirm = $row['confirm'];
								$plate = $row['plate'];
								$activetime = $row['activetime'];
								$timein = $row['transactiontime'];
								$timeout = $row['timeout'];
								$lastplate = $row['lastplate'];

								echo "
								<tr>
								<th scope='row'>$id</th>
								<td>$parkingstatus</td>
								<td>$confirm</td>
								<td>$plate</td>
								<td>$activetime</td>
								<td>$timein</td>
								<td>$lastplate</td>

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
	</div>
</div>
