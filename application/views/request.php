
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
				  <li class="active"><a href="<?php echo base_url();?>clinic/newRequest">New Registration</a></li>
                  
                 </ul>
				</div>
                               
                <div class="box-header with-border">
                  <h5 class="box-title">Registration Form</h5>
                </div>	
				<div class="col-md-12">
			<?php  if(!empty($user_details)){ ?>
			 <div class="box box-info">
            	<div class="box-header with-border">
              <h3 class="box-title">New Clients App Login Info</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-borderless">
			  <thead>
			  <tr>
			  <th>Name</th>
			  <th>Username</th>
			  <th>Password</th>
			  </tr>
			  </thead>
			  <tbody>
			  <?php 
			
			 foreach ($user_details as $user){?>
			  <tr>
			  <td><?php echo $user->name; ?></td>
			  <td><?php echo $user->username; ?></td>
			  <td><?php echo 'login'; ?></td>
			  </tr>
			  	 
			 <?php }
				 
				
			   ?>
			  </tbody>
			  </table>
            </div>
            <!-- /.box-body -->
          </div>
			 <?php } ?>
</div>
<div class="col-md-12">
    <div class="col-md-4">
                    
				<form  method="post" action="<?php echo base_url();?>clinic/saveRequest" enctype='multipart/form-data'>
				
		        <p style="text-align:center; font-weight:bold; font-size:16px;">Patients Details</p>
				<label>Patient ID:  <span style="color:red"></span></label> 
				<input type="text" value="<?php echo strtoupper($new_id); ?> " name="patient_id" class="form-control" readonly>
				
				<label>Preferred Appointment date:  <span style="color:red"></span></label> 
				<div class='input-group date datepicker'>
				
					  <input type='text' autocomplete="off" name="requested_date" id="reqdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width:100%;">
					  <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
				</div>
				
				

				 

				<div id="">
                      <label>Title:  <span style="color:red">*</span></label> 
                        <select class="form-control select2" name="title" id="myselect" style="width:100%;">
                          							  <?php 
														$genders=array("Mr. ","Mrs. ","Rev", "Bishop","Prof","Eng");
														foreach ($genders as $gender) { ?>
							
														<option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
														<?php } ?>
		               							
		               	</select>
					</div>
                      <div id="">
                
                      <label>Name:  <span style="color:red">*</span></label> 
                        <input type="text" class="form-control" name="name" id="" style="width:100%;" placeholder="Full Name" autocomplete="off" required>
    
					</div>
					<div id="">
                
					<label>National ID:  <span style="color:red"></span></label> 
					<input type="text" class="form-control" name="national_id" id="" style="width:100%;" placeholder="National ID" autocomplete="off" >

				</div>
					<div id="">
						
						<label>Photo (Max-size=1.2MB, 200px*200px):  <span style="color:red"></span></label> 
						<input type="file" class="form-control btn btn-default" name="image" id="name" style="width:100%;" placeholder="" autocomplete="off">

					</div>
					<div id="">
						
						<label>Blood Group:  <span style="color:red"></span></label> 
						<input type="text" class="form-control" name="blood_group" id="blood_group" style="width:100%;" placeholder="" autocomplete="off" max-length="2" >

					</div>
					<div id="">
                      <label>Gender:  <span style="color:red">*</span></label> 
                        <select class="form-control select2" name="gender" id="myselect" style="width:100%;">
                          							  <?php 
														$genders=array("Male","Female");
														foreach ($genders as $gender) { ?>
							
														<option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
														<?php } ?>
		               							
		               	</select>
					</div>

					

				
    </div>
				<!--end column-->
     <div class="col-md-4">
	 <p style="text-align:center; font-weight:bold; font-size:16px;">Patients Details</p>
	        <label>Date of Birth:  <span style="color:red"></span></label> 
				<div class='input-group date datepicker'>
				
					  <input type='text' autocomplete="off" name="birth_date" id="reqdate" class="form-control" value="" style="width:100%;">
					  <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
				</div>
	              
	              <div id="">
                    <div id="">
                      <label>Contact:  <span style="color:red">*</span></label> 
                        <input type="mobile" class="form-control" name="mobile" id="contact" autocomplete="off" style="width:100%;" required>
    
					</div>
					</div>
					<div id="">
                      <label>Address:  <span style="color:red"></span></label>
				      <textarea class="form-control" name="address" id="address"  rows="2" cols="80" placeholder="Address"  style="background:#ebf8a4;"></textarea>
		            </div>

					<p style="text-align:center; font-weight:bold; font-size:16px;">Next of Kin Details</p>

					<div id="">
                     	<div id="">
                      <label>Next of Kin:  <span style="color:red">*</span></label> 
                        <input type="text" class="form-control" name="kins_name" id="nname" autocomplete="off" style="width:100%;" required>
    
					</div>
					</div>

				
                    <div id="">
                      <label>Next of Kin Contact:  <span style="color:red">*</span></label> 
                        <input type="kins_contact" class="form-control" name="next_contact" id="contact" autocomplete="off" style="width:100%;" required>
    
					</div>
					<div id="">
                      <label>Relationship:  <span style="color:red">*</span></label> 
                        <select class="form-control select2" name="kins_relationship" id="myselect" style="width:100%;">
                          							  <?php 
														$genders=array("Grand Child","Father","Mother","Spouse","Daughter","Son");
														foreach ($genders as $gender) { ?>
							
														<option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
														<?php } ?>
		               							
		               	</select>
					</div>
					<div id="">
                      <label>Address:  <span style="color:red"></span></label>
				      <textarea class="form-control" name="kins_address" id="" rows="2" cols="80" placeholder="Address"  style="background:#ebf8a4;"></textarea>
		            </div>
	</div>

	<div class="col-md-4">
	<p style="text-align:center; font-weight:bold; font-size:16px;">Chief Complaint</p>

	<div id="footer-buttons" style="clear:both; margin-top:0px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit"  ><span class="glyphicon glyphicon-arrow-right"></span>Save</button>
					 <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button>
                    
	 </div>	

                    
					 <div id="">
                      <label>Chief Complaint:  <span style="color:red"></span></label> 
					  <textarea class="form-control" id="address" name="chief_complaint" rows="2`13w2" cols="80" placeholder=""  style="background:#ebf8a4;"></textarea>			
		               	</select>
					</div>

					<div id="">
                     	<div id="">
                      <label>Description of the Chief Complaint:  <span style="color:red">*</span></label> 
					  <textarea class="form-control"  id="address" name="complaint_description" rows="5" cols="80" placeholder=""  style="background:#ebf8a4;"></textarea>
		         
					</div>
					</div>

	<p style="text-align:center; font-weight:bold; font-size:16px;">How did you hear about us?</p>

	<div id="">
	<select class="form-control select2" name="reference" id="myselect" style="width:100%;">
                          							  <?php 
														$references=array("N/A","Facebook","WhatsApp","Acquitance","Relative","Facebook");
														foreach ($references as $reference) { ?>
							
														<option value="<?php echo $reference; ?>"><?php echo $reference; ?></option>
														<?php } ?>
		               							
		               	</select>
	</div>
    <label> Consent</label>
	<select class="form-control select2" name="consent" id="myselect" style="width:100%;">
                          							  <?php 
														$consents=array("Yes","No");
														foreach ($consents as $consent) { ?>
							
														<option value="<?php echo $consent; ?>"><?php echo $consent; ?></option>
														<?php } ?>
		               							
	</select>

	</form>

  </div>


			