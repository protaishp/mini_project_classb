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
	<title>Employee Registration | Weekly Report</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
require_once 'menu.php';
?>
<div class="head-top">
		<h2 style="right: 10px;color: #fff;text-align: center;">
			Employee Registration System
			<?php }?></h2>
	
</div>

<div style="float: left;margin-left: 23px;margin-top: 10px;">
		<button style="padding: 7px;cursor: pointer;"onclick="codespeedy()">Print</button>
		<div style="margin-left: 400px; margin-bottom: 10px;margin-top: 10px;">
			<a href="dailyReport.php"><button style="padding: 7px;cursor: pointer;">Daily Report</button></a>
			<a href="weeklyReport.php"><button style="padding: 7px;cursor: pointer;">Weekly Report</button></a>
			<a href="monthlyReport.php"><button style="padding: 7px;cursor: pointer;">Monthly Report</button></a>
			<a href="annualReport.php"><button style="padding: 7px;cursor: pointer;">Annual Report</button></a>
		</div>
</div>

<div style="float: right;margin-right: 25px;margin-top: 10px;">
		<form method="POST" action="search.php">
			<input type="text" name="txtSearch" class="search-control" placeholder="Search Here!!!!">
			<button style="padding: 7px;cursor: pointer;" type="submit" name="btnSearch">Search</button>
		</form>
</div>

<div class="table-contents" id="print">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	</style>
	<table>
		<tr>
			<th colspan="10"><h2>Weekly Report</h2></th>
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
		</tr>
		<?php
			$sql=$db->prepare("SELECT * FROM employee WHERE MONTH(dateInserted)= MONTH(now()) ORDER BY dateInserted DESC");
			$sql->execute();
			while($row= $sql->fetch()){

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
			
		</tr>
		<?php
	}
	?>
	</table>
</div>
<?php 
require_once 'footer.php';
?>
<script>
    function codespeedy(){
var print_div = document.getElementById("print");
var print_area = window.open();
print_area.document.write(print_div.innerHTML);
print_area.document.close();
print_area.focus();
print_area.print();
print_area.close();
// This is the code print a particular div element
    }

</script>
</body>
</html>