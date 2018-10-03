<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();
require "../PHPMailer/PHPMailerAutoload.php";


$mail = new phpmailer;
$mail->isSMTP();
$mail->Host = "smtp.mailgun.org";
$mail->SMTPAuth = true;
$mail->Username = "mico@admin.csbparc.com";
$mail->Password = "Mico!@#";
$mail->SMTPSecure = true;
$mail->Port = "465";

$mail->setFrom('mico@admin.csbparc.com', 'PARC Team');
$mail->isHTML(true);

 # displays list of user types
$sql_types = "SELECT usertype_ID, userType FROM usertype WHERE usertype_ID = 2 OR usertype_ID = 3";
$result_types = $con->query($sql_types);

$list_types = "";
while ($row = mysqli_fetch_array($result_types))
{
  $typeID = $row['usertype_ID'];
  $userType = $row['userType'];
  $list_types .= "<option value='$typeID'>$userType</option>";
}


# add a user record
if (isset($_POST['submit']))
{
  $typeID = mysqli_real_escape_string($con, $_POST['utype']);
  $fn = mysqli_real_escape_string($con, $_POST['fn']);
  $ln = mysqli_real_escape_string($con, $_POST['ln']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $contact = mysqli_real_escape_string($con, $_POST['contact']);
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $pw = hash('sha256', mysqli_real_escape_string($con, $_POST['password']));

  $sql_validate = "SELECT username FROM userprofile WHERE username='$username'";
  $result_validate = $con->query($sql_validate) or die(mysqli_error($con));

  if (mysqli_num_rows($result_validate) == 0)
  {
    $sql_add = "INSERT INTO userprofile VALUES ('', $typeID, '$fn', '$ln', 'Active', '$email',
    '$contact' ,'$username', '$pw',  NOW(), NOW())";
    $con->query($sql_add) or die(mysqli_error($con));

    $url = "https://www.csbparc.com/confirmemail.php?e=$email&pw=$pw";

    $mail->addAddress($email, $fn . " " . $ln);
    $mail->Subject = "Account Confirmation";
    $mail->Body = "Welcome, $fn $ln!</br>
    You have successfully registered your account.</br>
    Your email address is: $email <br/><br/>
    Click the confirmation link below:<br/>
    <a href='$url' target='_blank'>$url</a>
    <br/><br/>


    Thank you!<br/>
    - PARC Team";

    if(!$mail->send())
    {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
    else
    {
      echo 'Message has been sent';
    }

    header('location: addemployee.php');
  }
}

?>


<div class="col-lg-12">
  <div class="col-lg-3"></div>
  <div class="card col-lg-6">
    <div class="card-header">
      <strong>Register</strong> Form
    </div>
    <div class="card-body card-block">
      <form action="" method="POST" class="form-horizontal">

        <?php
        if (isset($_POST['submit']) && mysqli_num_rows($result_validate) > 0)
        {
         echo "
         <div class='alert alert-danger'>
           Username already exist!
         </div>";
       }
       if (isset($_REQUEST['submit']) && mysqli_num_rows($result_validate) == 0)
       {
         echo "
         <div class='row form-group'>
           <div class='col col-md-3'></div>
           <div class='col-12 col-md-9'>
             <div class='alert alert-success'>
               Registered Successfully!
             </div>
           </div>
         </div>";
       }
       ?>

       <div class="row form-group">
        <div class="col col-md-3"><label class=" form-control-label">Type</label></div>
        <div class="col-12 col-md-9">
         <select name="utype" id="select" class="form-control">
          <?php echo $list_types; ?>
        </select>
      </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label class=" form-control-label">First name</label></div>
        <div class="col-12 col-md-9"><input type="text" name="fn" placeholder="Enter First name..." class="form-control"></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Last name</label></div>
        <div class="col-12 col-md-9"><input type="text" name="ln" placeholder="Enter Last name..." class="form-control"></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Email</label></div>
        <div class="col-12 col-md-9"><input type="email" name="email" placeholder="Enter Email..." class="form-control"></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Contact</label></div>
        <div class="col-12 col-md-9"><input type="text" name="contact" placeholder="Enter Mobile..." class="form-control"></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Username</label></div>
        <div class="col-12 col-md-9"><input type="text" name="username" placeholder="Enter Username..." class="form-control"></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Password</label></div>
        <div class="col-12 col-md-9"><input type="password" name="password" placeholder="Enter Password..." class="form-control"></div>
      </div>

      <div class="card-footer">
        <button type="submit" name="submit" class="btn btn-primary btn-sm">
          <i class="fa fa-dot-circle-o"></i> Submit
        </button>
      </div>

    </form>
  </div>
</div>
</div>