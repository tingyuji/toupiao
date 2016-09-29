<?php
session_start();
$openid = isset($_POST['openid']) ? $_POST['openid'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$sex = isset($_POST['sex']) ? $_POST['sex'] : '';

$address = isset($_POST['address']) ? $_POST['address'] : '';
$birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';


require_once 'class/user.class.php';
$userClass=new userClass();

$userClass->update2($openid,$name,$sex,$address,$birthday);
?>