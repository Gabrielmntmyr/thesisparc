<?php

include_once('../includes/loginheader.php');
include_once('../includes/footer.php');

if (isset($_POST['login']))
{
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$pw = hash('sha256', mysqli_real_escape_string($con, $_POST['password']));

	$sql_login = "SELECT userprofile_ID, usertype_ID FROM userprofile
	WHERE username='$username' AND password='$pw' AND status='Active'";
	$result_login = $con->query($sql_login) or die(mysqli_error($con));

	if (mysqli_num_rows($result_login) > 0)
	{
		while ($row = mysqli_fetch_array($result_login))
		{
			$_SESSION['userid'] = $row['userprofile_ID'];
			$_SESSION['typeid'] = $row['usertype_ID'];
		}
		header('location: ../dashboard.php');
	}
}

?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-3">
		</div>
		<div class="col-lg-6">
			<img src="<?php echo app_path ?>assets/images/logo.png" alt="Logo" class="parc-logo">
			<div class="card">
				<div class="card-header">Login</div>
				<div class="card-body card-block">
					<form action="" method="POST" class="">
						<?php
						if (isset($_POST['login']))
						{
							if (mysqli_num_rows($result_login) == 0)
							{
								echo "
								<div class='alert alert-danger'>
									Invalid <strong>username or password!</strong>
								</div>
								";
							}
						}
						?>
						<div class="form-group">
							<div class="input-group">
								<input type="text" id="username2" name="username" placeholder="&#xF007; Username" class="form-control" style="font-family:Arial, FontAwesome">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="password" id="password2" name="password" placeholder="&#xF069; Password" class="form-control" style="font-family:Arial, FontAwesome">
							</div>
						</div>
						<div class="form-actions form-group"><button type="submit" name="login" class="col-lg-12 btn btn-primary btn-sm">Submit</button></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>