<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>
All Users - Bolaji Zacchaeus
</title>
  
  <link rel="stylesheet" href="../main/css/font-awesome.min.css">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<div class="container-fluid">
      <div class="row-fluid">
	<div class="span10">
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:#fff;"><center><a href="index">Bolaji Zacchaeus</a></center></font>
<div id="mainmain">
<a href="editProfile"><i class="icon-group icon-2x"></i><br> Edit Profile</a>     
<a href="newUser"><i class="icon-bar-chart icon-2x"></i><br> New User</a>
<a href="adminLogin"><font color="red"><i class="icon-off icon-2x"></i></font><br> Logout (<?php echo $_SESSION['adminName']; ?>)</a> 
<div class="clearfix"></div>
 <div class="table-wrapper">
 <?php
			  require_once '../includes/config.php';				
			  require_once '../includes/functions.php';			  
$query = "select * from $user_table ORDER BY userID DESC";			  
$mmm = pagination($con,substr($_SERVER['SCRIPT_NAME'],0,-4),$query,2);
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
                  <th class="wd-15p">Actions</th>
                </tr>
              </thead>
			  <tbody>
			  <?php
while($v = mysqli_fetch_array($mmm))
		{
				
	 //select current user last activity
$r = mysqli_fetch_assoc(mysqli_query($con,"select detail,addDate from $activity_table WHERE userID='".$v['userID']."' ORDER BY aid DESC LIMIT 1"));				
$rank = $i++;
?>
                <tr class="<?php echo $v['userID']; ?>">
				<td><?php echo $v['userID']; ?></td>
				<input type="hidden" id="userID<?php echo $rank; ?>" name="userID" value="<?php echo $v['userID']; ?>">
                  <td><input type="text" name="username" id="username<?php echo $rank; ?>" value="<?php echo $v['username']; ?>" required></td>
                  <td><input type="email" name="email" id="email<?php echo $rank; ?>" value="<?php echo $v['email']; ?>" required></td>
                  <td><?php echo $v['lastLogin']>0?date('M j Y, g:i a',$v['lastLogin']): '-'; ?></td>
                  <td><?php echo isset($r['detail'])?$r['detail']."<br><i>on ".date('M j Y, g:i a',$r['addDate'])."</i>": '-'; ?></td>
				  <td><button id="btnEdit<?php echo $rank; ?>" onclick="edit_con<?php echo $rank; ?>()" class="btn btn-info">Edit</button></td>
				  <script>
function edit_con<?php echo $rank; ?>(){
	var Mame<?php echo $rank; ?> = document.getElementById("username<?php echo $rank; ?>").value;
var Mail<?php echo $rank; ?> = document.getElementById("email<?php echo $rank; ?>").value;
var MserID<?php echo $rank; ?> = document.getElementById("userID<?php echo $rank; ?>").value;
		
			$('#btnEdit<?php echo $rank; ?>').attr('disabled','disabled');
	$.post("edit_user",{username:Mame<?php echo $rank; ?>,email:Mail<?php echo $rank; ?>,userID:MserID<?php echo $rank; ?>},function(data){
		if(data.length != 0){
			$('.pname_error_show').show();
			$('.pname_error_show').html(data);
			$('#btnEdit<?php echo $rank; ?>').removeAttr('disabled');
		}else{
			$('.pname_error_show').hide();
			$('#btnEdit<?php echo $rank; ?>').removeAttr('disabled');
		}
	});
}
</script>
				  <td><button onclick="del_con(this.value)" id="btnDelete" type="submit" value="<?php echo $v['userID']; ?>" class="btn btn-info">Delete</button></td>
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
	<script>
			function del_con(value){
	$.post("delete_user",{pid:value},function(data){
		if(data.length != 0){
			$('.pname_error_show').show();
			$('.pname_error_show').html(data);
		}else{
			$('.pname_error_show').hide();
			$('#btnDelete').removeAttr('disabled');
		}
	});
}
		function undo_con(value){
	$.post("undo_action",{pid:value},function(data){
		if(data.length != 0){
			$('.pname_error_show').show();
			$('.pname_error_show').html(data);
		}else{
			$('.pname_error_show').hide();
			$('#btnEdit').removeAttr('disabled');
		}
	});
}
</script>
</body>
<?php include('footer.php'); ?>
</html>
