<script>
$.fn.datepicker.defaults.format = "yyyy/mm/dd";
$('.datepicker').datepicker({
});
</script>	
<div class="col-md-12" style=" background:white; border-radius: 5px;"> 
<div class="nav-tabs-custom"> 
    <ul class="nav nav-tabs">
				  <li class="btn btn-sm btn-default"><a href="<?php echo base_url();?>clinic/reports">Back</a></li>			  
               
				   </ul>
	</div>
<div class="col-md-12">
	<form action="" method="POST"  class="form-inline">
  	<div id="">
      <p class="box-title">Choose the Date Ranges</p>
                 
               
      <label>Date From:  <span style="color:red"></span></label> 
				<div class='input-group date datepicker'>
				
					  <input type='text' autocomplete="off" name="dateFrom" id="reqdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width:100%;">
					  <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
				</div>
				<label>Date To:  <span style="color:red"></span></label> 
				<div class='input-group date datepicker'>
				
					  <input type='text' autocomplete="off" name="dateTo" id="reqdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width:100%;">
					  <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
				</div>
			
	</div>
	
					<p></p>
 <button   type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>
<p></p>

</form>
</div>
<div class="col-md-12">
<div class="box-header with-border">
                  <p><h5 class="box-title">Sales Report</h5></p>
                  
				  <p class="danger"></p>
        </div>
<hr style="border:1px solid rgb(140, 141, 137);"/>



<div id="printableArea">                            
                
					<table id="mydata" class="table table-hover table-responsive table-bordered">
                    <thead>
                      <tr>
					   <th>No.</th>
                       <th>Patient ID</th>
					   <th>Patient Name</th>
					   <th>Contact</th>
					   <th>Date</th>
                       <th>Bill Payment Status</th>
                       <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach ($sales as $row) {
                      ?>
                
					 <tr>
					    <td><?php echo $i++; ?></td>
                        <td><?php echo $row->patient_id; ?></td>
					    <td width><?php echo $row->name; ?>  </td>
					    <td><?php echo $row->mobile; ?> </td>
                        <td><?php echo $row->posting_date; ?> </td>
                        <td><?php  $status=$row->bill_status; if($status==0){ echo "Not Paid";} else{echo "Paid";} ?> </td>
					    <td><?php echo $row->totalbill; $sum += $row->totalbill; ?></td>
					   
					  
					   
                    </tr>
                    
                    <?php } ?>
                    <tr><td style="font-weight:bold;">Total</td><td></td><td></td><td></td><td></td><td></td><td style="font-weight:bold;"><?php echo "UGX ".$sum;?></td></tr>
	
				    </tbody>
                    <tfoot>
					
					
                    </tfoot>
    </table>
   </div>
</div>
</div>

