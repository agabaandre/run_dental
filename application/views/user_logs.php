<div class="col-md-12" style=" background:white; border-radius: 5px;">

          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
             <li class=""><a href="<?php echo base_url();?>clinic/Users">Manage Users</a></li>
			      <li class="active"><a href="<?php echo base_url();?>clinic/userLogs">User Logs</a></li>
            </ul>
				</div>
                <div class="box-header with-border">
                  <h5 class="box-title">Manage User Logs</h5>
                </div>
</div>
<div class="col-md-12" style="overflow:auto;"> 
<div id="CollapsiblePanel1" class="CollapsiblePanel" style="margin:0  overflow:auto;">
  <div class="CollapsiblePanelTab" tabindex="0"><p>View System Logs</p></div>
<div class="CollapsiblePanelContent"> 
<form method="post" action="<?php echo base_url();?>clinic/userlogs" autocomplte="off">
  <button type="submit" class="btn btn-danger" value="Clear Logs" name="clearlogs">Clear Logs</button>
</form>
    <table id="mydata" class="table table-bordered table-responsive">
      
      <thead>
        <tr>
          <th style="width:2%;">#</th>
          <th style="width:2%;">User</th>
          <th style="width:2%;">Api Key</th>
          <th style="width:78%;">Actions</th>
          <th style="width:20%;">Time and Date</th>
        </tr>
      </thead>
<tbody>       
  <?php 
  $i=1;
  foreach($userslogs as $row){
    ?>
      <tr> 
        <td><?php echo $i++; ?></td>
        <td><?php echo $row->uid;?></td>
        <td><?php echo $row->apikey;?></td>
        <td><?php echo $row->action;?></td>
        <td><?php echo $row->eventdate;?></td>
	  </tr>
    <?php }
	?>
	 </tbody>
        <tfoot>
      </tfoot>
    </table>
	</div>
</div>
</div>
	