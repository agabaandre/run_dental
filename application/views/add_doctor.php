
<script>
$.fn.datepicker.defaults.format = "yyyy/mm/dd";
$('.datepicker').datepicker({
});
</script>	
<div class="col-md-12">
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
             <li class="active"><a href="<?php  echo base_url();?>clinic/addDoctor">Register Employee</a></li>
				<!-- <li class=""><a href="<?php echo base_url();?>clinic/viewDoctor">Employee List</a></li>-->
                 </ul>
		   </div>
                <div class="box-header with-border">
                  <h5 class="box-title">Register Employee</h5>
                </div>

				  <span class="notification" style="margin: 0 auto;"></span>
		    			
					<div class="col-md-12 offset-2">
					<button data-toggle="modal" data-target="#adddoctor" title="Add Doctor" class="btn btn-md btn-primary" style="margin:4px;"><i class="add"></i>Add Employee</button>
			
					<div class="modal fade" id="adddoctor" tabindex="-1" role="dialog" data-backdrop="static">
													<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
															<h4 class="modal-title"><center><i class=""></i>Add Doctor</center></h4>
														</div>
														<div class="modal-body">
														<form name="" id="data_form" method="post" action="<?php echo base_url();?>clinic/saveDoctor">
					<div id="">
                      <label>WORK ID:  <span style="color:red"></span></label> 
                      <input class="form-control" name="work_id" id="work_id" autocomplete="off" value="" type="text" placeholder="ID" style="width:100%;" >
					</div>
	
				<div id="">
					  <label>Full Name:  <span style="color:red">*</span></label>
                      <input class="form-control" name="name" id="name" value="" autocomplete="off" placeholder="Full Name"type="text" required style="width:100%;" >
				</div>
				<div id="">
                      <label>Email:  <span style="color:red"></span></label>
				      <input class="form-control" name="email" id="email" value="" autocomplete="off" placeholder="Email" type="email"/ style="width:100%;" >
			    </div>	
                   
				<div id="">
                      <label>Mobile Contact:  <span style="color:red">*</span></label>
				      <input class="form-control" name="mobile" id="mobile" value="" autocomplete="off" placeholder="Contact" type="tel" required style="width:100%;" >
			     </div>	
					
				<div id="">
                      <label>Cadre:  <span style="color:red">*</span></label>
                    <select name="cadre" class="form-control select2" id="myselect" required style="width:100%;">
						<option disabled selected>Select Cadre </option>
							<?php 
							$jobdata=array("Dental Surgeon"=>"Dental Surgeon","Public Health Dental Officer"=>"Public Health Dental Officer",
							"Oral Maxillofacial Surgeon"=>"Oral Maxillofacial Surgeon","Paediatric Dentist"=>"Paediatric Dentist",
							"Orthodontist"=>"Orthodontist","Periodontologist"=>"Periodontologist","Dental Assistant"=>"Dental Assistant");
							foreach($jobdata as $key => $value){
							  ?>
							  <option value="<?php echo $key; ?>"><?php  echo $value; ?>
							  </option>
							<?php } ?>
		           </select>
				</div>
				   <input type="hidden" value="1" name="flag">

			       <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" id="submit" type="submit" ><span class="glyphicon glyphicon-plus"></span>Save</button>
					 <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset</button>
                     </form>
				   </div>	  
				
				</div>
                </div>
                </div>
             </div>  
</div>


<div class="col-md-12"> 
<div class="box-header with-border">
                  <h5 class="box-title">Employee List</h5>
</div>


<?php
// $url = 'https://www.stmarysdentalservices.com/api_dentalapp/Api/services/21232f297a57a5a743894a0e4a801fc3';
// ;
// $ch = curl_init();
// curl_setopt ($ch, CURLOPT_URL, $url);
// //curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
// curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
// $contents = curl_exec($ch);
// if (curl_errno($ch)) {
//   echo curl_error($ch);
//   echo "\n<br />";
//   $contents = '';
// } else {
//   curl_close($ch);
// }

// if (!is_string($contents) || !strlen($contents)) {
// echo "Failed to get contents.";
// $contents = '';
// }
// $output=json_decode($contents); 
// $services=$output->requests;
// foreach ($services as $row) {
// 	print_r($row->name);
//}
?>    
      <table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">No</th>
					   <th style="width:22%;">Work ID</th>
                        <th style="width:20%;">Name</th>
						<th style="width:20%;">Cadre</th>							
						<th style="width:10%;">Telephone</th>							
						<th style="width:10%;">Email</th>
						<?php ?><th style="width:10%;">Status</th>
						<th style="width:10%;">Edit</th> <?php ?>
                      </tr>
                    </thead>
<tbody>       
<?php 
	$c=1;
    foreach($doctors as $row) {
    ?>
	  <tr>  <td><?php echo $c++; ?></td>
	  		<td><?php echo $workid=$row->work_id;?></td>
            <td><?php $id=$row->id;?><?php echo $name=$row->name;?></td>
			<td><?php echo  $active_op=$row->cadre;?></td>
			<td><?php echo $mobile=$row->mobile;?></td>
			<td><?php echo $email=$row->email;?></td>
	        <td>
	           <?php
                       //Flag Raiser
				 $status=$row->flag;
				   $space="----|";
					  if ($status==0){ ?>
						  <form action='<?php echo base_url();?>clinic/updateDoctor' method='post'>
						  <input type='hidden' value="1" name='flag'>
						  <input type='hidden' value='<?php echo $id; ?> ' name='id'>
						 <button type='submit'  class='btn btn-sm btn-danger' ><span class='glyphicon glyphicon-circle-remove'></span>Not Active</button>
						        </form>
					<?php  } 
					  else { ?>
						<form action='<?php echo base_url();?>clinic/updateDoctor' method='post'>
						  <input type='hidden' value="0" name='flag'>
						  <input type='hidden' value='<?php echo $id; ?>' name='id'>
						 <button type='submit'  class='btn btn-sm btn-success' ><span class='glyphicon glyphicon-ok'></span>Active</button>
						 </form> 
					<?php  }
					  
					  ?>
			</td>
			<td> 
					<button data-toggle="modal" data-target="#<?php echo $modalid='my'.$id;?>" title="Update User" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>
					<div class="col-md-12 offset-2">
					<div class="modal fade" id="<?php echo $modalid;?>" tabindex="-1" role="dialog" data-backdrop="static">
													<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
															<h4 class="modal-title"><center><i class=""></i>Edit</center></h4>
														</div>
														<div class="modal-body">
														<form name="" id="data_form" method="post" action="<?php echo base_url();?>clinic/updateDoctor">
					<div id="">
                      <label>WORK ID:  <span style="color:red"></span></label> 
                      <input class="form-control" name="work_id" id="work_id" value="<?php echo $workid; ?>" type="text" placeholder="ID" style="width:100%;" >
					</div>
	
				<div id="">
					  <label>Full Name:  <span style="color:red">*</span></label>
                      <input class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Full Name"type="text" required style="width:100%;" >
				</div>
				<div id="">
                      <label>Email:  <span style="color:red"></span></label>
				      <input class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email" type="email"/ style="width:100%;" >
			    </div>	
                   
				<div id="">
                      <label>Mobile Contact:  <span style="color:red">*</span></label>
					  <input type="hidden" name="id" value="<?php echo $id; ?>">
				      <input class="form-control" name="mobile" id="Contact" value="<?php echo $mobile; ?>" placeholder="Contact" type="tel" required style="width:100%;" >
			     </div>	
					
				<div id="">
                      <label>Cadre:  <span style="color:red">*</span></label>
                    <select name="cadre" class="form-control select2" id="myselect" required style="width:100%;">
						<option disabled selected>Select Cadre </option>
							<?php 
							$jobdata=array("Dental Surgeon"=>"Dental Surgeon","Public Health Dental Officer"=>"Public Health Dental Officer",
							"Oral Maxillofacial Surgeon"=>"Oral Maxillofacial Surgeon","Paediatric Dentist"=>"Paediatric Dentist",
							"Orthodontist"=>"Orthodontist","Periodontologist"=>"Periodontologist","Dental Assistant"=>"Dental Assistant");
							foreach($jobdata as $key => $value){
							   ?>
							  <option value="<?php echo $key; ?>" <?php if ($key==$active_op){ echo "selected"; }?> ><?php  echo $value; ?>
							  </option>
							<?php } ?>
		           </select>
				</div>
				   
			       <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit" ><span class="glyphicon glyphicon-plus"></span>Save</button>
					 <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset</button>
                     </form>
				   </div>	  
				
				</div>
                </div>
                </div>
             </div>

										
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

	