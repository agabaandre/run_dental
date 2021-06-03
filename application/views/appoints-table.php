
<script>

$('.timepicker').wickedpicker();
</script>
<script>
      $(function() {
        $('#mydata').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "responsive": true,
          "iDisplayLength": 20,
        "aLengthMenu": [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]],
          dom: 'Bfrtip',
          buttons: [
            'copy',
            'csv',
            'excel',
            'pdf',
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        select: true
  
        });
        });

        $(function(){
        $('.select2').select2();
        });
        
  </script>
<table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">Patient ID</th>
					   <th style="width:15%;">Name</th>
                       <th style="width:10%;">Patient's Contact</th>
					   <th stye="Width:10%;">Chief Complaint</th>
					   <th style="width:15%;">Time</th>
                        <th style="width:10%;">Start Date</th>
						<th style="width:10%;">End Date</th>							
                        <th style="width:15%;">Doctor</th>
						<?php ?><th style="width:10%;">Status</th>
						<th style="width:20%;">Set Time/Message</th> <?php ?>
                      </tr>
                    </thead>
<tbody>       
<?php 
$this->load->model("Request", "requestHandler");
	$c=1;
	
	
	
    foreach($appointments as $row) {
    ?>
	  <tr>  <td><?php echo $row->patient_id; ?></td>
	  		<td><a href="<?php echo base_url()?>clinic/userprofile/<?php echo  $row->patient_id;?>" target="_blank"><?php echo $row->patient;?></a></td>
			<td><?php echo $row->mobile;?></td>
			<th><?php echo $row->chief_complaint;?></td>
			<td><?php echo $row->time;?></td>
            <td><?php $id=$row->id; $requestid=$row->request_id; ?><?php echo $name=$row->start_date;?></td>
			<td><?php echo  $row->end_date;?></td>
			<td><?php echo $row->doctor;?></td>
	        <td>
	           <?php
                       //Flag Raiser
				 $status=$row->status;
					  if ($status==0){ ?>
						  <form action='<?php echo base_url();?>clinic/updateAppointment' method='post'>
						  <input type='hidden' value="1" name='status'>
						  <input type='hidden' value='<?php echo $id; ?> ' name='id'>
						  <button type='submit'  class='btn btn-sm btn-info' ><span class='glyphicon glyphicon-circle-ok'></span>New Appt</button>
						 </form>
					<?php  } 
					 elseif ($status==1){ ?>
						<form action='<?php echo base_url();?>clinic/updateAppointment' method='post'>
						  <input type='hidden' value="2" name='status'>
						  <input type='hidden' value='<?php echo $id; ?>' name='id'>
						 <button type='submit'  class='btn btn-sm btn-warning' ><span class='glyphicon glyphicon-ok-circle'></span>Confirmed</button>
						 </form> 
					<?php  
					}
					else { ?>
					    <!-- <form action='<?php echo base_url();?>clinic/updateAppointment' method='post'>
						  <input type='hidden' value="0" name='status'>
						  <input type='hidden' value='<?php echo $id; ?>' name='id'> -->
						 <button type='submit'  class='btn btn-sm btn-success' ><span class='glyphicon glyphicon-ok'></span>Finalised</button>
						 <!-- </form>  -->


					<?php }
					  ?>
					  
			</td>
			<td> 
			<div class="btn-group">
                  <!-- <button type="button" class="btn btn-default btn-link">Act</button>
                  <button type="button" class="btn btn-link btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button> -->
                  <!-- <ul class="dropdown-menu" role="menu"> -->
                    <a href="" data-toggle="modal" data-target="#<?php echo $modalid='my'.$id;?>" title="Set Appointment Time"><i class="glyphicon glyphicon-list"></i>Set Time</a>
                    <!-- <li><a href="" data-toggle="modal" data-target="#<?php echo $chat='request'.$id;?>" title="Messaage Client"><i class="glyphicon glyphicon-upload"></i>Message</a></li> -->
                 <!-- </ul> -->
			</div>
			<!--modal Update -->
			<div class="col-md-12 offset-2">
					<div class="modal model-md fade" id="<?php echo $modalid;?>" tabindex="-1" role="dialog" data-backdrop="static">
													<div class="modal-dialog modal-sm modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header">
															<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
															<h4 class="modal-title" style="text-align:center;"><i class=""></i>Set Appointment Date</h4>
														</div>
														<div class="modal-body">
				<form name="" id="data_form" method="post" action="<?php echo base_url();?>clinic/updateAppointment">
					<div id="">
					<input type='hidden' value='<?php echo $id; ?>' name='id'>
					<input type='hidden' value="1" name='status'>
          <input type='hidden' value="<?php echo $row->patient_id;?>" name='patient_id'>
         
					</div>
          <div class='input-group date datepicker'>
				
					  <input type='text' autocomplete="off" name="start_date" id="reqdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width:100%;">
					  <span class="input-group-addon">
					  <span class="glyphicon glyphicon-calendar"></span>
				</div>
	
				<div id="">
                      <label>Time:  <span style="color:red"></span></label>
				      <input class="form-control timepicker" name="Time" id="timepicker" value="<?php echo $row->Time; ?>" placeholder="" type="" style="width:100%;" >
				</div>	
				<div id="">
				<label>Doctor:  <span style="color:red"></span></label> 
                 <select class="form-control" name="doctor" style="width:100%;" required>	
					 <?php 
						 foreach ($doctors as $doctor) { 	
				    ?>
                    <option value="<?php echo $doctor->id; ?>" <?php if ($row->doctor==$doctor->name){ echo 'selected'; } ?>><?php echo $doctor->name; ?></option>
					<?php
					}
					?>				
		          </select>	
				</div>
        <div id="">
                      <label>Consultancy Fee<span style="color:red">*</span></label> 
                        <select class="form-control select2" name="amount" id="myselect" style="width:100%;" required>
                          							  <?php 
														$fees=array("0","10000",'15000','20000','5000');
														foreach ($fees as $fee) { ?>
							
														<option value="<?php echo $fee; ?>"><?php echo $fee; ?></option>
														<?php } ?>
		               							
		               	</select>
					</div>
			       <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" type="submit" ><span class="glyphicon glyphicon-plus"></span>Save</button>
					 <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset</button>
                     
				   </div>	
				   </form>  
				
				</div>
                </div>
                </div>
			 </div>
				</div>
				
		  <!---end modal-->
		  
		  <?php $messages=$this->requestHandler->getMessages($requestid); 
	  
		  
		 ?>

		  <!--modal Chat-->
		<div class="modal model-md fade" id="<?php echo $chat;?>" tabindex="-1" role="dialog" data-backdrop="static">
		 <div class="modal-dialog modal-sm modal-dialog-centered" style="margin-right: 50px; margin-top: 200px; height:60%; overflow: auto; background:#FEFFFF;">
		  <div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
							<h4 class="modal-title" style="text-align: center;"><i class=""></i><?php echo "Chatting with ".$row->patient; ?></br><?php echo$messages['message']->mobile; ?></h4>
						</div>
		   <div class="modal-body">
															
			<div class="box box-danger direct-chat direct-chat-info" style="background:#feffff;">
            <div class="box-header with-border">
              <h3 class="box-title">Chat</h3>

              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-red" data-original-title="3 New Messages">3</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
		
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"><?php echo $messages['message']->name; ?></span>
                    <span class="direct-chat-timestamp pull-right"><?php echo date('j F, Y H:i a',strtotime($messages['message']->followupdate)); ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="<?php echo base_url();?>assets/images/user.png" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
				  <?php echo $messages['message']->body;?>
                  </div>
                  <!-- /.direct-chat-text -->
               
                <!-- /.direct-chat-msg -->

				<!-- ReplyMessage to the right -->
				<?php foreach ($messages['reply'] as $reply) {
				?>
			
                <div class="direct-chat-msg <?php if ($reply->role!='Patient') echo'right';?>">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name <?php if ($reply->role!='Patient') { echo"pull-right"; } else { echo "pull-left"; } ?>"><?php echo $reply->name;?></span>
                    <span class="direct-chat-timestamp <?php if ($reply->role!='Patient') { echo"pull-left"; } else{ echo "pull-right"; }?>"><?php echo date('j F, Y H:i a',strtotime($reply->followupdate));?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="<?php echo base_url();?>assets/images/user.png" alt="Message User Image">
                  <div class="direct-chat-text">
                    <?php echo $reply->body; ?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
			  
				<?php } ?>
              <div class="box-footer">
              <form action="<?php echo base_url()?>Clinic/replyMessages" method="post" class="messages">
                <div class="input-group">
				<input type="hidden" value="Doctor" name="role"/>
				<input type="hidden" value="<?php echo $_SESSION['name']; ?>" name="name">
				<input type="hidden" value="<?php echo $messages['message']->request_id; ?>" name="request_id">
				<input type="hidden" value="<?php echo $messages['message']->id;?>" name="message_id"/>
                  <input type="text" name="body" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-danger btn-flat">Send</button>
                      </span>
                </div>
              </form>
             </div>
		  </div>
		</div>
	  </div>
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
