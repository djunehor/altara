<?php
require '../includes/config.php';
require '../includes/functions.php';
//authenticate to ensure admin is logged in
require 'auth.php';
@$aid= $_REQUEST['pid'];
if(!is_numeric($aid)) {
	die("ActivityID not valid");
}
//first select user details to create undo action
$delete = mysqli_query($con,"DELETE FROM $activity_table WHERE aid='$aid'");
if($delete) {
echo 'Activity has been deleted.';
echo "<script>$('.$aid').hide();</script>";
$detail = $_SESSION['adminName']." deleted activity ".$aid.".";
			ActivityLog($con,$detail,$_SESSION['adminID']);	
} else {
echo "Delete Failed!";	
}
?>