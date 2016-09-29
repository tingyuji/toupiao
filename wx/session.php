<?php
$fee = isset($_POST['fee']) ? intval($_POST['fee']) : 0;  

session_start();
$_SESSION['fee']=$fee;

?>