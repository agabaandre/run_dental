
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
			
   </tr>
    <?php	
    }
    ?>
	 </tbody>
        <tfoot>
      </tfoot>
    </table>