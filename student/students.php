
<?php  
require_once("config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

  if(isset($_POST['add'])){
  $name=mysqli_real_escape_string($db,$_POST["name"]);
  $roll=trim($_POST["roll"]);
  $class_id=mysqli_real_escape_string($db,$_POST["classes"]);
  $address=mysqli_real_escape_string($db,$_POST["address"]);
  $phone_number=mysqli_real_escape_string($db,$_POST["phone_number"]);
  $email=mysqli_real_escape_string($db,$_POST["email"]);
  $entry_date=$_POST["startDate"];
  $file = $_FILES['file'];

  $date=mysqli_real_escape_string($db,date('Y-m-d H:i:s', strtotime($entry_date)));

  $filename = $file['name'];
  $path = "uploads/" . $filename;

  if(move_uploaded_file($file['tmp_name'], $path)){

    $path=mysqli_real_escape_string($db,$path);
    //echo $date;
    $sql="INSERT INTO student_info (name,roll,class_id,address, phone, email,picture,entry_on,updated_on)
        VALUES ('$name', '$roll', '$class_id','$address','$phone_number','$email','$path','$date','$date')"; 
    if($db->query($sql)){
      header("location: students.php");
    }
    else echo "Problem";
   }  
  }
  else if(isset($_POST['delete_id'])){
    $delete_id=$_POST['delete_id'];
    $db->query("DELETE from student_info WHERE id=$delete_id");
  }
   
}

$students=$db->query("select id, name, roll, class_id,email from student_info");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Students</title>
	 <?php require_once("load.html")  ?>
</head>
<body>
<?php require_once('navbar.html'); ?>

<div class="container" id="containter">
<center><h2>Students</h2></center>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Class Roll</th>
        <th>Class</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      while(list($id, $name,$roll,$class_id,$email)=$students->fetch_row()) {
        $class_name=$db->query("select name from classes where id=$class_id ")->fetch_array(MYSQLI_ASSOC);
        ?> 

      <tr>
        <td><?php echo "$name"; ?></td>
        <td><?php echo "$roll"; ?></td>
        <td><?php echo $class_name['name']; ?></td>
        <td><?php echo "$email"; ?></td>
        <td><form style="display: inline-block;" action="details.php" method="post"> <input type="hidden" name="id" value="<?php echo $id;?>">
            <button style="border: none;" type="submit" name="detailsBtn" class="btn btn-default" >Details</button>
             </form>

          <form method="post" style="display: inline-block;"> <input type="hidden" name="delete_id" value="<?php echo $id;?>">
          <button style="border: none;" type="submit" name="deleteBtn" class="btn btn-default"
          onclick="return confirm ('Are You Sure to delete <?php echo "$name" ?> ?')" >Delete <span class="glyphicon glyphicon-remove"></span></button>
          </form>
        </td>
      </tr>
    <?php     
      }
?>
    </tbody>
  </table>
  <button id="modalBtn" class="btn btn-primary" >Add new student</button>

</div>
<?php require_once('add_student.html') ?>

<script src="assets/js/modal.js"></script>

</body>
</html>