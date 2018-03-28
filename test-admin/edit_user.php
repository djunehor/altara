<?php
require '../includes/config.php';
require '../includes/functions.php';
//authenticate to ensure admin is logged in
require 'auth.php';
//first select user details to create undo action
$array=array("username","email","userID");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}
//echo "Username: ".$username."<br>Email: ".$email."<br>UserID: ".$userID;
$username = filter_var($username, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_STRING);
$userID = filter_var($userID, FILTER_SANITIZE_STRING);
if(!is_numeric($userID)) {
	die("UserID not valid");
}
$u = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM $user_table WHERE userID='$userID'"));
$edit = mysqli_query($con,"UPDATE $user_table SET username='$username',email='$email' WHERE userID='$userID'");
$userID = $u['userID'];
$username = $u['username'];
$email = $u['email'];
$password = $u['password'];
$lastLogin = $u['lastLogin'];
$_SESSION['query'] = "UPDATE $user_table SET username='$username',email='$email' WHERE userID='$userID'";
$_SESSION['aid'] = $userID;
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
if($edit) {
echo 'User has been updated. <button onclick="undo_con()" href="undoAction">Undo</button>';
echo '<script>document.getElementById("username'.$userID.'").value = "'.$username.'";</script>';	
echo '<script>document.getElementById("email'.$userID.'").value = "'.$email.'";</script>';

$detail = $_SESSION['adminName']." updated user <b>".$username."</b>.";
			ActivityLog($con,$detail,$_SESSION['adminID']);	
} else {
echo "Edit Failed!";	
}
?>