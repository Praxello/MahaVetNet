<?php
session_start();
if(isset($_SESSION['branchId']) && isset($_SESSION['userId'])){
    unset($_SESSION['branchId']);
    unset($_SESSION['userId']);
}
session_destroy();
header('Location:index.php');
?>
