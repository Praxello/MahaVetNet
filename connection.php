<?php
$serverName = 'localhost';
$username   = 'mvn';
$password   = '';
$databaseName = 'mahavetnet_indexing';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>
