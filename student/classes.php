<?php  
require_once("config.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){

  if(isset($_POST['deleteBtn'])){
    $delete_id=$_POST['delete_id'];
    $db->query("DELETE from classes WHERE id=$delete_id");
  }
  else if(isset($_POST['add'])){
    $className=trim($_POST["className"]);

    $sql="INSERT INTO classes (name) VALUES('$className') ";
    if($db->query($sql)){
      header("location: classes.php");
    }  
  }  
  
}
$classes=$db->query("select id,name from classes");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Classes</title>
	<?php require_once("load.html")  ?>
</head>
<body>
<?php require_once('navbar.html'); ?>


<div class="container" id="containter">
<center><h2>Classes</h2></center>
<table class="table table-bordered">

	<thead>
		<tr>
			<th>Class Name</th>
			<th>Actions</th>
		</tr>

	</thead>
    
    <tbody>

      <?php 
      while(list($id,$name)=$classes->fetch_row()) {?> 

      <tr>
        <td><?php echo "$name"; ?></td>
        <td>
          <form method="post"> <input type="hidden" name="delete_id" value="<?php echo $id;?>">
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
<?php require_once('add_class.html') ?>

<script src="assets/js/modal.js"></script>
</body>

</html>