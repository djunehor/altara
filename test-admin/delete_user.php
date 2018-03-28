<?php
require '../includes/config.php';
require '../includes/functions.php';
//authenticate to ensure admin is logged in
require 'auth.php';
@$user_id= $_REQUEST['pid'];
if(!is_numeric($user_id)) {
	die("UserID not valid");
}
//first select user details to create undo action
$u = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM $user_table WHERE userID='$user_id'"));
$userID = $u['userID'];
$username = $u['username'];
$email = $u['email'];
$password = $u['password'];
$lastLogin = $u['lastLogin'];
$_SESSION['query'] = "INSERT INTO $user_table(userID,username,email,password,lastLogin) VALUES('$userID','$username','$email','$password','$lastLogin')";
$_SESSION['aid'] = $userID;
$delete = mysqli_query($con,"DELETE FROM $user_table WHERE userID='$user_id'");
if($delete) {
echo 'User has been deleted. <button onclick="undo_con()" href="undoAction">Undo</button>';
echo "<script>$('.$user_id').hide();</script>";	
$detail = $_SESSION['adminName']." deleted user <b>".$username."</b>.";
			ActivityLog($con,$detail,$_SESSION['adminID']);
} else {
echo "Delete Failed!";	
}
?>