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
<?php
require_once 'menu.php';
}
?>
<div class="head-top">
	<h2 style="right: 10px;color: #fff;text-align: center;">
			Employee Registration System</h2>
</div>
<?php
if(isset($_POST['save'])){
require 'connection_pdo.php';
$fname= $_POST['fname'];
$lname= $_POST['lname'];
$username= $_POST['username'];
$password= $_POST['password'];

if(is_numeric($fname) OR is_numeric($lname)){
	echo '<script>
alert("Names must be a string please Fill again");
window.location="addEmployee.php";
</script>';
}else{

$sql= $db->prepare("INSERT INTO users(fname,lname,username,password) VALUES(?,?,?,?)");
$sql->bindValue(1, $fname);
$sql->bindValue(2, $lname);
$sql->bindValue(3, $username);
$sql->bindValue(4, $password);
if($sql->execute()){
echo '<script>
alert("User Added Successfully");
window.location="addUser.php";
</script>';
}
}
}
?>

<div style="margin-top: 20px;"></div>
	<div class="card-items">	
	<div class="card">
		<h3>Add User</h3><br><br>
		<form method="POST">
		<div class="card-container">
			
			<label>First Name</label>
			<input type="text" name="fname" class="form-control" placeholder="Please Enter Your First Name" required>
			
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder="Enter Username">
			<input type="submit" name="save" class="login-button" value="Save Details">
		</div>
		<div class="card-container">
			<label>Last Name</label>
			<input type="text" name="lname" class="form-control" placeholder="Please Enter Your Last Name" required>
			<label>Password</label>
			<input type="password" name="password" class="form-control" required>
			
		</div>
			
	</form>
		
</div>
</div>

<?php
require_once 'footer.php';
?>
</body>
</html>