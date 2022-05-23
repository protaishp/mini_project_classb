<?php
require_once 'connection_pdo.php';
session_start();
session_destroy();
header("location: index.php");
?>