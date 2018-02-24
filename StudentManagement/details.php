<?php 

	require_once("objects/database.php");
	require_once("objects/student.php");
	$database = new Database();
	$db = $database->getConnection();
	$student=new Student($db);

	if (!empty($_POST['id'])) {
		$student->id=$_POST['id'];	
	}
	
	if(isset($_POST['edit_prof'])){
	  $student->id=$_POST['id'];
	  $student->name=mysqli_real_escape_string($db,$_POST["name"]);
	  $student->roll=trim($_POST["roll"]);
	  $student->class_id=mysqli_real_escape_string($db,$_POST["classes"]);
	  $student->address=mysqli_real_escape_string($db,$_POST["address"]);
	  $student->phone=mysqli_real_escape_string($db,$_POST["phone_number"]);
	  $student->email=mysqli_real_escape_string($db,$_POST["email"]);
  	  $student->updated_on=mysqli_real_escape_string($db,date('Y-m-d H:i:s', strtotime(date("Y/m/d"))));
  	 
  	  $student->update();
	}


	$student->read();
	$class=$db->query("select name from classes where id= '$student->class_id' ")->fetch_array(MYSQLI_ASSOC);
	$entry_date=date('d M Y', strtotime($student->entry_on));
	$updated_date=date('d M Y', strtotime($student->updated_on));

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
              <h3 class="panel-title"><?php echo $student->name ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src=<?php echo $student->picture ?> class="img-circle img-responsive"> </div>
                
               
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Class</td>
                        <td><?php echo $class['name'] ?></td>
                      </tr>
                      <tr>
                        <td>Roll Number</td>
                        <td><?php echo $student->roll ?></td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td><?php echo $student->address ?></td>
                      </tr>
                   
                     <tr>
                        <td>Phone Number</td>
                        <td><?php echo $student->phone ?></td>
                      </tr>

                      <tr>
                        <td>Email</td>
                        <td><?php echo $student->email ?></td>
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