<?php
$host = "localhost";
$db = "employee_registration";
$username = "root";
$password = "";
try{
$db= new PDO('mysql:host='.$host.';dbname='.$db,$username, $password);
}
catch(exception $ex){
die("Error : " . $ex->getMessage());
}
?>