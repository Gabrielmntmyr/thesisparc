<?php 

include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

if(isset($_REQUEST['id']))
{
  $id = $_REQUEST['id'];

  # display existing record
  $sql_data = "SELECT userprofile_ID, firstname, lastname, email, contact,
  username, password FROM userprofile WHERE userprofile_ID=$id";
  $result_data = $con->query($sql_data);

      # checks if record is not existing
  if (mysqli_num_rows($result_data) == 0)
  {
    header('location: viewemployee.php');
  }

  while ($row = mysqli_fetch_array($result_data))
  {
    $id = $row['userprofile_ID'];
    $fn = $row['firstname'];
    $ln = $row['lastname'];
    $email = $row['email'];
    $contact = $row['contact'];
    $username = $row['username'];
    $password = $row['password'];
  }

  # updates existing record
  if (isset($_POST['update']))
  {
    $fn = mysqli_real_escape_string($con, $_POST['fn']);
    $ln = mysqli_real_escape_string($con, $_POST['ln']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $pw = hash('sha256', mysqli_real_escape_string($con, $_POST['password']));

    if ($_POST['pw'] == "")
    {
      $sql_update = "UPDATE userprofile SET firstname='$fn', 
      lastname='$ln', email='$email', contact='$contact',
      username='$username', password='$pw', lastModified=NOW()
      WHERE userprofile_ID=$id";
    }
    else
    {
      $sql_update = $sql_update = "UPDATE userprofile SET firstname='$fn', 
      lastname='$ln', email='$email', contact='$contact',
      username='$username', password='$pw', lastModified=NOW()
      WHERE userprofile_ID=$id";
    }

    $result = $con->query($sql_update) or die(mysqli_error($con));
    header("location: editemployee.php?id=$id");
  }

}

?>


<div class="col-lg-12">
  <div class="col-lg-3"></div>
  <div class="card col-lg-6">
    <div class="card-header">
      <strong>Edit </strong>Form
    </div>
    <div class="card-body card-block">
      <form action="" method="POST" class="form-horizontal">
        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">First name</label></div>
          <div class="col-12 col-md-9"><input type="text" id="hf-email" name="fn" placeholder="" value="<?php echo $fn; ?>" class="form-control"></div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Last name</label></div>
          <div class="col-12 col-md-9"><input type="text" id="hf-email" name="ln" placeholder="" value="<?php echo $ln; ?>" class="form-control"></div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Email</label></div>
          <div class="col-12 col-md-9"><input type="email" id="hf-email" name="email" placeholder="" value="<?php echo $email; ?>" class="form-control"></div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Contact</label></div>
          <div class="col-12 col-md-9"><input type="number" id="hf-email" name="contact" placeholder="" value="<?php echo $contact; ?>" class="form-control"></div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Username</label></div>
          <div class="col-12 col-md-9"><input type="text" id="hf-email" name="username" placeholder="" value="<?php echo $username; ?>" class="form-control"></div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Password</label></div>
          <div class="col-12 col-md-9"><input type="password" id="hf-email" name="password" placeholder="" value="<?php echo $password; ?>" class="form-control"></div>
        </div>
      </div>

      <div class="card-body card-block">
        <!--<div class="row form-group">
          <label class="control-label col-lg-4">Image</label>
          <div class="col-lg-8">
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                <img src='<?php echo app_path; ?>images/placeholder.png' alt="...">
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
              <div>
                <span class="btn btn-default btn-file">
                  <span class="fileinput-new btn btn-danger btn-sm">Select image</span>
                  <span class="fileinput-exists btn btn-danger btn-sm">Change</span>
                  <input type="file" name="image" required>
                </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>-->

        <div class="card-footer">
          <button type="submit" name="update" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Update
          </button>
        </div>

        <div class="card-footer">
          <button type="submit" name="archive" class="btn btn-danger btn-sm">
            <i class="fa fa-dot-circle-o"></i> Archive
          </button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
  var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
  'onclick="alert(\'Call your custom code here.\')">' +
  '<i class="glyphicon glyphicon-tag"></i>' +
  '</button>'; 
  $("#avatar-1").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-1',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
  });
</script>