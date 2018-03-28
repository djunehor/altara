<?php
	//Start session
	session_start();	
	//Unset the variables stored in session
	unset($_SESSION['userID']);
	unset($_SESSION['userName']);
	unset($_SESSION['userRole']);
	unset($_SESSION['failed']);
	unset($_SESSION['vercode']);
	setcookie("remember_me", "", time() - 3600);	//delete remember me record
	$_SESSION['crsf_key'] = md5(time());
?>
<html>
<head>
<title>
User Login - Bolaji
 Zacchaeus
</title>
    <link rel="shortcut icon" href="main/images/pos.jpg">

  <link href="../main/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../main/css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="../main/css/font-awesome.min.css">
  <script src="jquery.js"></script>
  <script language="javascript">
$(document).ready(function(){

$(".refresh").click(function () {
    $(".imgcaptcha").attr("src","user_captcha?_="+((new Date()).getTime()));
    
});
});

</script>
    <link href="../main/css/bootstrap-responsive.css" rel="stylesheet">

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-fluid">
      <div class="row-fluid">
		<div class="span4">
		</div>
	
</div>
<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 15px #000; color:#fff;"><center>USER LOGIN</center></font>
		<br>
<div id="login">
<form id="user_login_form" role="form" class="samuel">
<?php
if(!empty($_COOKIE['login_disable'])) {
	echo '<div class="alert alert-danger error">'.$_COOKIE['login_disable'].'</div>';
}
else {
	?>			
<div class="input-prepend">
		<span style="height:20px; width:25px;" class="add-on"><i class="icon-user icon-2x"></i></span><input style="height:30px;" type="text" name="username" id="username" placeholder="Enter your username" required><br>
</div>
<div class="input-prepend">
	<span style="height:20px; width:25px;" class="add-on"><i class="icon-lock icon-2x"></i></span><input type="password" style="height:30px;" name="password" id="password" placeholder="Enter your password" required><br>
		</div>
		<div class="input-prepend">
		<img src="user_captcha" class="imgcaptcha" alt="Enable images to view captcha"  />
					<img src="../main/images/refresh.png" alt="reload" title="reload" class="refresh" />
					<br>
					<span style="height:20px; width:30px;" class="add-on"><i class="icon-file icon-2x"></i></span><input type="text" placeholder="Enter Captcha" style="height:30px;" name="captcha">						
						</div>
						<input style="height:30px;" type="checkbox" value="1" name="remember">Remember Me
		<div class="qwe">
		<input type="hidden" value="<?php echo $_SESSION['crsf_key']; ?>" name="crsf" id="crsf">
		 <button class="btn btn-large btn-primary btn-block pull-right"  id="btnSubmit" type="submit" ><i class="icon-signin icon-large"></i> Login</button>
</div>
<?php
}
?>
		 </form>	
</div>
<div style="display:none" class="alert alert-success success"></div>
													<div style="display:none" class="alert alert-info loading">Loading...</div>
													<div style="display:none" class="alert alert-danger error"></div>
													<div style="display:none" class="alert alert-danger error_show"></div>
</div>
</div>
</div>
<script>
$(document).ready(function (e) {
	$("#user_login_form").on('submit',(function(e) {
		e.preventDefault();
		$('.loading').show();
		$('.success').hide();
		$('.error').hide();
		$('#finish').attr('disabled','disabled');
		$.ajax({
			url: "user_login",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				$('#finish').removeAttr('disabled');
				$('.loading').hide();
				
				if(data.search("Error")!=-1){
					$('.error').show();
					$('.success').hide();
					$('.error').html(data);
				}
				else{
					$('.success').show();
					$('.error').hide();
					$('.success').html(data);
				}
			}
		});
	}));
});
	</script>
</body>
</html>