<div class="col-md-12" style=" background:white; border-radius: 5px;"> 
<div class="nav-tabs-custom"> 
    <ul class="nav nav-tabs">
				  <li class="btn btn-sm btn-default active"><a href="<?php echo base_url();?>clinic/returning_patient">Returning Patient</a></li>			  
               
				   </ul>
	</div>
<div class="col-md-12">
	<form action="" method="POST"  class="form-inline">
  	<div id="">
                 <!-- <label>Surname : <span style="color:red"></span></label> 
                <input type="text" class="form-control" name="sname" placeholder="Surname">
				 <label>First Name : <span style="color:red"></span></label> 
                <input type="text" class="form-control"name="fname" placeholder="First Name">
				 <label>Other Name : <span style="color:red"></span></label> 
                <input type="text" class="form-control" name="oname" placeholder="Other Name"> -->
			
	</div>
	
					<p></p>
  <!-- <button   type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button> -->


</form>
</div>
<div class="col-md-12">
<div class="box-header with-border">
                  <h5 class="box-title">Patients</h5>
				  <p class="danger"></p>
        </div>
<hr style="border:1px solid rgb(140, 141, 137);"/>

<div class="col-md-12">


					<table id="mydata" class="table table-hover table-responsive table-bordered" style="width:100%;">
                    <thead>
                      <tr>
					   <th>No.</th>
					   <th>Patient ID</th>
					   <th>Name</th>
					   <th>Contact</th>
                       <th>Email</th>
					   <th>Address</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach ($patients as $row) {
                      ?>
                
					 <tr>
					    <td><?php echo $i++; ?></td>
						<td><?php echo $row->patient_id; ?> </td>
					    <td width><a href="<?php echo base_url()?>clinic/userprofile/<?php echo  $row->patient_id;?>" target="_blank"><?php echo $row->patient; ?> </a> </td>
					    <td><?php echo $row->mobile; ?> </td>
                        <td><?php echo $row->useremail; ?> </td>
					    <td><?php echo $row->address; ?></td>
					   
					  
					   
                    </tr>
                    <?php } ?>
	
				    </tbody>
                    <tfoot>
					
					
                    </tfoot>
    </table>
   </div>
</div>
</div>

