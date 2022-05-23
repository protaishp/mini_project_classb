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
	<title>Employee Registrations | Settings</title>

	
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php require_once 'menu.php';?>
<div class="head-top">
	<h2 style="right: 10px;color: #fff;text-align: center;">
			Employees Registration System
			<?php }?></h2>
</div>

<?php
require 'connection_pdo.php';
if(isset($_POST['update'])){
$id= $_POST['user_id'];
$fname= $_POST['fname'];
$lname= $_POST['lname'];
$username= $_POST['username'];
$password= $_POST['password'];


$sql= $db->prepare("UPDATE users SET fname=?, lname=?, username=?, password=? WHERE user_id=?");
$sql->execute(array($fname,$lname,$username,$password,$id));
if($sql){
	echo "<script>
	alert('User Updated');
	window.location= 'home.php';
	</script>";
}else{
	echo "<script>
	alert('Not Updated');
	window.location= 'home.php';
	</script>";
}
}
?>
<?php
$id= $_SESSION['user_login'];
$sql=$db->prepare("SELECT * FROM users WHERE user_id=:uid");
$sql->execute(array(':uid'=>$id));
while($row= $sql->fetch()){

?>
<div style="margin-top: 20px;"></div>
	<div class="card-items" >	
	<div class="card" style="height: 350px;">
		<h3>Update Your Account</h3>
		<form method="POST">
		<div class="card-container" style="height: auto;">
			
			<label>First Name</label>
			<input type="text" name="fname" class="form-control" value="<?php echo $row['fname'];?>" required>
			<input type="text" name="user_id" value="<?php echo $row['user_id'];?>" hidden>
			<label>User Name</label>
			<input type="text" name="username" class="form-control" value="<?php echo $row['username'];?>" required>
			<input type="submit" name="update" class="login-button" value="Update Changes">			

		</div>
		<div class="card-container" style="height: auto;">
			<label>Last Name</label>
			<input type="text" name="lname" class="form-control" value="<?php echo $row['lname'];?>" required>
			<label>Password</label>
			<input type="password" name="password" class="form-control" value="<?php echo $row['password'];?>" required>
			
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