
<div class="dashtwo-order-area" style="padding-top: 10px;">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Schedule Doctors</h2>
					<p style="text-align:left; font:14 px; margin-top:5px;font-weight:bold;">
					</p>
               		</div>
                <div class="col-md-12 panel-body" style="overflow-x: scroll;">
				<div class="col-md-6">
                	<form class="form" autocomplete="off" style="padding-bottom: 2em;" action="<?php echo base_url(); ?>clinic/scheduleDoctor" method="post">
				    <div class="form-group">
					<label for="">Date</label>
					  <div class='input-group date datepicker'>
						<input type='text' autocomplete="off" name="date" id="auto" class="form-control" required>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
						</div>
					</div>
					<div class="form-group">
    				<label for="">Select Doctors</label>
					
					<select multiple class="form-control form-control-lg" id="doctors" name="doctors[]" style="min-height:200px; overflow:auto;" required>
					<?php 
					$i=1;
					foreach ($doctors as $doctor) {
					 ?>
					<option class="list-group-item" value="<?php echo $doctor->id;?>"><?php  echo $i++.'. '. $doctor->name;?></option>
					<?php } ?>
					
					</select>
					</div>
											
					<div class="control-group">
						<input type="submit" name="" value="Save Schedule" class="btn btn-success">
					</div>
							
							
				   </form>
				   </div>
			<div class="col-md-6 offset-2">
				   
			 <div class="box box-info">
            	<div class="box-header with-border">
              <h3 class="box-title">Next 20 Days Doctors Schedule</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="mydata" class="table table-striped">
			  <thead>
			  <tr>
			  <th>Date</th>
			  <th>Doctor</th>
			 
			  </tr>
			  </thead>
			  <tbody>
			  
			  <?php 
			  //today
			
			 foreach ($schedules as $schedule){?>
			 <tr>
			  <td><?php  $date= ($schedule->date); echo date('D, d F, Y',strtotime($date)); ?></td>
			  <td><?php echo $schedule->name; ?></td>
			  </tr>
			 <?php }?>

			  </tbody>
			  </table>
            </div>
            <!-- /.box-body -->
          </div>
			
		 </div>
		</div>
