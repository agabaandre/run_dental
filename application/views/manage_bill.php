<script>
$.fn.datepicker.defaults.format = "yyyy/mm/dd";
$('.datepicker').datepicker({
});
 </script>	
<div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             <li class="active"><a href="#">Manage Bill</a></li>
			</ul>
		   </div>
		</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/wickedpicker.min.css">
<div class="col-md-12"> 
<div class="box-header with-border">
                  <h5 class="box-title">Client</h5>
</div>
      <table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">Patient No</th>
					   <th style="width:15%;">Name</th>
                       <th style="width:15%;">Patient's Contact</th>
					  
                        <th style="width:10%;">Date</th>
						<th style="width:10%;">Total Bill</th>							
                        <th style="width:10%; text-align:center;">Change Bill Status</th>
                        <th style="width:20%;">Posted By</th>
						
						<th style="width:20%; text-align:center;">Bill Options</th> <?php ?>
                      </tr>
                    </thead>
<tbody>       
<?php 
$this->load->model("Request", "requestHandler");
	$c=1;
	
	
	
    foreach($bill as $row) {
    ?>
	  <tr>  <td><?php echo $row->patient_id; ?></td>
	  		<td><?php echo $patient=$row->name;?></td>
              <td><?php echo $mobile=$row->mobile;?></td>
		
            <td><?php $id=$row->appointment_id; ?><?php echo $name=$row->posting_date;?></td>
			<td><?php echo  $row->amount;?></td>
			<td style="text-align:center;">
            <?php
                       //Flag Raiser
				 $status=$row->bill_status;
					  if ($status==0){ ?>
						  <form action='<?php echo base_url();?>clinic/manage_billing' method='post'>
					
						  <input type='hidden' value='<?php echo $id; ?> ' name='appointment_id'>
						 <button type='submit'  class='btn btn-sm btn-danger' ><span class='glyphicon glyphicon-circle-remove'></span>Not Paid</button>
						</form>
					<?php  } 
					  else { ?>
						
						 <button type='submit'  class='btn btn-sm btn-success' ><span class='glyphicon glyphicon-ok'></span>Paid</button>
					
					<?php  }
					  
					  ?>
            
            </td>
            <td><?php echo $row->posted_by;?></td>
	        
			<td style="text-align:center;"> 
			<a href="<?php echo base_url();?>Clinic/print_thermal/<?php echo $id;?>" class="btn btn-default btn-sm" target="_blank" title="Print Bill"><i class="fa fa-print"></i>Receipt</a>

            <a href="<?php echo base_url();?>Clinic/print_bill/<?php echo $id;?>" class="btn btn-default btn-sm" target="_blank" title="Print Bill"><i class="fa fa-print"></i>PDF Bill</a>
			
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



