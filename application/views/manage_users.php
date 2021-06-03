<div class="col-md-12" style=" background:white; border-radius: 5px;">
    <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
			      <li class="active"><a href="<?php echo base_url();?>clinic/Users">Manage Users</a></li>
			      <li class=""><a href="<?php echo base_url();?>clinic/userLogs">User Logs</a></li>
                 </ul>
				</div>
                <div class="box-header with-border">
                  <h5 class="box-title">Manage Users</h5>
                </div>
</div>
									
 <hr style="border:1px solid rgb(140, 141, 137);"/>

  <div class="col-md-4">
      <p>Add Users</p>
	          <form method="post" action="<?php echo base_url();?>clinic/users" autocomplte="off">
	  	             <div id="">
					<label>Username: *</label>
                      <input class="form-control" name="username" id="title" value="" placeholder="Username" type="text" required>
				   </div>
                   <div id="">
					 <label>Default Password your account is  <b>login</b></label> 
                      <input class="form-control" name="password" id="" value="d56b699830e77ba53855679cb1d252da" placeholder="Password" type="hidden" required>
					</div>
					<div id="">
					  <label>User Type: *</label>
                      <select class="form-control" name="usertype" id="type" style="width:100%;">
					  <?php
                      $users = array("Administrator"=>"admin", "Supervisor"=>"hr", "Data Manager"=>"data", "Staff"=>"staff", "No Access Granted"=>"access_0");
                      foreach($users as $key => $value) {
                     echo"<option value='$value'>".$key."</option>";
                            }
                       ?> 
					  </select>
				   </div>
				   <div id="">
					  <label>Name: *</label>
                      <input type="text" class="form-control" name="name" id="" value="" placeholder="Name" type="text" required>
				   </div>
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit" ><span class="add"></span>Add User</button>
                     </form>
				   </div>
   </div>
<div class="col-md-8" style="overflow:auto;"> 
<div id="CollapsiblePanel1" class="CollapsiblePanel" style="margin:0 auto; overflow:auto;">
								
<div class="CollapsiblePanelTab" tabindex="0"><p>View System Users</p></div>
<div class="CollapsiblePanelContent"> 
      <table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">No</th>
					   <th style="width:22%;">Username</th>
                        <th style="width:10%;">User Type</th>
						<th style="width:20%;">Name</th>							
						<th style="width:10%;">status</th>							
						<th style="width:15%;">Edit</th>
						<th style="width:15%;">Reset Password</th>
                      </tr>
                    </thead>
<tbody>       
<?php
   // print_r($usersdata);
    $i=1;
    foreach($userdata as $row) {
    ?>
      <tr>  <td><?php echo $i++;?></td>
            <td><?php $uuid=$row->uuid;?><?php echo $row->username;?></td>
			<td><?php echo  $active_op=$row->usertype;?></td>
			<td><?php echo $name=$row->name;?></td>
	    <td>
	<?php
                       //Flag Raiser
					  $status=$row->status;
				   $space="----|";
					  if ($status==0){ ?>
						  <form action='<?php echo base_url();?>clinic/updateuser' method='post'>
						  <input type='hidden' value="1" name='status'>
						  <input type='hidden' value='<?php echo $uuid; ?> ' name='uuid'>
						 <button type='submit'  class='btn btn-sm btn-danger' ><span class='glyphicon glyphicon-circle-remove'></span>Not Active</button>
						        </form>
					<?php  } 
					  else { ?>
						<form action='<?php echo base_url();?>clinic/updateUser' method='post'>
						  <input type='hidden' value="0" name='status'>
						  <input type='hidden' value='<?php echo $uuid; ?>' name='uuid'>
						 <button type='submit'  class='btn btn-sm btn-success' ><span class='glyphicon glyphicon-ok'></span>Active</button>
						 </form> 
					<?php  }
					  
					  ?>
		</td>
	<td>
    <button data-toggle="modal" data-target="#<?php echo $modalid='my'.$uuid;?>" title="Update User" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>
	<div class="col-md-12 offset-2">
	<div class="modal fade" id="<?php echo $modalid;?>" tabindex="-1" role="dialog" data-backdrop="static">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                              <h4 class="modal-title"><center><i class=""></i>Edit User Details</center></h4>
                                          </div>
                                          <div class="modal-body">
	            <form method="post" action="<?php echo base_url();?>clinic/updateUser">
	  	           <div id="">
					<label>Username: *</label>
                      <input class="form-control" name="username" id="title" value="<?php echo $row->username;?>" placeholder="Surname" type="text" style="width:100%;" readonly>
				  </div>
                  <div id="">
                    	<input class="form-control" name="uuid"  value="<?php echo $uuid;?>" placeholder="" type="hidden">
				   </div>
				   <div id="">
					  <label>User Type: *</label>
                      <select class="form-control" name="usertype" id="type" style="width:100%;">
					  <?php
                      $users = array("Administrator"=>"admin", "Supervisor"=>"hr", "Staff"=>"staff", "Data Manager"=>"data", "No Access Granted"=>"access_0");
                      foreach($users as $key => $value) {
						  $selected="selected";?>
                    <option value="<?php echo $select_op=$value; ?>"<?php if ($select_op==$active_op){echo "selected";}?>><?php  echo $key; ?>
                        <?php   }
                       ?> 
					  </select>
				   </div>
				    <div id="">
					  <label>Name:</label>
                      <input class="form-control" style="width:100%;" name="name" id="" value="<?php echo $row->name;?>" placeholder="" type="text">
				   </div>
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary"  type="submit" ><span class="add"></span>Update User</button>
                   </form>
				   </div>
                                         </div>
                                      </div>
                                    </div>
			 </div>
			
			 </td>
			 <td>
			 <form action="<?php echo base_url();?>clinic/updateUser" method="post">
			 <input class="form-control" name="uuid"  value="<?php echo $uuid;?>" placeholder="" type="hidden">
	         <input class="form-control" name="password"  value="login" placeholder="" type="hidden">
			 <button  class="btn btn-primary"  type="submit" ><span class=""></span>Reset</button>
             </form>
			</td>

			 </tr>
    <?php	
    }
    ?>
	 </tbody>
        <tfoot>
      </tfoot>
    </table>
	</div>
</div>
</div>

	