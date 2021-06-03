<div class="col-md-12" style=" background:white; border-radius: 5px;">
<?php	$i=1;
	//print_r($facilitydata);
?>      <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
			      <li class="active"><a href="<?php echo base_url();?>Clinic/clinics">Manage Clinics</a></li>
			    
                 </ul>
				</div>
                <div class="box-header with-border">
                  <h5 class="box-title">Clinics</h5>
                </div>
</div>
									
 <hr style="border:1px solid rgb(140, 141, 137);"/>
  <div class="col-md-4">
      <p>Add Clinic</p>
	          <form method="post" action="<?php echo base_url();?>Clinic/clinics" autocomplte="off">
	  	             <div id="">
					<label>Clinic: *</label>
                    <input class="form-control" name="add" id="title" value="add" placeholder="Name" type="hidden" style="width:100%;">
				   
                      <input class="form-control" name="clinic" id="title" value="" placeholder="Clinic" type="text" required autocomplete="off">
				   </div>
                   
				 
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit" ><span class="add"></span>Save</button>
                     </form>
				   </div>
   </div>
<div class="col-md-8"> 
<div id="CollapsiblePanel1" class="CollapsiblePanel" style="margin:0 auto; overflow-x:hidden; overflow-y:auto;">
								
<div class="CollapsiblePanelTab" tabindex="0"><p>Clinics</p></div>
<div class="CollapsiblePanelContent"> 
      <table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">No</th>
					   <th style="width:70%;">Clinic</th>
                       <th style="width:10%;">Edit</th>
                       <th style="width:10%;">Delete</th>
                    
                      </tr>
                    </thead>
<tbody>       
<?php
    foreach($clinics as $row) {
    ?>
      <tr>  <td><?php echo $i++;?></td>
            <td><?php $id=$row->id;?><?php echo $row->clinic;?></td>
	        <td>
                <button data-toggle="modal" data-target="#<?php echo $modalid='my'.$id;?>" title="Update User" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>
                <div class="col-md-12 offset-2">
                <div class="modal fade" id="<?php echo $modalid;?>" tabindex="-1" role="dialog" data-backdrop="static">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                              <h4 class="modal-title"><center><i class=""></i>Edit Clinic</center></h4>
                                          </div>
                                          <div class="modal-body">
	            <form method="post" action="<?php echo base_url();?>clinic/clinics">
	  	           <div id="">
					<label>Clinic: *</label>
                    <input class="form-control" name="id" id="title" value="<?php echo $row->id;?>" placeholder="Name" type="hidden" style="width:100%;">
				      
                    <input class="form-control" name="update" id="title" value="update" placeholder="Name" type="hidden" style="width:100%;">
				
                      <input class="form-control" name="clinic" id="title" value="<?php echo $row->clinic;?>" placeholder="Name" type="text" style="width:100%;">
				  </div>
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit"   ><span class="update"></span>Update</button>
                   </form>
				   </div>
                        </div>
                    </div>
                </div>
                </div>
             </td>
             <td> 
        
            <div class="text-center">

	<a href="#deleteModal" class="btn btn-sm btn-danger" data-toggle="modal">Delete</a>
</div>

<!-- Modal HTML -->
<div id="deleteModal" class="modal fade">
	<div class="modal-dialog modal-confirm modal-sm modal-center">
		<div class="modal-content">
			<div class="modal-header flex-column">						
				<h4><center>Are you sure?</center></h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p><center>This process cannot be undone</center></p>
            </div>
             <form method="post" action="<?php echo base_url();?>clinic/clinics">
             <input class="form-control" name="id"  value="<?php echo $id;?>" placeholder="" type="hidden">	
             <input class="form-control" name="delete"  value="delete" placeholder="" type="hidden">
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-danger">Delete</button>
			</div>
		</div>
	</div>
</div>   
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
</div>
	