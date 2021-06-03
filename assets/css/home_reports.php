<?php
if($action=="clock_data")
								include_once("modules/reports/attendance_data_by_clock_data.php");
?>								
<div class="col-md-12" style=" background:white; border-radius: 5px;">
<div id="sys_reports">               
                <div class="box-header with-border">
                  <h5 class="box-title">Reports</h5>
                </div>
<div class="col-md-12">
           <div class="box-header with-border">
                 <p class="box-title"><strong>Monthly Report</strong></p>
           </div>
                    <ol>
                      <li><a href="dashboard.php?action=attendance_summary2">Work Schedule Report</a><p> - Montly workschedule report</p></li>
                      
                <div class="box-header with-border">
                 <p class="box-title"><strong>Staff Reports</strong></p>
                 <li><a href="dashboard.php?action=attendance_summary2">Stafflist</a><p> - Printable employee stafflist</p></li>
                      
           </div>
                     			
				   </ol>
    </div>
</div>
</div>