<?php 
include_once('../includes/header.php');
include_once('../includes/footer.php');
validateAccess();

if(isset($_POST['submit'])){

  $village = mysqli_real_escape_string($con, $_POST['village']);
  $zone = mysqli_real_escape_string($con, $_POST['zone']);
  $street = mysqli_real_escape_string($con, $_POST['street']);


  $sql = "INSERT INTO parkinglotprofile (parkinglotarea, parkingzonefield, parkinglotstreet)  VALUES ('$village', '$zone', '$street')";
  $con->query($sql) or die(mysqli_error($con)); 

}

?>

<div class="col-lg-12">
  <div class="col-lg-3">
  </div>
  <div class="card col-lg-6">
    <div class="card-header">
      <strong>Register Parking </strong>Form
    </div>
    <div class="card-body card-block">
     <?php
     if (isset($_REQUEST['submit']))
     {
       echo "<div class='row form-group'>
       <div class='col col-md-3'></div>
       <div class='col-12 col-md-9'>
       <div class='alert alert-success'>
       Registered Successfully!
       </div>
       </div>
       </div>";
     }
     ?>
     <form action="" method="POST" class="form-horizontal">

      <div class="row form-group">
        <div class="col col-md-3"><label for="select" class=" form-control-label">Village</label></div>
        <div class="col-12 col-md-9">
          <select name="village" id="select" class="form-control">
            <option value="">Select Village</option>
            <option value="Salcedo Village">Salcedo Village</option>
            <option value="Legaspi Village">Legaspi Village</option>
            <option value="Apartment Ridge">Apartment Ridge</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col col-md-3"><label for="select" class=" form-control-label">Zone</label></div>
        <div class="col-12 col-md-9">
          <select name="zone" id="select" class="form-control">
            <option value="">Select Zone</option>
            <option value="1">Zone 1</option>
            <option value="2">Zone 2</option>
            <option value="3">Zone 3</option>
            <option value="4">Zone 4</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col col-md-3"><label for="select" class=" form-control-label">Street</label></div>
        <div class="col-12 col-md-9">
          <select name="street" id="select" class="form-control">
            <option value="">Select Street</option>
            <option value="Amarsolo Street">Amarsolo Street</option>
            <option value="Aguirre Street">Aguirre Street</option>
            <option value="Apartment Ridge Road">Apartment Ridge Road</option>
            <option value="Benavidez Street">Benavidez Street</option>
            <option value="Bolanos Stree">Bolanos Street</option>
            <option value="Bautista Street">Bautista Street</option>
            <option value="Castro Street">Castro Street</option>
            <option value="Carlos Palanca Street">Carlos Palanca Street</option>
            <option value="Dela Costa Street">Dela Costa Street</option>
            <option value="Dela Rosa Access Road">Dela Rosa Access Road</option>
            <option value="Delar Rosa Access Road">Delar Rosa Access Road</option>
            <option value="Esteban Street">Esteban Street</option>
            <option value="Gamboa Street">Gamboa Street</option>    
            <option value="Gallardo Street">Gallardo Street</option>
            <option value="Jimenez Street">Jimenez Street</option>
            <option value="Legaspi Street">Legaspi Street</option>
            <option value="Legaspi Street(Rada-TMC)">Legaspi Street(Rada-TMC)</option>
            <option value="Leviste Street (Dela Costa - Villar)">Leviste Street (Dela Costa - Villar)</option>
            <option value="Leviste Street (Dela Costa - VA. Rufino)">Leviste Street (Dela Costa - VA. Rufino)</option>
            <option value="Leviste Street (VA. Rufino - Sedeño)">Leviste Street (VA. Rufino - Sedeño)</option>
            <option value="Leviste Street (Villar - Velasquez)">Leviste Street (Villar - Velasquez)</option>
            <option value="Lakandula Street">Lakandula Street</option>
            <option value="Nieva Street">Nieva Street</option>
            <option value="Perea Street">Perea Street</option>
            <option value="Rada Street(Legazpi - Dela Rosa)">Rada Street(Legazpi - Dela Rosa)</option>
            <option value="Rodriguez Street">Rodriguez Street</option>
            <option value="Soliman Street">Soliman Street</option>
            <option value="Salcedo Street(Va Rufino -Gamboa)">Salcedo Street(Va Rufino -Gamboa)</option>
            <option value="Salcedo Street(Aguirre - Benavidez)">Salcedo Street(Aguirre - Benavidez)</option>
            <option value="Soria Street">Soria Street</option>
            <option value="Sotto Street">Sotto Street</option>
            <option value="San Agustin Street">San Agustin Street</option>
            <option value="Sto. Tomas Street">Sto. Tomas Street</option>
            <option value="Trasierra Street">Trasierra Street</option>
            <option value="Tordesillas Street">Tordesillas Street</option>
            <option value="Valero Access Road">Valero Access Road</option>
            <option value="Valero Street">Valero Street</option>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="col-12 btn btn-primary btn-sm" name="submit"value="submit">
          <i class="fa fa-dot-circle-o"></i> Submit
        </button>
      </div>

    </form>
  </div>
</div>
</div>