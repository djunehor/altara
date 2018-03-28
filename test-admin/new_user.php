<?php
require '../includes/config.php';
require '../includes/functions.php';
//authenticate to ensure admin is logged in
require 'auth.php';
$array=array("username","email","password");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}
$username = filter_var($username, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);
$pwd = md5($password);

$insert = mysqli_query($con,"INSERT INTO $user_table(username,email,password) VALUES('$username','$email','$pwd')");
if($insert) {
	$select = mysqli_fetch_assoc(mysqli_query($con,"SELECT max(userID) FROM $user_table"));
	$userID = $select['id'];
	$_SESSION['query'] = "DELETE FROM $user_table WHERE userID='$userID'";
echo 'User <b>'.$username.'</b> has been created. <button onclick="undo_con()" id="btnUndo" href="undoAction">Undo</button>';
$detail = $_SESSION['adminName']." added new user <b>".$username."</b>";
			ActivityLog($con,$detail,$_SESSION['adminID']);
} else {
echo "Create Failed!";	
}
?>