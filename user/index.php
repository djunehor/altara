<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>
User Home - Bolaji Zacchaeus
</title>
 <link href="..main/css/bootstrap.css" rel="stylesheet">

    
  
  <link rel="stylesheet" href="../main/css/font-awesome.min.css">
  
    
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />

<div class="container-fluid">
      <div class="row-fluid">
	<div class="span10">
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:#fff;"><center>Bolaji Zacchaeus</center></font>
<div id="mainmain">
<a href="index"><i class="icon-group icon-2x"></i><br> Home</a>     
<a href="allUsers"><i class="icon-bar-chart icon-2x"></i><br> All Users</a>
<a href="userLogin"><font color="red"><i class="icon-off icon-2x"></i></font><br> Logout (<?php echo $_SESSION['userEmail']; ?>)</a> 
<div class="clearfix"></div>
<br><br><div style="background-color:red;color:white;">
<?php if($_SESSION['userLast']>0) {
	echo "Welcome <b>".$_SESSION['userName']."</b>, last login was ".date('M j Y, g:i a',$_SESSION['userLast']);
	} else {
echo 'Welcome <b>'.$_SESSION['userName'].'</b>, This is your first login.';
	}	?></div>
 <div class="table-wrapper">
		   <div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
Activity Log
</div>
<div class="alert alert-danger pname_error_show" style="display:none"></div>
            <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
              <thead>
                <tr>
                  <th class="wd-20p">ID</th>
                  <th class="wd-20p">Activity</th>
                  <th class="wd-10p">Time</th>
                </tr>
              </thead>
			  <tbody>
			  <?php
			  require '../includes/config.php';
			  $q = mysqli_query($con,"select * from $activity_table WHERE userID='".$_SESSION['userID']."' ORDER BY aid DESC LIMIT 5");				
			   while($v = mysqli_fetch_assoc($q))
 {
	 ?>
                <tr class="<?php echo $v['aid']; ?>">
				<td><?php echo ++$i; ?></td>
				<td><?php echo $v['detail']; ?></td>
				<input type="hidden" name="aid" value="<?php echo $v['aid']; ?>">
                  <td><?php echo date('M j Y, g:i a',$v['addDate']) ?></td>
				</tr>
 <?php } ?>
				 </tbody>
            </table>
          </div>
</div>
</div>
</div>
</div>
</body>
<?php include('footer.php'); ?>
</html>