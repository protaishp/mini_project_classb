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
	<title>Employee Registration | Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php require_once 'menu.php';
}
?>
<div class="head-top" style="padding: 2px;">
	<h2 style="right: 10px;color: #fff;text-align: center;">
			Employee Registration System
			</h2>
</div>


<?php
//update
require 'connection_pdo.php';
if(isset($_POST['update'])){
$id= $_POST['IDNumber'];
$fname= $_POST['fname'];
$lname= $_POST['lname'];
$email= $_POST['email'];
$gender= $_POST['gender'];
$phone= $_POST['phone'];
$address= $_POST['address'];
$position= $_POST['position'];
if(is_numeric($fname) OR is_numeric($lname)){
	echo '<script>
alert("Names must be a string please Fill again");
window.location="addEmployee.php";
</script>';
}elseif (!is_numeric($phone) OR strlen($phone)<10) {
	echo '<script>
alert("Phone number must be digit And Not less than 10 digit!!");
window.location="addEmployee.php";
</script>';
}elseif (!is_numeric($id) OR strlen($id)<16) {
	echo '<script>
alert("ID number must be digit And Not less than 16 digit!!");
window.location="addEmployee.php";
</script>';
}else{
$sql= $db->prepare("UPDATE employee SET IDNumber=?, fname=?, lname=?, gender=?, email=?, phone=?, address=?, position=? WHERE IDNumber=?");
$sql->execute(array($id,$fname,$lname,$gender,$email,$phone,$address,$position,$id));
if($sql){
	echo "<script>
	alert('Employee Updated');
	window.location= 'home.php';
	</script>";
}}
}
//update
?>

<?php

$id= $_GET['id'];
$sql=$db->prepare("SELECT * FROM employee WHERE IDNumber=?");
$sql->bindValue(1,$id);
$sql->execute();
while($row= $sql->fetch()){

?>
<div style="margin-top: 20px;"></div>
	<div class="card-items">	
	<div class="card">
		<h3>Editing Form</h3>
		<form method="POST">
		<div class="card-container">
			<!-- <label>ID Number</label> -->
			<input type="hidden" name="IDNumber" class="form-control" value="<?php echo $row['IDNumber'];?>" maxlength="16" required>
			<label>First Name</label>
			<input type="text" name="fname" class="form-control" value="<?php echo $row['fname'];?>" required>
			<label>Email</label>
			<input type="email" name="email" class="form-control" value="<?php echo $row['email'];?>" required>
			<label>Gender</label>
			<select class="form-control" name="gender" required>
				<option value="<?php echo $row['gender'];?>"><?php echo $row['gender'];?></option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
			<label>Position</label>
			<input type="text" name="position" class="form-control" value="<?php echo $row['position'];?>" required>
						
		</div>
		<div class="card-container">
			<label>Last Name</label>
			<input type="text" name="lname" class="form-control" value="<?php echo $row['lname'];?>" required>
			
			<label>Phone</label>
			<input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];?>" maxlength="10" required>
			<label>Address</label>
			<input type="text" name="address" class="form-control" value="<?php echo $row['address'];?>" required>
			<br><br>
			<input type="submit" name="update" class="login-button" value="Update Changes">
			
			
		</div>
<?php
}
?>			
	</form>
		
</div>
</div>
<div style="margin-bottom: 10px;"></div>
<?php
require_once 'footer.php';
?>
</body>
</html>