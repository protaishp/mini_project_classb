<?php
require_once 'connection_pdo.php';
session_start();
if(!isset($_SESSION['user_login'])){
	header('location: index.php');
}
	$id= $_SESSION['user_login'];
	$sql=$db->prepare("SELECT * FROM users WHERE user_id=:uid");
	$sql->execute(array(':uid'=>$id));
	$row= $sql->fetch(PDO:: FETCH_ASSOC);
	if(isset($_SESSION['user_login'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Of Employee Registration | Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<?php
require_once 'menu.php';
}
?>
<div class="head-top">
	<h2 style="right: 10px;color: #fff;text-align: center;">
			Employee Registration System</h2>
</div>


<div style="margin-top: 20px;"></div>
	<div class="card-items">	
	<div class="card">
		<h3>Employee Detailed Information</h3>
		<form method="POST" action="addEmployeeDatabase.php">
		<div class="card-container">
			<label>ID Number</label>
			<input type="number" name="IDNumber" class="form-control" placeholder="Please Enter Your ID Number" pattern="d\{16}" maxlength="16" id="idNumber" required >
			<label>First Name</label>
			<input type="text" name="fname" class="form-control" placeholder="Please Enter Your First Name" required>
			<label>Last Name</label>
			<input type="text" name="lname" class="form-control" placeholder="Please Enter Your Last Name" required>
			<label>Gender</label>
			<select class="form-control" name="gender" required>
				<option selected disabled>--Select Your Gender--</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
			<!--
             <input type="radio" name="gender">male
             <input type="radio" name="gender">female
			 -->
			<input type="submit" name="save" class="login-button" value="Save Details">
		</div>
		<div class="card-container">
			<label>Email</label>
			<input type="email" name="email" class="form-control" placeholder="Please Enter Your Email" required>
			<label>Phone</label>
			<input type="text" name="phone" class="form-control" placeholder="Enter Your Phone" maxlength="10" required>
			<label>Address</label>
			<input type="text" name="address" class="form-control" placeholder="Enter Your Address" required>
			<label>Position</label>
			<input type="text" name="position" class="form-control" placeholder="Enter The Position" required>
		</div>
			
	</form>
		
</div>
</div>

<footer>
	<p>Developed by Protais & Paccy &copy; 2022</p>
</footer>
</body>
</html>