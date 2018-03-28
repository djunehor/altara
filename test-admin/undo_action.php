<?php
require '../includes/config.php';
//authenticate to ensure admin is logged in
require 'auth.php';
$query= $_SESSION['query'];
$aid= isset($_SESSION['aid'])?$_SESSION['aid']:'';
//run last query in session variable
$undo = mysqli_query($con,$query);
if($undo) {
echo 'Action has been undone';
unset($_SESSION['query']);
echo "<script>$('.$aid').show();</script>";
if(isset($_SESSION['username'])) {echo '<script>document.getElementById("username'.$userID.'").value = "'.$_SESSION['username'].'";</script>';}	
if(isset($_SESSION['email'])) {echo '<script>document.getElementById("email'.$userID.'").value = "'.$_SESSION['email'].'";</script>';}
} else {
echo "Undo Failed! ".mysqli_error($con);	
}
?>