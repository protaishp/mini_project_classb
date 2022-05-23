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
?>
<div class="head-top">
		<h3 style="right: 10px;color: #fff;text-align: center;"><?php echo "Welcome!!!<br> ".$row['fname'];}?></h3>
	
</div>
<?php
// require 'connection_pdo.php';
if(isset($_GET['id'])){
$sql=$db->prepare("DELETE FROM employee WHERE IDNumber=?");
$sql->bindValue(1, $_GET['id']);
if($sql->execute()){

	echo "<script>
		alert('Record Delete Successfuly!!');
		window.locaion= 'home.php';
	</script>";
}

}
?>
<div style="float: right;margin-right: 25px;margin-top: 10px;">
		<form method="POST">
			<input type="text" name="txtSearch" class="search-control" placeholder="Search Here!!!!">
			<button style="padding: 7px;cursor: pointer;" type="submit" name="btnSearch">Search</button>
		</form>
</div>
<div class="table-contents">
	
	<table>
		<tr>
			<th colspan="10"><h2>List Of Emlpoyees</h2></th>
		</tr>
		<tr>
			<th>ID Number</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Position</th>
			<th colspan="2">Action</th>
		</tr>
		<?php
		if(isset($_POST['btnSearch'])){
			$txt= $_POST['txtSearch'];
			$sql=$db->prepare("SELECT * FROM employee WHERE fname LIKE :s OR lname LIKE :l OR address LIKE :a OR position LIKE :p OR gender LIKE :g");
			$sql->execute(array(
				':s'=>'%'.$txt.'%',
				':l'=>'%'.$txt.'%',
				':a'=>'%'.$txt.'%',
				':p'=>'%'.$txt.'%',
				':g'=>$txt.'%',

			));
		
			if($row= $sql->fetch()){
			do{

		?>
		<tr>
			<td><?php echo $row['IDNumber']; ?></td>
			<td><?php echo $row['fname'];?></td>
			<td><?php echo $row['lname'];?></td>
			<td><?php echo $row['gender'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php echo $row['phone'];?></td>
			<td><?php echo $row['address'];?></td>
			<td><?php echo $row['position'];?></td>
			<td><a href="editEmployee.php?id=<?php echo $row['IDNumber'];?>"><button class="edit-button">Edit</button></a></td>
			<td><a href="?id=<?php echo $row['IDNumber'];?>"><button class="delete-button" onclick="return confirm('Are you sure Want to Delete This Record')">Delete</button></a></a></td>
		</tr>
		<?php
	}while($row= $sql->fetch());
	}
}
	else{
		echo "<tr><td colspan='10'>
		no Search Found
		</td></tr>";
	}
	?>
	</table>
</div>

<?php
require_once 'footer.php';
?>
</body>
</html>