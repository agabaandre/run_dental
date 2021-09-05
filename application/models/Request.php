<?php
class Request extends CI_Model
{
    public function get_requests()
    {            $this->db->order_by('status', 'ASC');
                 $this->db->limit(100);
        $query = $this->db->get("request");
        if ($query){
            return $query->result();
        }
        else{
            return array();
        }
    }

    public function get_appointments()
    {            
        $query = $this->db->query("SELECT appointments.patient_id,appointments.chief_complaint,appointments.start_date,appointments.id,appointments.end_date,appointments.time, request.mobile, doctors.name as doctor,request.name as patient,appointments.allDay, appointments.status,appointments.request_id FROM appointments  left join request on appointments.patient_id=request.patient_id  left join doctors on appointments.doctor=doctors.id where  appointments.status<=1 order by appointments.id desc");
        if ($query){
            return $query->result();
        }
        else{
            return array();
        }
    }

    public function getfinalAppointments()
    {            
        $query = $this->db->query("SELECT appointments.patient_id,appointments.chief_complaint,appointments.start_date,appointments.id,appointments.end_date,appointments.time, request.mobile, doctors.name as doctor,request.name as patient,appointments.allDay, appointments.status,appointments.request_id FROM appointments left join request on appointments.patient_id=request.patient_id  left join doctors on appointments.doctor=doctors.id where  appointments.status>1 order by appointments.id desc");
        if ($query){
            return $query->result();
        }
        else{
            return array();
        }
    }


    public function get_appointments_by_search($request)
    {            
        $query = $this->db->query("SELECT appointments.patient_id,appointments.chief_complaint,appointments.start_date,appointments.id,appointments.end_date,appointments.time, request.mobile, doctors.name AS doctor,request.name AS patient,appointments.allDay, appointments.status,appointments.request_id FROM appointments  LEFT JOIN request ON appointments.patient_id=request.patient_id LEFT JOIN doctors ON appointments.doctor=doctors.id WHERE request.name LIKE '%$request%' OR request.mobile LIKE '%$request%' OR request.patient_id LIKE '%$request%' AND  appointments.status<=1 ORDER BY appointments.id desc");

        if ($query){
            return $query->result();
        }
        else{
            return array();
        }
    } 


    public function saveAppointment($data,$id){
    $data=array(
        "start_date" => $data['start_date'],
        "end_date" =>$data['end_date'],
        "Time" => $data['time'],
        "doctor"=>$data['doctor']

    );
    $this->db->where('appointments.id',$id);
    $this->db->update('appointments',$data);
    
    return "Successful";

    }
    public function update_Appointment($data){
        if(!empty($data['Time'])){
        $postdata=$data;
        $id = $data['id'];
        $s_data=array(
            "start_date" => $data['start_date'],
            "end_date" =>$data['start_date'],
            "Time" => $data['Time'],
            "status" => $data['status'],
            "doctor" => $data['doctor']
        );
        }
        else{
         $s_data=array(
             "status" => $data['status']
         );   
        }
        $this->db->where('appointments.id',$id);
        $this->db->update('appointments',$s_data);

        //add consultancy Fee
        $this->appointment_bill($postdata,$id);
        
        if(!empty($s_data['email'])){
        $this->sendEmail($s_data);        }
        if(!empty($s_data['mobile'])){
         $this->SendSMS($s_data['mobile']);
        }

        return "Successful";
    }

    public function appointment_bill($postdata,$id){

        $insert=array("amount" => $postdata['amount'],
        "description" => 'Consultation Fees',
        "posting_date" => date('Y-m-d'),
        "appointment_id" => $id,
        "patient_id" => $postdata['patient_id'],
        "posted_by" => $_SESSION['name'],
        "bill_status"=>'1'
     );
     $this->db->insert('bill',$insert);

    }
    public function get_request($key)
    {
        if(!empty($key)) {
            $query = $this->db->query("SELECT * from request where name like '%%$key%' or email like '%%$key%' or request_date like'%%$key%' or requested_date like'%%$key' or id like'$key' order by status ASC LIMIT 20 ");
            return $query->result();
        } else {
            return array();
        }
    }
    public function get_clinic()
    {
            $query = $this->db->get('clinic');
            return $query->result();
    }
    public function get_userrequest($key)
    {
        if(!empty($key)) {
            $query = $this->db->query("SELECT * from request where mobile like '$key' ");
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMessages($requestId){
        
                 $this->db->where("message_id",NULL);
                 $this->db->where('request_id',"$requestId");
        $query = $this->db->get("messages");
        $mstring=array();
        if ($query){
            $messageheads=$query->result();
            foreach($messageheads as $messagehead){
            //get replies.
            $head = $messagehead->id;
            $reply['message']=$messagehead;
            $mreplies=$this->db->query("SELECT * from messages where messages.message_id=$head");
            $reply['reply'] = $mreplies->result();
            array_push($mstring,$reply);
            }
            foreach ($mstring as $message) {
            return   $message;
            }
           }
        else{
        return array();
        }
    }
    public function replyMessages($data){
        $datas=array(
            'request_id' => $data['request_id'],
            'body' => $data['body'],
            'message_id' => $data['message_id'],
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'role' => $data['role']
        );
            $query=$this->db->insert("messages",$datas);
            $rows=$this->db->affected_rows();
    if ($rows>0){
     return 'Successful';
    }
    else{
    return 'Failed';
    }
    }
    public function saveRequest($data,$file_name=FALSE)
        { 
       
        $datas=array(
            'name' => strtoupper($data['name']),
            'patient_id'=>$data['patient_id'],
            'title' => $data['title'],
            'national_id'=>strtoupper($data['national_id']),
            'tribe'=> strtoupper($data['tribe']),
            'occupation'=> strtoupper($data['occupation']),
            'religion'=> strtoupper($data['religion']),
            'nationality'=> strtoupper($data['nationality']),
            'birth_date' => $data['birth_date'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'image' => $file_name,
            'address' => $data['address'],
            'kins_name' => strtoupper($data['kins_name']),
            'kins_contact'=>$data['kins_contact'], 
            'kins_relationship' => $data['kins_relationship'],
            'kins_address' =>$data['kins_address'],
            'chief_complaint' => $data['chief_complaint'],
            'complaint_description' => $data['complaint_description'],
            'reference' => $data['reference'],
            'consent' => $data['consent'],
            'doctor' => $data['doctor'],
            'request_date' => date('Y-m-d'),
            'requested_date'=> $data['requested_date'],
            'services'=> NULL,
            'remarks'=> NULL


            );
           $query= $this->db->insert('request',$datas);
           if($query){
            $insert_id = $this->db->insert_id();
            $rows=$this->db->affected_rows();
            $this->followup($data,$insert_id,$final=$data['chief_complaint']);
            $this->make_appointment($data,$insert_id,$final);
            // add users
            if ($this->new_user($data)=='Successful'){
                $this->db->where('username',$data['mobile']);
                $query=$this->db->get('users');
             return $query->result();
             }
            else{
                $this->db->where('username',$data['mobile']);
                $query=$this->db->get('users');
            return $query->result();
            }
           }
           else{
           return 'Failed';
           }
        
        
        }
    public function make_appointment($data,$insert_id,$final){
        if($data['doctor']==''){
         $doctor = $data['doctor']='1';
        }
          else {
            $doctor=$data['doctor'];
          }
        
        $data=array(
            'patient_id'=>$data['patient_id'],
            'chief_complaint'=>$data['chief_complaint'],
            'start_date'=>$data['requested_date'],
            'end_date' => $data['requested_date'],
            'Time' => NULL,
            'allDay' => 'true',
            'request_id'=>$insert_id,
            'doctor' =>$doctor

        );
        $this->db->insert('appointments',$data);

    }
    public function add_doctor($data){
        $datas =array(
            "work_id"=>$data['work_id'],
            "name"=>$data['name'],
            "email"=>$data['email'],
            "mobile"=>$mobile=$data['mobile'],
            "cadre"=>$data['cadre']
        );
        $users=$this->db->query("SELECT mobile from doctors where mobile='$mobile'");
        $rows=$users->num_rows();
        if($rows>0){
        return array('dbstatus'=>'Duplicate Mobile Number');
        }
        else{
        $query=$this->db->insert('doctors',$datas);
        if ($query){
        //create user account
        if ($this->new_user($data)){
           $this->db->where('username',$data['mobile']);
           $query=$this->db->get('users');
        }
        return $query->result();
        }
        else{
        return array();
        }
        }
   }
    //comfirm
    public function followup($data,$request_id,$final){
        
        $data=array(
            'request_id' => $request_id,
            'name' => $data['name'],
            'mobile'=>$data['mobile'],
            'entry_id' => $data['mobile'].$final.date('Y-m-d'),
            'body' => 'I need your assistance on '.$final,
            'role' => 'Patient'
        );
       $notify = $this->db->insert('messages',$data);
       if($notify){
           return 'Successful';
       }
    }
    
    //create user acccount comfirm
    public function new_user($data){
        if(!empty($this->input->post('usertype'))){
            $usertype=$this->input->post('usertype');
            $name=$this->input->post('name');
            $username=$this->input->post('username');
        }
        else{
            $usertype='Patient';
            $username=$data['mobile'];
            $name=$data['name'];
        }
        $password=md5("login");
        $data=array(
            'username' =>$username ,
            'name' => $name,
            'password' => $password,
            'usertype' => $usertype
        );
        //check if user already exists{
      $users=$this->db->query("SELECT username from users where username='$username'");
      $rows=$users->num_rows();
     if($rows>0){
        return 'Duplicate Mobile Number, Patient already exists';
     }
     else{
       $notify = $this->db->insert('users',$data);
       if($notify){
        return 'Successful';
       }
    }
    }
    //get users
    public function getUsers(){
       // $this->db->where('status','1');
        $query=$this->db->get('users');

     return $query->result();
    }
    public function getLogs(){
         $query=$this->db->get('logs');
      return $query->result();
     }
    public function updateusers($data){
        $this->db->where('uuid !=','2');
        $this->db->where('uuid',$data['uuid']);
        $query=$this->db->update('users',$data);
        if($query){
          return 'Successful';  
        }
        else{
          return 'Failed';
        }
        
    }
   
    public function changePwd($data){
		$oldpwd=$data->oldpwd;
		$newpwd=md5($data['newpwd']);
		$realoldpwd=md5($oldpwd);
		$username=$data->username;
        $query=$this->db->query("SELECT password from users where username='$username'");
        $results=$query->result();
        $rows=$query->num_rows();
        if($rows>0){
		foreach($results as $result){
			$dboldpwd=$result->password;
		}
		if($realoldpwd==$dboldpwd){
		$sql=$this->db->query("UPDATE `users` SET `password` = '$newpwd' WHERE `users`.`username` = '$username'");
	     if($sql){
		 return 'Successful';	 
		 }
		 else{
		return 'Failed';
		 }
		}
		else{
		return 'Failed';
		}
      }
      else{
        return 'Failed';
      }
  }
   public function cancelRequest($id){
  //cancelled status =3 
    $sql=$this->db->query("UPDATE request SET status = '3' WHERE request.id = '$id'");
    $date=date('Y-m-d');
    $this->db->query("DELETE from messages where  request_id ='$id' and followupdate like'$date%'");
    if($sql){
    return array('dbstatus'=>'Cancelled');	 
    }
    else{
    return array('dbstatus'=>'Failed');
    }

   }

 public function dashboard(){
     //monthly requests
     $dashbaord=array();
     $date=date('Y-m');
     $query=$this->db->query("select count(id) as monthly_requests from request where request_date like'$date%'");
     $data['monthly_requests']=$query->result();
     //comfirmed Appointments
     $query=$this->db->query("select count(id) as monthly_appointments from appointments where start_date like'$date%' and status='1'");
     $data['monthly_appointments']=$query->result();
     // doctors
     $query=$this->db->query("select count(id) as doctors from  doctors where flag='1'");
     $data['doctors']=$query->result();
     // Patients
     $query=$this->db->query("select count(patient_id) as patients from  request where patient_id!=''");
     $data['patients']=$query->result();

     array_push($dashbaord,$data);

 return $dashbaord;

 }
    public function get_diagnosis($id){
        $query=$this->db->query("SELECT * FROM diagnosis,appointments,request where diagnosis.appointment_id=appointments.id and appointments.patient_id=request.patient_id and diagnosis.appointment_id='$id'");
        return $query->result();

    }
    public function post_diagnosis($data,$tooth){
     
        $query=$this->db->replace('diagnosis',$data);
      
        $query2=$this->db->insert_batch('tooth_diagnosis',$tooth);

        if($query&&$query2){
            return "Successful";
            }
            else{
            return "Failed";
    
            }
    }
    public function get_billstatus($id){
    $query= $this->db->query("SELECT sum(amount) as total from bill where appointment_id='$id'");
     return $query->result();
    }

    public function followup_appointments($data){
        $this->db->insert('appointments',$data);
        return $this->db->affected_rows();
     
    }
    //load settinngs
    public function settings(){
       $query = $this->db->get('variables');
       
    return $query->row();
    
    }
    public function update_variables($data){
        $query = $this->db->replace('variables',$data);
        if($query){
            echo "Sucessful";
        }
        else{
            echo "Failed";
        }
     
     }
     public function getsettings(){
        return $this->db->get('variables')->result()[0];
     }
     
    public function SendSMS($number)
        
    {
    //number is an array which you can loop through according to your use case so you need to first process it
    $message=$this->getsettings()->sms_message." ".$number['start_date'] ." ". $number['Time'];
    $number=$number['mobile'];
    $email ='it@kkt.co.ug' ;
    $password = 'kkt@2017';
    $sender = $this->getsettings()->company;
    $url = "www.afrosms.ug";
    $path = "/smskings/api.php?";
    $parameters = "destination=[destination]&message=[message]&email=[email]&password=[password]&source=[source]&call=sendsms";
    $parameters = str_replace("[destination]", urlencode($number), $parameters);
    $parameters = str_replace("[message]", urlencode($message), $parameters);
    $parameters = str_replace("[email]", urlencode($email), $parameters);
    $parameters = str_replace("[password]", urlencode($password), $parameters);
    $parameters = str_replace("[source]", urlencode($sender), $parameters);
    $furl       = "https://" . $url . $path . $parameters;
    $curl = curl_init($furl);
    curl_setopt($curl, CURLOPT_URL, $furl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);
    // var_dump($resp);
    return $resp;
    }
    public function sendEmail($data){
        
        $this->load->library('email');
        $body='You have a new appointment request from Run Dental Clinic'.$data['start_date'] ." at ". $data['Time'];;
        
        $this->email->from($this->getsettings()->company,$this->getsettings()->email );
       $this->email->to($data['emmail']);
        //$this->email->cc();
        $this->email->bcc('agabaandre@gmail.com');
        
        $this->email->subject('Service Notifiaction '.$this->getsettings()->company);
        $this->email->message($body);
        
        $this->email->send();
    return 'Success';
    }
       


}
 