<div class="col-md-12" style=" background:white; border-radius: 5px;"> 
<div class="nav-tabs-custom"> 
    <ul class="nav nav-tabs">
				  <li class="btn btn-sm btn-default"><a href="<?php echo base_url();?>clinic/reports">Back</a></li>			  
               
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
<p></p>

</form>
</div>
<div class="col-md-12">
<div class="box-header with-border">
                  <h5 class="box-title">Outstanding Bills</h5>
				  <p class="danger"></p>
        </div>
<hr style="border:1px solid rgb(140, 141, 137);"/>



<div id="printableArea">                            
                
					<table id="mydata" class="table table-hover table-responsive table-bordered">
                    <thead>
                      <tr>
					   <th>No.</th>
					   <th>Name</th>
					   <th>Contact</th>
					   <th>Date</th>
                       <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach ($payments as $row) {
                      ?>
                
					 <tr>
					    <td><?php echo $i++; ?></td>
					    <td width><?php echo $row->name; ?>  </td>
					    <td><?php echo $row->mobile; ?> </td>
                        <td><?php echo $row->posting_date; ?> </td>
					    <td><?php echo $row->totalbill; ?></td>
					   
					  
					   
                    </tr>
                    <?php } ?>
	
				    </tbody>
                    <tfoot>
					
					
                    </tfoot>
    </table>
   </div>
</div>
</div>

