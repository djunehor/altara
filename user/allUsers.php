<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>
All Users - Bolaji Zacchaeus
</title>
  
  <link rel="stylesheet" href="../main/css/font-awesome.min.css">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<div class="container-fluid">
      <div class="row-fluid">
	<div class="span10">
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:#fff;"><center><a href="index">Bolaji Zacchaeus</a></center></font>
<div id="mainmain">
<a href="index"><i class="icon-group icon-2x"></i><br> Home</a>     
<a href="allUsers"><i class="icon-bar-chart icon-2x"></i><br> All User</a>
<a href="userLogin"><font color="red"><i class="icon-off icon-2x"></i></font><br> Logout (<?php echo $_SESSION['userEmail']; ?>)</a> 
<div class="clearfix"></div>
 <div class="table-wrapper">
 <?php
			  require_once '../includes/config.php';				
			  require_once '../includes/functions.php';
error_reporting(E_ALL);			  
$query = "select * from $user_table ORDER BY userID DESC";			  
$mmm = pagination($con,$_SERVER['SCRIPT_NAME'],$query,2);
	?>
		   <div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
All Users <?php echo "(Page ".$page."/".$lastpage." )"; ?>
</div>
<div class="alert alert-danger pname_error_show" style="display:none"></div>
            <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
              <thead>
                <tr>
                  <th class="wd-20p">UserID</th>
                  <th class="wd-10p">Username</th>
                  <th class="wd-10p">Email</th>
                  <th class="wd-10p">LastLogin</th>
                  <th class="wd-10p">Recent Activity</th>
                </tr>
              </thead>
			  <tbody>
			  <?php
while($v = mysqli_fetch_array($mmm))
		{
				
	 //select current user last activity
$r = mysqli_fetch_assoc(mysqli_query($con,"select detail,addDate from $activity_table WHERE userID='".$v['userID']."' ORDER BY aid DESC LIMIT 1"));				
?>
                <tr class="<?php echo $v['userID']; ?>">
				<td><?php echo $v['userID']; ?></td>
                  <td><?php echo $v['username']; ?></td>
                  <td><?php echo $v['email']; ?></td>
                  <td><?php echo $v['lastLogin']>0?date('M j Y, g:i a',$v['lastLogin']): '-'; ?></td>
                  <td><?php echo isset($r['detail'])?$r['detail']."<br><i>on ".date('M j Y, g:i a',$r['addDate'])."</i>": '-'; ?></td>
				 </tr>
 <?php } ?>
				 </tbody>
            </table>
         </div>
</div>
			<?php
echo $pagination; ?>
<link href="../main/css/pagination.css" rel='stylesheet' type='text/css' />
 
</div>
</div>
</div>

</body>
<?php include('footer.php'); ?>
</html>
