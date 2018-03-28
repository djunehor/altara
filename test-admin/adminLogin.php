<?php
	//Start session
	session_start();	
	//Unset the variables stored in session
	unset($_SESSION['adminID']);
	unset($_SESSION['adminName']);
	unset($_SESSION['adminLast']);
	unset($_SESSION['failed']);	
	unset($_SESSION['vercode']);
	$_SESSION['crsf_key'] = md5(time());
?>
<html>
<head>
<title>
Admin Login - Bolaji
 Zacchaeus
</title>
    <link rel="shortcut icon" href="main/ico/apple-touch-icon-72-precomposed.png">

  <link href="../main/css/bootstrap.css" rel="stylesheet">
 
  <link rel="stylesheet" href="../main/css/font-awesome.min.css">
   <script src="jquery.js"></script>
  <script language="javascript">
$(document).ready(function(){

$(".refresh").click(function () {
    $(".imgcaptcha").attr("src","admin_captcha?_="+((new Date()).getTime()));
    
});
});

</script>

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-fluid">
      <div class="row-fluid">
		<div class="span4">
		</div>
	
</div>
<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 15px #000; color:#fff;"><center>ADMIN LOGIN</center></font>
		<br>
<div id="login">
<form id="admin_login_form" role="form" class="samuel">
<?php
if(!empty($_COOKIE['login_disable'])) {
	echo '<div class="alert alert-danger error">'.$_COOKIE['login_disable'].'</div>';
}
else {
	?>			
<div class="input-prepend">
		<span style="height:30px; width:25px;" class="add-on"><i class="icon-user icon-2x"></i></span><input style="height:40px;" type="text" name="username" id="username" placeholder="Enter your username" required><br>
</div>
<div class="input-prepend">
	<span style="height:30px; width:25px;" class="add-on"><i class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;" name="password" id="password" placeholder="Enter your password" required><br>
		</div>
		<div class="input-prepend">
		<img src="admin_captcha" class="imgcaptcha" alt="captcha"  />
					<img src="../main/images/refresh.png" alt="reload" title="reload" class="refresh" />
					<br>
					<span style="height:30px; width:25px;" class="add-on"><i class="icon-file icon-2x"></i></span><input type="text" placeholder="Enter Captcha" style="height:40px;" name="captcha">
						</div>
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
	$("#admin_login_form").on('submit',(function(e) {
		e.preventDefault();
		$('.loading').show();
		$('.success').hide();
		$('.error').hide();
		$('#finish').attr('disabled','disabled');
		$.ajax({
			url: "admin_login",
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