<?php
//ensure no server sde errors are outputted for user
require '../includes/config.php'; //datebase connection
require '../includes/functions.php'; //needed functions

//get variables from $_REQUEST superglobal
$array=array("username","password","crsf");
foreach($_REQUEST as $key=>$value){
	if(in_array($key,$array)){
		$$key=addslashes($value);
	}
}

//set variables names and filter
$username = filter_var($username, FILTER_SANITIZE_STRING);
$pasword = filter_var($password, FILTER_SANITIZE_STRING);
$crsf = filter_var($crsf, FILTER_SANITIZE_STRING);
$pword = md5($pasword); //hash password

session_start();
//first check if CRSF_KEY is valid, then check if captcha is correct
if($crsf!=$_SESSION['crsf_key']) {
die('Error: Invalid Form submission. Please <a href="adminLogin">reload</a> the page'); 	
} elseif(strtoupper($_POST['captcha'])!=$_SESSION["vercode"])
{
die('Error: Invalid CAPTCHA!'); 	
}
if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM $admin_table WHERE username='$username'"))==1) {
		if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM $admin_table WHERE username='$username' AND password='$pword'"))==1) {
			$login = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM $admin_table WHERE username='$username' AND password='$pword'"));
			if($login['logindisable']==1) {
				die("Error: Login has been dsiabled for this account. Check your registered email to enable login!");
			}
			unset($_SESSION["vercode"]);
			session_regenerate_id(true);
	
			$_SESSION['adminID'] = $login['adminID'];
			$_SESSION['adminName'] = $login['adminName'];
			$_SESSION['adminLast'] = $login['lastLogin'];
			$last_login = time();
			$update_login = mysqli_query($con,"UPDATE $admin_table SET lastLogin='$last_login' where adminID='".$_SESSION['adminID']."'");
			$url = isset($_SESSION['redirect'])?$_SESSION['redirect']: 'index';
			$detail = "New Login from <b>".$_SERVER['HTTP_USER_AGENT']."</b>. Redirected to http://".$_SERVER['SERVER_NAME']."/".$url;
			ActivityLog($con,$detail,$_SESSION['adminID']);
			unset($_SESSION['redirect']);
			$result = 'Login Successful. Redirecting in 5 seconds. <script>window.setTimeout(function(){ window.location = "'.$url.'"; },5000)</script>';
			$result .= "<script>$('#btnSubmit').attr('disabled','disabled');</script>";
			} else {
					//email is correct but password is wrong		
				$_SESSION['failed']++;
				$error = "Invalid email or password! Login attempt ".$_SESSION['failed']."/3";
				if($_SESSION['failed']>=3) {
						//failed login is upto three times in a session	
						//disable login for admin account
						$enable = md5(rand(0000,9999));
						mysqli_query($con,"UPDATE $admin_table set logindisable=1,enable='$enable' WHERE username='$username'");
						//disable login for 15mins for client
						setcookie("login_disable", "LOGIN DISABLED TRY AGAIN IN ".date('M j Y, g:i a',time() + (3600*15)), time() + (3600*15));
						//send notification to admin email with url to enable login
						$aselect = mysqli_fetch_assoc(mysqli_query($con,"SELECT email FROM $admin_table WHERE username='$username'"));
						
						$enable_url = 'http://'.$_SERVER['SERVER_NAME'].'/'.$admin_folder.'/enableLogin?key='.$enable;
						$message = 'A login attempt on your account was blocked by our server. Kindly review if it was you.<br><h4>CLIENT DETAILS</h4>'.$_SERVER['HTTP_USER_AGENT'].'<br><br>To enable login, kindly click <a href="'.$enable_url.'">here</a> or copy and paste the following url in your browser: '.$enable_url.'<br><br><br>The Admin Team';
						$error .= " Login has been disabled! Try again in 15 minutes.";
						$error .= "<script>$('#btnSubmit').attr('disabled','disabled');</script>";
						SendMail('noreply@'.$_SERVER['SERVER_NAME'],'Blocked Login Attempt',$aselect['email'],$message,'Djunehor','Admin');
						$detail = "Blocked login attempt from <b>".$_SERVER['HTTP_USER_AGENT']."</b>";
						ActivityLog($con,$detail,$_SESSION['adminID']);
						}
					}
} else {
	//email and password not valid
	$_SESSION['failed']++;
	$error = "Invalid email or password! Login attempt ".$_SESSION['failed']."/3";	
		if($_SESSION['failed']>=3) {
		//failed login is upto three times in a session
		setcookie("login_disable", "LOGIN DISABLED TRY AGAIN IN ".date('M j Y, g:i a',time() + (3600*15)), time() + (3600*15));	
		$error .= " Login has been disabled! Try again in 15 minutes.";	
		$error .= "<script>$('#btnSubmit').attr('disabled','disabled');</script>";
			}
		}
	if(isset($error)) {
		$_SESSION['crsf_key'] = md5(time());
		echo "Error: ".$error;
		echo '<script>document.getElementById("crsf").value = "'.$_SESSION['crsf_key'].'";</script>';
		} elseif(isset($result)) {
			echo $result;
			}
?>