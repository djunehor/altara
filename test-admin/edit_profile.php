<?php
require '../includes/config.php';
require '../includes/functions.php';
//authenticate to ensure admin is logged in
require 'auth.php';
//first select user details to create undo action
$array=array("username","email","password","userID");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}
$username = filter_var($username, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);
$userID = filter_var($userID, FILTER_SANITIZE_STRING);

$u = mysqli_query($con,"SELECT * FROM $admin_table WHERE adminID='$userID'");
if(!is_numeric($userID) || mysqli_num_rows($u)!=1) {
	die("adminID not valid");
}
if(!empty($password) && strlen($password)<5)  {
die("Password canot be less than 5 characters!");	
}
elseif(strlen($password)>=5)
{
	$pwd = md5($password);
$query = "UPDATE $admin_table SET username='$username',email='$email',password='$pwd' WHERE adminID='$userID'";
} else {
	$query = "UPDATE $admin_table SET username='$username',email='$email' WHERE adminID='$userID'";
}
$edit = mysqli_query($con,$query);

//undo action
$u = mysqli_fetch_assoc($u);
$userID = $u['adminID'];
$username = $u['username'];
$email = $u['email'];
$password = $u['password'];
if(strlen($password)>=5) {
$pwd = md5($password);
$_SESSION['query'] = "UPDATE $admin_table SET username='$username',email='$email',password='$pwd' WHERE adminID='$userID'";
} else {
	$_SESSION['query'] = "UPDATE $admin_table SET username='$username',email='$email' WHERE adminID='$userID'";
}
$_SESSION['aid'] = $userID;
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
if($edit) {
echo 'User has been updated.';
echo '<script>document.getElementById("username'.$userID.'").value = "'.$username.'";</script>';	
echo '<script>document.getElementById("email'.$userID.'").value = "'.$email.'";</script>';	
$detail = $_SESSION['adminName']." updated profile.";
			ActivityLog($con,$detail,$_SESSION['adminID']);
} else {
echo "Edit Failed!";	
}
?>