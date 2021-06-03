

     <h4>
        Patient Profile
      </h4>
    <div class="cp;-md-12">
    <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Make Appointment<i class="fa fa-add"></i>
        </button>
    
    </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
        <?php //print_r($profile); ?>
              <img class="profile-user-img img-responsive img-circle" src="https://img.favpng.com/25/13/19/samsung-galaxy-a8-a8-user-login-telephone-avatar-png-favpng-dqKEPfX7hPbc6SMVUCteANKwj.jpg" alt="User profile picture">

              <h4 class="profile-username text-center">PATIENT ID: <?php echo $profile[0]->patient_id;?></h4>
              <h4 class="profile-username text-center">NAME: <?php echo $profile[0]->name;?></h4>

              <p class="text-muted text-center"><?php echo $profile[0]->email;?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Date of Birth</b> <a class="pull-right"><?php echo $profile[0]->birth_date;?></a>
                </li>
                <li class="list-group-item">
                  <b>Blood Group</b> <a class="pull-right"><?php echo $profile[0]->blood_group;?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact</b> <a class="pull-right"><?php echo $profile[0]->mobile;?></a>
                </li>
                <li class="list-group-item">
                  <b>Address</b> <a class="pull-right"><?php echo $profile[0]->address;?></a>
                </li>
                <li class="list-group-item">
                  <b>Next of Kin</b> <a class="pull-right"><?php echo $profile[0]->kins_name;?></a>
                </li>
                <li class="list-group-item">
                  <b>Next of Kin Relationship</b> <a class="pull-right"><?php echo $profile[0]->kins_relationship;?></a>
                </li>
                <li class="list-group-item">
                  <b>Next of Kin Contact</b> <a class="pull-right"><?php echo $profile[0]->kins_contact;?></a>
                </li>
                <li class="list-group-item">
                <a href="mailto:<?php echo $profile[0]->email;?>" class="btn btn-primary btn-block"><b>Email</b></a>
                </li>
              </ul>

              <a href="tel:<?php echo $profile[0]->mobile;?>" class="btn btn-primary btn-block"><b>Call</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Number of Visits</strong>

              <p class="text-muted">
               <?php echo $requests[0]->requestno; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> <?php echo $profile[0]->address;?></strong>

              <p class="text-muted"></p>

              <hr>

              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Diagnosis/Treatment (Latest 50)</a></li>
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
              <?php //print_r($diagnosis); ?>

              <?php foreach ($diagnosis as $row) { ?>
                  
              
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="https://e7.pngegg.com/pngimages/508/232/png-clipart-physician-medicine-urology-health-care-your-doctor-health-service-medical-diagnosis.png" alt="image">
                        <span class="username">
                          <a href="#"><?php echo $row->doctor;?></a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Diagnosis on <?php echo $row->date_diagnosed; ?></span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                   <?php echo $row->diagnosis; ?>
                  </p>
                  <ul class="list-inline">
                   
                  </ul>


                </div>
                <!-- /.post -->

                    
              
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="https://cdn.imgbin.com/23/9/19/imgbin-physical-therapy-physician-illustration-doctor-treatment-7XpK7BcQQ7hbJJe0YLwwybetG.jpg" alt="image">
                        <span class="username">
                          <a href="#"><?php echo $row->doctor;?> </a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Treatment on - <?php echo $row->date_diagnosed; ?></span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                   <?php echo $row->treatment; ?>
                  </p>
                  <ul class="list-inline">
                   
                  </ul>
                  <hr/>


                </div>
                <!-- /.post -->
                <?php } ?>

               
              </div>
              <!-- /.tab-pane -->
             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
    
        
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
      <form name="" id="data_form" method="post" action="<?php echo base_url();?>clinic/scheduleAppointment">
      <label>Preferred Appointment date:  <span style="color:red"></span></label> 
				<div class='input-group date datepicker'>
				
					  <input type='text' autocomplete="off" name="start_date" id="reqdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width:100%;">
					  <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
				</div>

          <div id="">
                      <label>Chief Complaint:  <span style="color:red"></span></label> 
					  <textarea class="form-control" id="address" name="chief_complaint" rows="2`13w2" cols="80" placeholder=""  style="background:#ebf8a4;"></textarea>			
		               	</select>
					</div>
	
			
				<div id="">
		
         <input type="hidden" name="doctor" value="1">

         <input type="hidden" name="patient_id" value="<?php echo $profile[0]->patient_id;?>">

   
				</div>
			       <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit" ><span class="glyphicon glyphicon-plus"></span>Save</button>
					 <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset</button>
                     
				   </div>	
				   </form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
        <!-- /.col -->
      </div>
   
      <!-- /.row -->

