<?php
	//Check whether the session variable SESS_MEMBER_ID is present or not
	session_start();
	//pther authentication can be done here
	if(!isset($_SESSION['adminID']) || (trim($_SESSION['adminID']) == '')) {
		$_SESSION['redirect'] = $_SERVER['PHP_SELF'];
		header("location: adminLogin");
		exit();
	}
	error_reporting(0);
?>