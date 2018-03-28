<?php
	//Start session
	require '../includes/config.php';
	$e = filter_var($_GET['key'], FILTER_SANITIZE_STRING);
?>
<html>
<head>
<title>
Enable Login - Bolaji
 Zacchaeus
</title>
    <link rel="shortcut icon" href="main/images/apple-touch-icon-72-precomposed.png">

  <link href="../main/css/bootstrap.css" rel="stylesheet">
  
  <link rel="stylesheet" href="../main/css/font-awesome.min.css">


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
<?php
if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM $admin_table WHERE enable='$e'"))==1) {
	$enable_user = mysqli_query($con,"UPDATE $admin_table SET logindisable=0,enable=null WHERE enable='$e'");
	echo '<div class="alert alert-success success">Login has been enabled. <a href="adminLogin">Login Now</a></div>';
}
else {
	echo '<div class="alert alert-danger error">Invalid enabling key. Contact an admin!</div>';	
}
	?>			
	
</div>
</div>
</div>
</div>
</body>
</html>