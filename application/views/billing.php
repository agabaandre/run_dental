<script>
//$.fn.datepicker.defaults.format = "yyyy/mm/dd";
// $('.datepicker').datepicker({
// });

</script>	

<div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             <li class="active"><a href="#">Billing</a></li>
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
					   <th style="width:15%;">Time</th>
                        <th style="width:10%;">Start Date</th>
									
                        <th style="width:20%;">Doctor</th>
						<th style="width:20%;">Bill Status</th>
						<th style="width:20%;">Bill</th> <?php ?>
                      </tr>
                    </thead>
<tbody>       
<?php 
  $this->load->model("Request", "requestHandler");
	$c=1;

	
	
	
	
    foreach($appointments as $row) {

		
    ?>
	  <tr>  <td><?php echo $row->patient_id;?></td>
	      
	  		<td><?php echo $patient=$row->patient;?></td>
              <td><?php echo $mobile=$row->mobile;?></td>
			  <td><?php echo $row->time;?></td>
            <td><?php $id=$row->id; $requestid=$row->request_id; ?><?php echo $row->start_date;?></td>
			<td><?php echo $row->doctor;?></td>
			<td> <?php $bill=$this->requestHandler->get_billstatus($row->id); if(!empty($bill[0]->amount)){ echo "UGX ".$bill[0]->amount;} else{ echo '<p style="color:red;">No Bill Yet</p>'; }?></td>
			
	        
			<td> 

			<div class="dropdown show">
			<a class="btn btn-sm btn-default dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Bill Options
			</a>

			<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<li><a href="" data-toggle="modal" data-target="#<?php echo $modalid='my'.$id;?>" title="Set Appointment Time"><i class="fa fa-money-bill"></i>Post Bill</a></li>
				<li><a href="<?php echo base_url();?>Clinic/print_thermal/<?php echo $id;?>" target="_blank" title="Thermal Bill"><i class="fa fa-print"></i>Thermal Bill</a></li>
				
				<li><a href="<?php echo base_url();?>Clinic/print_bill/<?php echo $id;?>" target="_blank" title="Print Bill"><i class="fa fa-print"></i>Print Bill</a></li>
				
			</div>
			</div>
		
			<!--modal Update -->
			<div class="col-md-12 offset-2">
					<div class="modal model-md fade" id="<?php echo $modalid;?>" tabindex="-1" role="dialog" data-backdrop="static">
													<div class="modal-dialog  modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header">
															<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
															<h4 class="modal-title" style="text-align:center;"><i class=""></i>Bill <?php echo " ". $patient; ?></h4>
														</div>
														<div class="modal-body">
                <button  class="btn btn-primary add_bill"  ><span class="glyphicon glyphicon-plus"></span>New Bill Item</button>
				<form name="" id="data_form" method="post" action="<?php echo base_url();?>clinic/billing">
				<div class="form-group" style="margin-left:12px;">
				
					<label for="" style="width:100%;">Post Date</label>
					  <div class='input-group date datepicker'>
					  <input type='text' autocomplete="off" name="posting_date" id="auto" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width:100%;" readonly>
					  <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
				</span>
				</div>
				</div>
				<div class="form-group">

				    <input type="hidden" name="appointment_id" value="<?php echo $id; ?>">
					<input type="hidden" name="patient_id" value="<?php echo $row->patient_id;?>">
					<div class="col-md-6">Description</div><div class="col-md-2">Qty</div><div class="col-md-4">Amount</div>
                    <div class="col-md-6"><input type="text" class="form-control selectProd" name="description[]"   style="width:100%;" required></div>
					<div class="col-md-2"><input type="number" class="form-control bills qnty" name="qty[]"  autocomplete="off" style="width:100%;" required></div>
					<div class="col-md-4"><input type="number" class="form-control bills rowTotal" name="bill[]"  autocomplete="off" style="width:100%;" required></div>'
				<p class="bill_item"></p>
			
               
			    <div style="margin-left:12px; font-weight:bold; font-size:16px;">UGX: <span class="result" ></span></div>
				</div>
				<label for="" style="width:100%; color:red; margin:3px;" class="btn btn-default">Is Paid
				<input type="checkbox"   value="1" name="bill_status"  tyle="position: absolute; opacity: 0;"> </label>
				     
                <div class="modal-footer">

				
			       <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit" ><span class="glyphicon glyphicon-plus"></span>Save</button>
					 <button class="btn btn-danger"  type="reset" id="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset</button>
                     
				   </div>	
                   </div>
				   </form>  
				
				</div>
                </div>
                </div>
			 </div>
				</div>
				
		 
			

          <!---end Chat-->

			
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



