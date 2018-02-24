<?php
	if(!empty($_POST["forgot-password"])){
		$conn = mysqli_connect("localhost", "root", "", "blog_samples");
		
		$condition = "";
		if(!empty($_POST["user-login-name"])) 
			$condition = " member_name = '" . $_POST["user-login-name"] . "'";
		if(!empty($_POST["user-email"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " member_email = '" . $_POST["user-email"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "Select * from members " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			require_once("forgot-password-recovery-mail.php");
		} else {
			//$error_message = 'No User Found';
			echo '<script type="text/javascript">
  document.getElementById("success_message").innerHTML = "User name or Password is incorrect";
  </script>';
			/*echo "
			<script type = 'text/javascript'>
				function do(){
				document.getElementById('success_message').innerHTML='No user found';
			}
			</script>
			
			";*/
		}
	}
?>
<link href="demo-style.css" rel="stylesheet" type="text/css">
<script>
function validate_forgot() {
	if((document.getElementById("user-login-name").value == "") && (document.getElementById("user-email").value == "")) {
		document.getElementById("validation-message").innerHTML = "Login name or Email is required!"
		return false;
	}
	return true
}
</script>
<form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
<h1>Forgot Password?</h1>

	<div id="success_message"><!-- <?php  $success_message; ?> --></div>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>
	
	<div class="field-group">
		<div><label for="email">Email</label></div>
		<div><input type="text" name="user-email" id="user-email" class="input-field"></div>
	</div>
	
	<div class="field-group">
		<div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="form-submit-button"></div>
	</div>	
</form>