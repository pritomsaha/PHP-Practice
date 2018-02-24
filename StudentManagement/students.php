<?php 
	require_once("objects/database.php");
	require_once("objects/student.php");
	$database = new Database();
	$db = $database->getConnection();
	$student=new Student($db);

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		if(isset($_POST['add'])){

			$student->name=trim($_POST["name"]);
  			$student->roll=trim($_POST["roll"]);
  			$student->class_id=trim($_POST["classes"]);
			$student->address=mysqli_real_escape_string($db,$_POST["address"]);
			$student->phone=mysqli_real_escape_string($db,$_POST["phone_number"]);
			$student->email=mysqli_real_escape_string($db,$_POST["email"]);
			$date=mysqli_real_escape_string($db,date('Y-m-d H:i:s', strtotime($_POST["startDate"])));
			$student->entry_on=$date;
			$student->updated_on=$date;
			$file = $_FILES['file'];
  			$path = "uploads/" . $file['name'];

  			if(move_uploaded_file($file['tmp_name'], $path)){
    			$student->picture=mysqli_real_escape_string($db,$path);
    			$student->creat();
   			}
		}
		else if(isset($_POST['deleteBtn'])){
    		$student->id=$_POST['delete_id'];
    		$student->delete();
  		}
	}

	$student_list=$student->readAll();
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

<?php 
if ($student_list->num_rows <1){?>
<h3>Student list is empty</h3>
<?php 
}
else{ ?>
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
      while(list($id, $name,$roll,$class_id,$email)=$student_list->fetch_row()) {
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
          <button style="border: none;" type="submit" name="deleteBtn" class="btn btn-default" onclick="return confirm ('Are You Sure to delete <?php echo "$name" ?> ?')" >Delete <span class="glyphicon glyphicon-remove"></span></button>
          </form>
        </td>
      </tr>
    <?php     
      }
?>
    </tbody>
</table>
<?php } ?>

<button id="modalBtn" class="btn btn-primary" >Add new student</button>

</div>
<?php require_once('add_student.html') ?>

<script src="assets/js/modal.js"></script>

</body>
</html>