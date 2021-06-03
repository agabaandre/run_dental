<div class="col-md-12" style=" background:white; border-radius: 5px;"> 
<div class="nav-tabs-custom"> 
    <ul class="nav nav-tabs">
				  <li class="btn btn-sm btn-default"><a href="dashboard.php?action=reports">Back</a></li>
                 </ul>
				</div>
                <script>
                 function printDiv(printableDiv){
                var printContents =document.getElementById(printableDiv).innerHTML;
				var originalContents= document.body.innerHTML;
				document.body.innerHTML = printContents;
				window.print();
				document.body.innerHTML = originalContents;
				}
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#mydata tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Year '+title+'" />' );
        $(this).html( '<input type="text" placeholder="Month '+title+'" />' );
    } );
    // DataTable
    var table = $('#mydata').DataTable();
    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
    </script>
<?php include("src/export.php");?>
 <button type="button"  class="btn btn-sm btn-default" onclick="printDiv('printableArea')">Web Print</button>
<hr style="border:1px solid rgb(140, 141, 137);"/>
<p style="font-weight:bold;">Select Month and Year</p>
<form action="" method="POST" style="width:30%;" class="form-inline">
  <label for="month_end">Month</label>
  <select id="month" name="month" class="form-control select2">
    <option value="1">January</option>      
    <option value="2">February</option>      
    <option value="3">March</option>      
    <option value="4">April</option>      
    <option value="5">May</option>      
    <option value="6">June</option>      
    <option value="7">July</option>      
    <option value="8">August</option>      
    <option value="9">September</option>      
    <option value="10">October</option>      
    <option value="11">November</option>      
    <option value="12">December</option>      
  </select>
  <label for="year">Year</label>
  <select class="form-control select2" name="year">
    <option value="2016">2016</option>      
    <option value="2017">2017</option>      
    <option value="2018">2018</option>      
    <option value="2019">2019</option>      
    <option value="2020">2020</option>      
    <option value="2021">2021</option>      
    <option value="2022">2022</option>      
    <option value="2023">2023</option>      
    <option value="2024">2024</option>      
    <option value="2025">2025</option>      
  </select>
  <p></p>
  <button   type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>
</fieldset>
</form>
<div id="printableArea">                            
                <div class="box-header with-border">
                  <h5 class="box-title">Attendance Report</h5>
                </div>
<div class="col-md-12">
	 <table id="mydata" class="table table-hover table-responsive table-bordered">
                    <thead>
                      <tr>
					   <th>Employee ID</th>
					   <th>Month</th>
					   <th>Year</th>
						<th>Name</th>
						<th>iHRIS Person ID</th>
						<th>Position</th>
						<th>Facility</th>
						<th width=40>Total Hours</th>
						<th width=40>Present(P)</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
                        $year_name= $_POST['year'];
						$month_name= $_POST['month'];					
					$sql="SELECT SUM( present_status ) AS total_present, SUM(time_difference) AS total_time, emp_id, month_name, year_name FROM attendance_data WHERE verification_flag=1 AND year_name LIKE '%$year_name%' AND month_name LIKE '%$month_name%' GROUP BY emp_id, month_name, year_name";
					$result = mysql_query($sql);
					while($row = mysql_fetch_array($result)) 
                   {  
                    ?>
                    <tr>
					   <td><?php echo $id=$row['emp_id']; ?></td>
					   <td><?php $month_fig=$row['month_name']; $dateobj = DateTime:: CreateFromFormat('!m', $month_fig);
					   $month_name=$dateobj->format ('F');
					   echo $month_name;
					   ?></td>
					   <td><?php echo $row['year_name']; ?></td>
					   <td><?php
                        $find="SELECT Firstname, Surname, Othername, hris_pid, position, facility FROM `employee_details` WHERE emp_id = '$id'";
					    $found = mysql_query($find);
					   ($cells = mysql_fetch_array($found));{
					    echo $cells['Surname']." ".$cells['Firstname']." ".$cells['Othername'];?> </td>
					    <td><?php echo $cells['hris_pid']; ?></td>
					   <td><?php echo $cells['position']; ?></td>
					   <td><?php echo $cells['facility']; }?></td>
					   <td width=40><?php echo $row['total_time']; ?></td>
					   <td width=40><?php echo $row['total_present']; ?></td>
                    </tr>
					<?php  } ?>
                    </tbody>
                    <tfoot>
					<th>
                    </tfoot>
    </table>
    </div>
    </div>
</div>
<div class="col-md-4">			 
</div>
<div class="col-md-4">
</div>
</div>
</div>