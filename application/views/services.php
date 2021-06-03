<div class="col-md-12" style=" background:white; border-radius: 5px;">
<?php	$i=1;
	//print_r($facilitydata);
?>      <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
			      <li class="active"><a href="<?php echo base_url();?>Clinic/services">Manage Services</a></li>
			    
                 </ul>
				</div>
                <div class="box-header with-border">
                  <h5 class="box-title">Services</h5>
                </div>
</div>
									
 <hr style="border:1px solid rgb(140, 141, 137);"/>

 									<?php 
									if(isset($data['msg'])){
                                      echo'<div id="alert" class="alert alert-success alert-dismissable">
                                      <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong>'.$data['msg'].'</strong>
                                      </div>';
                                    }  ?>
  <div class="col-md-4">
      <p>Add Services</p>
	          <form method="post" action="<?php echo base_url();?>Clinic/services" autocomplte="off">
	  	             <div id="">
					<label>Name: *</label>
                      <input class="form-control" name="name" id="title" value="" placeholder="Name" type="text" required autocomplete="off" required>
				   </div>
                   <div id="">
                     <label>Image URL</label> 
                     <input class="form-control" name="add"  value="add" placeholder="" type="hidden">
                      <input class="form-control" name="img_url" id="" value="" placeholder="http:google.com/images/" type="text" autocomplete="off">
					</div>
				   <div id="">
					  <label>Description: *</label>
                      <input type="text" class="form-control" name="description" id="" value="" placeholder="Description" type="text" max-length="200" required>
				   </div>
           <label>Price: *</label>
           <input type="number" class="form-control" name="price" id="" value="" placeholder="Price" max-length="200" required>
           <label>Type: *</label>
           <select class="form-control" name="type" id="type" style="width:100%;">
					                      <option value="services">Services                                            </option><option value="product">Product                         
					  </option></select>
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit" ><span class="add"></span>Save</button>
                     </form>
				   </div>
   </div>
<div class="col-md-8"> 
<div id="CollapsiblePanel1" class="CollapsiblePanel" style="margin:0 auto; overflow-x:hidden; overflow-y:auto;">
								
<div class="CollapsiblePanelTab" tabindex="0"><p>Services</p></div>
<div class="CollapsiblePanelContent"> 
      <table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">No</th>
					   <th style="width:10%;">Name</th>
                        <th style="width:20%;">Image</th>
						<th style="width:50%;">Description</th>			
            <th style="width:50%;">Price</th>			
            <th style="width:50%;">Type</th>												
            <th style="width:10%;">Edit</th>
            <th style="width:10%;">Delete</th>
                      </tr>
                    </thead>
<tbody>       
<?php
    foreach($services as $row) {
    ?>
      <tr>  <td><?php echo $i++;?></td>
      <td><?php $id=$row->id;?><?php echo $row->name;?></td>
			<td><img src="<?php echo $row->img_url;?>" width=80 heigh=80></td>
			<td><?php echo $facility=$row->description;?></td>
      <td><?php echo $facility=$row->price;?></td>
      <td><?php echo $facility=$row->type;?></td>
	        <td>
                <button data-toggle="modal" data-target="#<?php echo $modalid='my'.$id;?>" title="Update User" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>
                <div class="col-md-12 offset-2">
                <div class="modal fade" id="<?php echo $modalid;?>" tabindex="-1" role="dialog" data-backdrop="static">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                              <h4 class="modal-title"><center><i class=""></i>Edit Services</center></h4>
                                          </div>
                                          <div class="modal-body">
	            <form method="post" action="<?php echo base_url();?>clinic/services">
	  	           <div id="">
					<label>Name: *</label>
                      <input class="form-control" name="name" id="title" value="<?php echo $row->name;?>" placeholder="Name" type="text" style="width:100%;" readonly>
				  </div>
                  <div id="">
					<label> Image URL<br/>
                     </label> 
                     <input class="form-control" name="update"  value="update" placeholder="" type="hidden">
                     <input class="form-control" name="img_url" id="" style="width:100%;" value="<?php echo $row->img_url;?>" type="text" autocomplete="off">
					 <input class="form-control" name="sid"  value="<?php echo $row->id?>"  type="hidden">
				   </div>
				   
				    <div id="">
					  <label>Description:</label>
                      <input class="form-control" style="width:100%;" name="description"  value="<?php echo $row->description;?>" max-length="200" type="text" autocomplete="off">
				   </div>
           <label>Price:</label>
                      <input class="form-control" style="width:100%;" name="price"  value="<?php echo $row->price;?>" max-length="200" type="text" autocomplete="off">
				   </div>
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit"  ><span class="update"></span>Update</button>
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
             <form method="post" action="<?php echo base_url();?>clinic/services">
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
	