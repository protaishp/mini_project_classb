<?php
if(isset($_POST['save'])){
require 'connection_pdo.php';
$fname= $_POST['fname'];
$lname= $_POST['lname'];
$id= $_POST['IDNumber'];
$gender= $_POST['gender'];
$phone= $_POST['phone'];
$email= $_POST['email'];
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

$sql= $db->prepare("INSERT INTO employee(IDNumber,fname,lname,gender,email,phone,address,position) VALUES(?,?,?,?,?,?,?,?)");
$sql->bindValue(1, $id);
$sql->bindValue(2, $fname);
$sql->bindValue(3, $lname);
$sql->bindValue(4, $gender);
$sql->bindValue(5, $email);
$sql->bindValue(6, $phone);
$sql->bindValue(7, $address);
$sql->bindValue(8, $position);

if($sql->execute()){
echo '<script>
alert("Employee Saved Successfully");
window.location="addEmployee.php";
</script>';
}
}
}
?>