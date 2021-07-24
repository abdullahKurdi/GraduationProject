<?php
session_start();
if(isset($_SESSION['u_id'])){
include '../../init.php';
$stmt4 = $con->prepare('UPDATE users SET Balance = Balance+10.0  WHERE UserID =  ? '); 
$stmt4->execute(array($_SESSION['u_id']));
header('Location:../../../profile.php'); // redirect to dashboard page
exit();}