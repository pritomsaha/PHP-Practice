<?php
require_once("config.php");
	
	
	$id=$_POST['id'];
	
	if(isset($_POST['edit_prof'])){
	  $id=$_POST['id'];
	  $name=mysqli_real_escape_string($db,$_POST["name"]);
	  $roll=trim($_POST["roll"]);
	  $class_id=mysqli_real_escape_string($db,$_POST["classes"]);
	  $address=mysqli_real_escape_string($db,$_POST["address"]);
	  $phone_number=mysqli_real_escape_string($db,$_POST["phone_number"]);
	  $email=mysqli_real_escape_string($db,$_POST["email"]);
  	  $updated_date=mysqli_real_escape_string($db,date('Y-m-d H:i:s', strtotime(date("Y/m/d"))));
  	 

  	  if($db->query("UPDATE student_info SET name='$name', roll='$roll', class_id='$class_id',address='$address', phone='$phone_number', email='$email', updated_on='$updated_date' where id=$id")){
  	  	
  	  }
  	  else echo "Problem";
	}

	
	$student_details=$db->query("select * from student_info where id=$id ")->fetch_array(MYSQLI_ASSOC);
	$class_id=$student_details['class_id'];
	$class=$db->query("select name from classes where id= $class_id")->fetch_array(MYSQLI_ASSOC);
	$entry_date=date('d M Y', strtotime($student_details['entry_on']));
	$updated_date=date('d M Y', strtotime($student_details['updated_on']));
?>

<!DOCTYPE html>
<html>
<head>
  <title>Personal Details</title>
  <?php require_once('load.html'); ?> 
</head>
<body>
<?php require_once('navbar.html'); ?>

<div class="container" id="containter">

      <div class="row">
      
        <div >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $student_details['name'] ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src=<?php echo $student_details['picture'] ?> class="img-circle img-responsive"> </div>
                
               
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Class</td>
                        <td><?php echo $class['name'] ?></td>
                      </tr>
                      <tr>
                        <td>Roll Number</td>
                        <td><?php echo $student_details['roll'] ?></td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td><?php echo $student_details['address'] ?></td>
                      </tr>
                   
                     <tr>
                        <td>Phone Number</td>
                        <td><?php echo $student_details['phone'] ?></td>
                      </tr>

                      <tr>
                        <td>Email</td>
                        <td><?php echo $student_details['email'] ?></td>
                      </tr>

                      <tr>
                        <td>Entry Date</td>
                        <td><?php echo $entry_date ?></td>
                      </tr>

                      <tr>
                        <td>Last Updated</td>
                        <td><?php echo $updated_date ?></td>
                      </tr>  
                     
                    </tbody>
                  </table>
                  
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                  <button id="modalBtn" class="btn btn-primary" >Edit Profile</button>
                 </div>
            
          </div>
        </div>
      </div>
    </div>
    <?php require_once('edit_profile.html') ?>

<script src="assets/js/modal.js"></script>
</body>
</body>
</html>