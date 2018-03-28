<?php
	error_reporting(0);
	//First check if session_variable exists. If not, check if cookie variable exists. If not, redirect user to login page
	session_start();
	//other authentication can be done here
	if(isset($_SESSION['userID'])) {
	//allow access
	} elseif(isset($_COOKIE['remember_me'])) {
	require_once '../includes/config.php';
	require_once '../includes/functions.php';
	$remember = $_COOKIE['remember_me'];
	$query = mysqli_query($con,"SELECT * FROM $user_table WHERE remember='$remember'");
			if(mysqli_num_rows($query)==1) {
			$login = mysqli_fetch_assoc($query);
			session_regenerate_id(true);
			$_SESSION['userID'] = $login['userID'];
			$_SESSION['userName'] = $login['username'];
			$_SESSION['userEmail'] = $login['email'];
			$_SESSION['userLast'] = $login['lastLogin'];
						
			$last_login = time();
			//update user last login
			$update_login = mysqli_query($con,"UPDATE $user_table SET lastLogin='$last_login' where userID='".$_SESSION['userID']."'");
			
			//add activity to user activity log
			$detail = "Remembered Login from <b>".$_SERVER['HTTP_USER_AGENT']."</b>. Redirected to http://".$_SERVER['SERVER_NAME']."/".$url;
			ActivityLog($con,$detail,$_SESSION['userID']);
			//Grant access to current page
	} else {
	header("location: userLogin");	
		}
	}else {
		$_SESSION['redirect'] = $_SERVER['PHP_SELF'];
		header("location: userLogin");
		exit();
	} 
?>