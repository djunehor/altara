<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>
New User - Bolaji Zacchaeus
</title>
 <link href="..main/css/bootstrap.css" rel="stylesheet">
  
  <link rel="stylesheet" href="../main/css/font-awesome.min.css">
  
   
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />


<div class="container-fluid">
      <div class="row-fluid">
	<div class="span10">
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:#fff;"><center><a href="index">Bolaji Zacchaeus</a></center></font>
<div id="mainmain">
<a href="index"><i class="icon-group icon-2x"></i><br> Home</a>     
<a href="allUsers"><i class="icon-bar-chart icon-2x"></i><br> All Users</a>
<a href="adminLogin"><font color="red"><i class="icon-off icon-2x"></i></font><br> Logout (<?php echo $_SESSION['adminName']; ?>)</a> 
<div class="clearfix"></div>
<center><h4><i class="icon-plus-sign icon-large"></i> Add User</h4></center>
<hr>
<div style="display:none" class="alert alert-success success"></div>
													<div style="display:none" class="alert alert-info loading">Loading...</div>
													<div style="display:none" class="alert alert-danger error"></div>
													<div style="display:none" class="alert alert-danger error_show"></div>
<div id="ac">
<form id="new_user" role="form">
<span>Userame : </span><input type="text" style="width:265px; height:30px;" name="username" required ><br>
<span>Email : </span><input type="email" style="width:265px; height:30px;" name="email" required ><br>
<span>Password : </span><input type="password" style="width:265px; height:30px;" name="password" required ><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block" type="submit" style="float:right;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<script src="jquery.js"></script>
<script>
$(document).ready(function (e) {
	$("#new_user").on('submit',(function(e) {
		e.preventDefault();
		$('.loading').show();
		$('.success').hide();
		$('.error').hide();
		$('#finish').attr('disabled','disabled');
		$.ajax({
			url: "new_user",
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
	function undo_con(value){
	$.post("undoAction",{pid:value},function(data){
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
