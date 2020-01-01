<?php
$serverName = 'localhost';
$username   = 'root';
$password   = '';
$databaseName = 'mahavetnet_indexing';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>
