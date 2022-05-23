<nav class="nav-bar">
	<div class="brand">
		<img src="images/index.png">
		<strong><?php echo $row['fname'];?></strong>
	</div>
	<ul>
		<li><a href="home.php">Home</a></li>
		<li>Employee Mgt
			<ul style="opacity: .8;overflow: hidden;">
				<li><a href="addEmployee.php">Add Employees</a></li>
				<li><a href="home.php">View Employee</a></li>
			</ul>
		</li>
		<li><a href="reports.php">Reports</a></li>
		<li><a href="addUser.php">Add User</a></li>
		<li><a href="settings.php">Settings</a></li>

		<li><a href="logout.php">Logout</a></li>
	</ul>
</nav>