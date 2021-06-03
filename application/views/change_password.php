<div class="col-md-12">
<div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
				  <li class="active"><a href="<?php echo base_url();?>clinic/changepwd">Change Password</a></li>					  
                 </ul>
				</div>
				<div class="box-header with-border">
                  <h5 class="box-title">Change Password</h5>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
          <form action="<?php echo base_url();?>clinic/changePwd" method="post">
                   <div id="">       
					 <label> Old Password: *</label> 
                     <input class="form-control" name="oldpwd" id="" style="width:100%;" value="" placeholder="Old Password" type="password" required>
					 <input class="form-control" name="username"  value="<?php echo $_SESSION['username'] ;?>" type="hidden">
				   </div>
				   <div id="">
                     		<div class="form-group">
			           <label>New Password:</label>
			           <input type="password" id="password" name="newpwd" placeholder="New Password" class="form-control" data-toggle="password" required>
		                </div>
				   </div>
<script type="text/javascript">
	$("#password").password('toggle');
</script>
				   <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
				   <button type="submit" name="update_pwd" class="btn btn-primary"><i class="add" style="margin-top:4px;"></i>Change Password</button>
                  </div>
				  </form>
</div>
<div class="col-md-4">
</div>
</div>
	