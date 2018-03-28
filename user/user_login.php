<?php
//ensure no server sde errors are outputted for user
require '../includes/config.php';
require '../includes/functions.php';

//get variables from $REQUEST superglobal
$array=array("username","password","crsf","remember");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}

//set variables names
$username = filter_var($username, FILTER_SANITIZE_STRING);
$pasword = filter_var($password, FILTER_SANITIZE_STRING);
$crsf = filter_var($crsf, FILTER_SANITIZE_STRING);
$remember_me = filter_var($remember, FILTER_SANITIZE_STRING);
$pword = md5($pasword); //hash password

session_start();
//first check if CRSF_KEY is valid
if($crsf!=$_SESSION['crsf_key']) {
die('Invalid Form submission. Please <a href="userLogin">reload</a> the page'); 	
}elseif(strtoupper($_POST['captcha'])!=$_SESSION["vercode"])
{
die('Error: Invalid CAPTCHA!'); 	
}
if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM $user_table WHERE username='$username' AND password='$pword'"))==1) {
			$login = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM $user_table WHERE username='$username' AND password='$pword'"));
			unset($_SESSION["vercode"]);
			session_regenerate_id(true);
			$_SESSION['userID'] = $login['userID'];
			$_SESSION['userName'] = $login['username'];
			$_SESSION['userEmail'] = $login['email'];
			$_SESSION['userLast'] = $login['lastLogin'];
			
			if($remember_me==1) {
				//get strong 64 characters string as unique identifier, save cookie in user browser and save copy in user row;
				$sessionid = bin2hex(openssl_random_pseudo_bytes(32));
				setcookie("remember_me", $sessionid, time() + (86400*30));	
			}
			$last_login = time();
			//update user last login
			$update_login = mysqli_query($con,"UPDATE $user_table SET lastLogin='$last_login',remember='$sessionid' where userID='".$_SESSION['userID']."'");
			
			//check if user was redirected from a protected page
			$url = isset($_SESSION['redirect'])?$_SESSION['redirect']: 'index';
			//add activity to user activity log
			$detail = "New Login from <b>".$_SERVER['HTTP_USER_AGENT']."</b>. Redirected to http://".$_SERVER['SERVER_NAME']."/".$url;
			ActivityLog($con,$detail,$_SESSION['userID']);
			//delete redirect variable
			unset($_SESSION['redirect']);
			//output to user. Redirect to appropriate page
			$result = 'Login Successful. Redirecting in 5 seconds. <script>window.setTimeout(function(){ window.location = "'.$url.'"; },5000)</script>';
			$result .= "<script>$('#btnSubmit').attr('disabled','disabled');</script>";
} else {
	//email and password not valid
	$_SESSION['failed']++;
	$error = "Invalid email or password! Login attempt ".$_SESSION['failed']."/3";	
		if($_SESSION['failed']>=3) {
		//failed login is upto three times in a session
		setcookie("login_disable", "LOGIN DISABLED TRY AGAIN IN ".date('M j Y, g:i a',time() + (60*15)), time() + (60*15));	
		$error .= " Login has been disabled! Try again in 15 minutes.";	
		$error .= "<script>$('#btnSubmit').attr('disabled','disabled');</script>";
			}
		}
	if(isset($error)) {
		//renew CRSF_KEY for new form submission
		$_SESSION['crsf_key'] = md5(time());
		echo "Error: ".$error;
		echo '<script>document.getElementById("crsf").value = "'.$_SESSION['crsf_key'].'";</script>';
		} elseif(isset($result)) {
			echo $result;
			}
?>