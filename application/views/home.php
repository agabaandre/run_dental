<div class="col-md-12" style=" border-radius: 5px;" >
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
                 </ul>
		  </div>                              
               <div class="box-header with-border">
                 <h5 class="box-title"><strong><?php  echo $heading; ?></strong></h5>
                </div>
        <div class="col-md-12">
           <?php
            //print_r($dashdata);
           ?>
      <div class="row">

      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow" style="color:darkcyan;"><i class="fa fa-envelope"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Leads</span>
              <span class="info-box-number"><?php echo $dashdata[0]['monthly_requests'][0]->monthly_requests; ?><small>Requests</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue" style="color:darkcyan;"><i class="fa fa-clock"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Confrmed Leads</span>
              <span class="info-box-number"><?php echo $dashdata[0]['monthly_appointments'][0]->monthly_appointments ;?><small>Leads</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green" style="color:darkcyan;"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Doctors on Duty</span>
              <span class="info-box-number"><?php echo $dashdata[0]['doctors'][0]->doctors ?><small>Doctors</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red" style="color:darkcyan;"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Patients</span>
              <span class="info-box-number"><?php echo $dashdata[0]['patients'][0]->patients ?><small>Patients</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="row">
              <!-- Left col -->
            <div class="col-md-8">
            <div class="box">
            	<div class="box-header with-border">
              <h3 class="box-title">Appointments Calender</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
               

                      <!-- <div class="map"></div> -->
                      <div id='calendar'></div>
                </div>
              </div>
              
          <!-- /.col -->
          </div>

          
       
    
      <!-- /.row -->
      <!-- Main row -->

      <div class="row">
               
		
				
				
      <div class="col-md-4">
                <div class="box">
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
                      
                
                 
       
                 </table>
              
               
               
               
               
               
       
               </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <script type="text/javascript">
      $(document).ready(
       function(){
       var events = <?php echo json_encode($data) ?>;
       var date = new Date()
       var d    = date.getDate(),
           m    = date.getMonth(),
           y    = date.getFullYear()
          
      $('#calendar').fullCalendar({
        header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
        },
        buttonText: {
        today: 'Today',
        month: 'Month',
        week : 'Week',
        day  : 'Day'
        },
        events    : events
      })});
    
</script>