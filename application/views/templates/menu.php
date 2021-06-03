<?php if (in_array($view,array('rosta'))){ echo'<body class="hold-transition skin-blue fixed sidebar-collapse sidebar-mini" id="index">';} 
 else { echo'<body class="hold-transition skin-blue fixed sidebar-mini" id="index">';} ?>
    <div class="wrapper">

      <header class="main-header static-top" >
        <a href="" class="logo"  style="background:#7b9f0e url(<?php echo base_url(); ?>.'assets/images/header_title.png') 0 0 repeat-x; color:white;">
          <span class="logo-lg"><b><?php echo $settings->system_name;?></b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation" style="background: linear-gradient(135deg, rgba(30,29,31,1) 0%, #3c8dbc 100%);color:white;">
          <a href="#" class="" data-toggle="offcanvas">
            <span class="fa fa-outdent" style="background:#003248 no-repeat; width:40px; height:40px; float:left; margin-left:2px; margin-top:7px;"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu" style="background:#003248;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/login.png" class="user-image" alt="">
                  <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                  <p>
                        <small><?php echo date('jF,Y H:i:s');?></small>
                        <span id="txt1"></span>
                  
                          <br/><br/>
                          <?php echo $_SESSION['usertype'];?>
                  </p>
                  </li>
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                    <form class="form-inline" action="" method="post">
                    <select class="form-control" name="language" onchange='this.form.submit()' >
                    <option>Select Language</option>
                    <option value="en_us.php" selected>English</option>
                   
                    </select>
                    </form>
          </div>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url();?>index.php/clinic/change_pwd" class="btn btn-default">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url();?>index.php/clinic/logout" class="btn btn-default">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel" style="font-size:0.9em; font-weight:bold; color:#FFFFFF; z-index:2;">
              <!-- <p style="text-align:center;">Attendance Tracker</p> -->
          </div>
          <ul class="sidebar-menu">

          
		   <?php if (in_array($view,array('home'))){
            echo'<li class="active treeview">';
			}
		   else{
		 echo'<li class="treeview">';
		   }?>
              <a href="<?php echo base_url()?>clinic/dashboard">
              <i class="glyphicon glyphicon-dashboard fa-lg" style="color:lightblue;"></i><span>Dashboard</span> 
              </a>
              </li>



     <?php if (in_array($view,array('requests','view_requests','request','final_appointments','returningRequest','add_appointment'))){
            echo'<li class="active treeview">';
			}
		     else{
			  echo'<li class="treeview">';
		     }?>
              <a href="#">
                <i class="glyphicon glyphicon-question-sign fa-lg" style="color:lightblue;"></i>
                <span>Front Office</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="<?php echo base_url();?>clinic/newRequest">New Registration</a></li>
                <li class=""><a href="<?php echo base_url();?>clinic/returning_patient">Returning Patient Appointment</a></li>
                <li class=""><a href="<?php echo base_url();?>clinic/makeAppointment">Pending Appointments</a></li>
                <li class=""><a href="<?php echo base_url();?>clinic/finalisedAppointment">Finalised Appointments</a></li>
                
                
			          
			          </ul>
            </li>
		
            <?php if (in_array($view,array('add_doctor','schedule_doctors','view_doctors'))){
            echo'<li class="active treeview">';
			}
		     else{
			  echo'<li class="treeview">';
		     }?>
              <a href="#">
                <i class="glyphicon glyphicon-user fa-lg" style="color:lightblue;"></i>
                <span>Employee</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="<?php echo base_url();?>clinic/addDoctor">Register New Employee</a></li>
                
                <li class=""><a href="<?php echo base_url();?>clinic/scheduleDoctors">Schedule Doctors</a></li>
			          
			          </ul>
            </li>
            <?php if (in_array($view,array('diagnose'))){
            echo'<li class="active treeview">';
			}
		     else{
			  echo'<li class="treeview">';
		     }?>
              <a href="#">
                <i class="fa fa-ambulance" style="color:lightblue;"></i>
                <span>Diagnosis</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
                 <li class=""><a href="<?php echo base_url();?>clinic/diagnosis">New Diagnosis</a></li> 
                 <li class=""><a href="<?php echo base_url();?>clinic/diagnosis/previous">Previous Diagnosis</a></li> 
			          </ul>
            </li>
            <?php if (in_array($view,array('billing','manage_bill'))){
            echo'<li class="active treeview">';
			}
		     else{
			  echo'<li class="treeview">';
		     }?>
              <a href="#">
                <i class="fa fa-credit-card" style="color:lightblue;"></i>
                <span>Billing</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="<?php echo base_url();?>clinic/billing">Capture Bill</a></li>
                <li class=""><a href="<?php echo base_url();?>clinic/manage_billing">Manage Bill</a></li>
                
			          </ul>
            </li>
         			  
         			  
			
			   <?php if (in_array($view,array('home_reports','userprofile','outstanding','stafflist','patientslist'))){
            echo'<li class="active treeview">';
			}
		     else{
			    echo'<li class="treeview">';
		          }?>
              <a href="<?php echo base_url();?>clinic/reports">
              <i class="glyphicon glyphicon-th-list fa-lg" style="color:lightblue;"></i>
              <span>Reports</span>
              <span class="label label-primary pull-right"></span>
              </a>
            </li>
			<?php if ( in_array($view,array('manage_users','services','clinics'))){
                 echo'<li class="active treeview">';
		          	}
		           else{
			echo'<li class="treeview">';
		           }?>
              <a href="">
                   <i class="glyphicon glyphicon-cog fa-lg" style="color:lightblue;"></i>
                  <span class="">System Settings</span>
                   <span class="label label-primary pull-right"></span>
                  </a>
              <ul class="treeview-menu">
              <?php  if  	($_SESSION['usertype'] =='admin')
		             { ?>  
                <li><a href="<?php echo base_url();?>clinic/users"><i class="fa fa-circle-o"></i>Users</a></li>
		             <li><a href="<?php echo base_url();?>clinic/services"><i class="fa fa-circle-o"></i>Products/Services</a></li>
                 <li><a href="<?php echo base_url();?>clinic/clinics"><i class="fa fa-circle-o"></i>Clinics</a></li>
                 <li><a href="<?php echo base_url();?>clinic/variables"><i class="fa fa-circle-o"></i>Variables</a></li>
               
                <?php } 
			  	else{ ?>
                <li><a href="<?php echo base_url();?>clinic/services"><i class="fa fa-circle-o"></i>Products/Services</a></li>
                 <li><a href="<?php echo base_url();?>clinic/clinics"><i class="fa fa-circle-o"></i>Clinics</a></li>
                 <?php	}
				?>
				
           </ul>
            </li>
				   <?php if (in_array($view,array('change_password'))){
            echo'<li class="active treeview">';
		        	}
		       else{
			echo'<li class="treeview">';
		           }?>
              <a href="<?php echo base_url();?>clinic/changepwd">
                <i class="glyphicon glyphicon-lock fa-lg" style="color:lightblue;"></i>
               <span>Change Password</span>
                <span class="label label-primary pull-right"></span>
              </a>
            </li>
           </ul>
        </section>
      </aside>