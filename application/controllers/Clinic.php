<?php defined("BASEPATH") or exit("No direct script access allowed");

require APPPATH . 'libraries/REST_Controller.php';

class Clinic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Auth", "authHandler");
        $this->load->model("Request", "requestHandler");
        $this->load->model("Employee", "employeeHandler");
        $this->key = urldecode($this->uri->segment(3));
    }

    public function index()
    {
         $this->load->view('login'); 
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("clinic/login");    
    }

    public function login()
    {
        $data = $this->input->post();
        $userInfo = $this->authHandler->authenticate($data);
        $data['title']="Dashboard";
        $data['view']="home";
        $data['heading']="Dashboard";
        $data['schedules'] = $this->employeeHandler->monthlyDoctors();
        $data['dashdata'] = $this->requestHandler->dashboard();
        if($userInfo) {
            $this->session->set_userdata($userInfo);
        $this->load->view('main',$data);
        } else {
            $this->session->set_flashdata('message', '<p style="color:red;">Authentification Failed!<p>');
           $this->load->view('login');
        }
        
    }
    public function dashboard()
    {
        $data = $this->input->post();
        $userInfo = $this->authHandler->authenticate($data);
        $data['title']="Dashboard";
        $data['view']="home";
        $data['schedules'] = $this->employeeHandler->monthlyDoctors();
         
        $data['dashdata'] = $this->requestHandler->dashboard();
        $data['heading']="Dashboard";
        $data['result'] = $this->requestHandler->get_appointments();
        foreach ($data['result'] as $key => $value) {
            $data['data'][$key]['title'] = $value->patient . " ".$value->mobile." (Time: ". $value->time.")" ;
            $data['data'][$key]['start'] = $value->start_date;
            $data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#00a65a";
        } 
        //print_r($data['dashdata']);
        $this->load->view('main',$data);
        
    }
  
    public function requests()
    {
        $data['title']="Request";
        $data['view']="requests";
        $data['heading']="View Requests";
        $data['requests'] = $this->requestHandler->get_requests();
        $this->load->view('main', $data);
    }
    public function clinic()
    {
        $data['title']="Request";
        $data['view']="requests";
        $data['heading']="View Requests";
        $data['doctors'] = $this->employeeHandler->get_doctor();
      
        return $data;
    }
    public function clinics(){
        $data['title'] = "Clinics";
        $data['view'] = "clinics";
        $data['heading'] = "Clinics";
        $process=$this->input->post();

        if($this->input->post('add')=='add'){

        $data['message'] = $this->employeeHandler->add_clinic($process);
        }
        if($this->input->post('update')=='update'){
            $data['message'] = $this->employeeHandler->update_clinic($process);
        }
        if($this->input->post('delete')=='delete'){
                $data['message'] = $this->employeeHandler->delete_clinic($process);
        }
        $data['clinics'] = $this->requestHandler->get_clinic();
       //print_r($process);
       $this->load->view('main', $data);
    }

    public function cancelRequest()
    {
        $requestId = $this->input->post('request_id');
        $data['title']="Request";
        $data['view']="requests";
        $data['heading']="View Requests";
        $requestData=$this->requestHandler->cancelRequest($requestId);
        if ($requestData){
            $this->session->set_flashdata('message', '<p style="color:green;">Cancelled!<p>');
        $data['requests'] = $this->requestHandler->get_requests();
        $this->load->view('main', $data);
        }
        else {
            $this->session->set_flashdata('message', '<p style="color:red;">Failed!<p>');
        $data['requests'] = $this->requestHandler->get_requests();
        $this->load->view('main', $data);

        }
    }
   
    
    public function searchRequest()
    {
        $searchterm = $this->input->post('searchterm');
        $data['title']="Request";
        $data['view']="requests";
        $data['heading']="View Requests";
        $data['requests'] = $this->requestHandler->get_request($searchterm);
        $this->load->view('main', $data);
    }
    public function doctors(){
        $data['title'] = "Doctors";
        $data['view'] = "doctors";
        $data['heading'] = "View Doctors";
        $data['doctors'] = $this->employeeHandler->get_doctor();
        $this->load->view('main', $data);
    }
    public function getProdlist($searchTerm){
    $products= $this->employeeHandler->getProdlist($searchTerm);
     echo json_encode( $products);
    }

    public function services(){
        $data['title'] = "Services";
        $data['view'] = "services";
        $data['heading'] = "Services";
        $process=$this->input->post();

        if($this->input->post('add')=='add'){

        $data['message'] = $this->employeeHandler->add_services($process);
        }
        if($this->input->post('update')=='update'){
            $data['message'] = $this->employeeHandler->update_services($process);
        }
        if($this->input->post('delete')=='delete'){
                $data['message'] = $this->employeeHandler->delete_services($process);
        }
        $data['services'] = $this->employeeHandler->get_services();
       //print_r($process);
       $this->load->view('main', $data);
    }
    
    public function availableDoctors(){
        $date = $this->input->post('date');
        if(!empty($date)){ 
        $doctorData = $this->employeeHandler->get_availabledoctors($date);
    echo json_encode($doctorData);
        }
        else{
    echo  json_encode(array("Select Value"=>"Select Value"));
        }
    }
    public function monthlyDoctors(){
        $date = $this->input->post('date');
        if(!empty($date)){ 
        $doctorData = $this->employeeHandler->get_availabledoctors($date);
    echo json_encode($doctorData);
        }
        else{
    echo  json_encode(array("Select Value"=>"Select Value"));
        }
    }
    public function newRequest()
    {
        $data['title'] = "Send Request";
        $data['view'] = "request";
        $data['heading'] = "Request Dental Services";
        $data['doctors'] = $this->employeeHandler->get_doctor();
        $data['services'] = $this->employeeHandler->get_services();
        $data['clinics'] = $this->requestHandler->get_clinic();
        //$date = new DateTime();
        $timestamp = date('siHdMY');
        $string = "0123789ABCDEFGHIJ456KLMNOPQRSTVWXYZ";
        $string_s = $timestamp.$string;
        $shuffle = str_shuffle($string_s);
        $uniqueId = date('si').substr($shuffle, 0, 6);
        $data['new_id']= 'RUN-'.$uniqueId;
        $this->load->view('main',$data);
    }
    public function returnRequest()
    {
        $data['title'] = "Send Request";
        $data['view'] = "returningRequest";
        $data['heading'] = "Request Dental Services";
        $data['doctors'] = $this->employeeHandler->get_doctor();
        $data['services'] = $this->employeeHandler->get_services();
        $data['clinics'] = $this->requestHandler->get_clinic();
        
        $this->load->view('main',$data);
    }
    public function saverequest()
    {
        $data['title'] = "Send Request";
        $data['view'] = "request";
        $data['heading'] = "Request Dental Services";
        $timestamp = date('siHdMY');
        $string = "0123789ABCDEFGHIJ456KLMNOPQRSTVWXYZ";
        $string_s = $timestamp.$string;
        $shuffle = str_shuffle($string_s);
        $uniqueId = date('si').substr($shuffle, 0, 6);
        $data['new_id']= 'RUN-'.$uniqueId;
        $postData=$this->input->post();
        // if(!empty($this->input->post('image'))){
        //upload image
        $config['upload_path']   = './assets/uploads/'; 
        $config['allowed_types'] = 'gif|jpg|png'; 
        $config['max_size']      = 100; 
        $config['max_width']     = 1624; 
        $config['max_height']    = 768;  
        $this->load->library('upload', $config);
           
        if ( ! $this->upload->do_upload('image')) {
           $data['error'] = array('error' => $this->upload->display_errors()); 
        }
           
        else { 
           $filename =  $this->upload->data('file_name'); 
        } 
       
        
        $result=$data['user_details']= $this->requestHandler->saveRequest($postData,$filename);
        if($result) {
        $data['message']="Successful";
        $this->load->view('main',$data);
        } 
        else {
        $data['message']="Failed";
        $this->load->view('main',$data);
        
        }

        //print_r($postData);
        
    }
  
  
  
    
    public function makeAppointment($message=FALSE)
    {
     

        $data['title'] = "Make Apppointment";
        $data['view'] = "add_appointment";
        $data['heading'] = "Make Appointmnet";
        if(!empty($message)){
        $data['message']=$message;
        }
        $this->load->view('main',$data); 
        
    }

    public function getAppointment($message=FALSE)
    {
        $data['doctors']= $this->employeeHandler->get_doctor();
        $data['appointments'] = $this->requestHandler->get_appointments();
        $postData = $this->input->post();
        $id = $this->input->post('id');
    
        $data['user_details']= $this->requestHandler->saveAppointment($postData,$id);
        $data['message']=$message;

         $this->load->view('appoints-table',$data);
    
        
    }

    public function finalisedAppointment($message=FALSE)
    {
    
        $data['title'] = "Finalised Apppointments";
        $data['view'] = "final_appointments";
        $data['heading'] = "Finalised Appointments";
        if(!empty($message)){
        $data['message']=$message;
        }
        $this->load->view('main',$data); 
        
    }
    public function getfinalAppointment($message=FALSE)
    {
        $data['doctors']= $this->employeeHandler->get_doctor();
        $data['appointments'] = $this->requestHandler->getfinalAppointments();

        $data['message']=$message;

         $this->load->view('finalised_appoint_table',$data);
    
        
    }


    public function updateAppointment()
    {
        $data['title'] = "Make Apppointment";
        $data['view'] = "add_appointment";
        $data['heading'] = "Make Appointmnet";
        $data['doctors']= $this->employeeHandler->get_doctor();
        $postData = $this->input->post();
        $id = $this->input->post('id');
        if($postData){
        $result=$data['user_details']= $this->requestHandler->updateAppointment($postData,$id);
        $data['appointments'] = $this->requestHandler->get_appointments();
        if($result) {
         $data['message']="Successful";
         //$this->load->view('main',$data);
        } 
        else {
        $data['message']="Failed";
        } }
        else{

        //$this->load->view('main',$data); 
        }
        print_r($postData);


        
    }
    public function addDoctor()
    {
       // load view for add doctor
        $data['title'] = "Add Doctor";
        $data['view'] = "add_doctor";
        $data['heading'] = "New Doctor";
        $data['doctors'] = $this->employeeHandler->get_doctor();
        $this->load->view('main',$data);
     }
     
     public function saveDoctor()
     {
        // save doctor to database
         $doctor=$this->input->post();
         $data['title'] = "Add Doctor";
         $data['view'] = "add_doctor";
         $data['heading'] = "New Doctor";
         $data['message'] = $this->employeeHandler->save_doctor($doctor);
         $data['doctors'] = $this->employeeHandler->get_doctor();
         $this->load->view('main',$data);
      }
      public function updateDoctor()
      {
         // save doctor to database
          $id = $this->input->post('id');
          $doctor=$this->input->post();
          $data['title'] = "Add Doctor";
          $data['view'] = "add_doctor";
          $data['heading'] = "New Doctor";
          $data['message'] = $this->employeeHandler->update_doctor($doctor,$id);
          $data['doctors'] = $this->employeeHandler->get_doctor();
          $this->load->view('main',$data);
       }
     public function scheduleDoctors()
     {
         $data['title'] = "Schedule Doctor";
         $data['view'] = "schedule_doctors";
         $data['heading'] = "Schedule  Doctors";
         $data['doctors'] = $this->employeeHandler->get_doctor();
         $data['schedules'] = $this->employeeHandler->monthlyDoctors();
         
         $this->load->view('main',$data);
      }
     public function scheduleDoctor()
    {   
        $data['title'] = "Schedule Doctor";
        $data['view'] = "schedule_doctors";
        $data['heading'] = "Schedule  Doctors";
        $date=$this->input->post('date');
        $doctors=$this->input->post('doctors');

        $insert=array();
        foreach ($doctors as $doctor) {
        
        $prepare['doctor_id']=$doctor;
        $prepare['date']=$date;
        $prepare['entry_id']=$date.'-'.$doctor;
        array_push($insert,$prepare);
        
        }
       //print_r($insert);
        $data['doctors'] = $this->employeeHandler->get_doctor();
        $data['schedules'] = $this->employeeHandler->monthlyDoctors();
        $data['message'] = $this->employeeHandler->scheduleDoctor($insert);
       
       // print_r($data);
         
        $this->load->view('main',$data);
     }
    public function newdoctor()
    {
        $postData= $this->input->post();
       // print_r($postData);
        $data['title'] = "Add Doctor";
        $data['view'] = "add_doctor";
        $data['heading'] = "New Doctor";
    
        if(empty($this->input->post('mobile'))){
            $data['message']="Failed";
            $this->load->view('main',$data);
        }
        elseif (empty($postData->name)) {
            $data['message']="Failed";
            $this->load->view('main',$data);
        }
    
        else {
        $result = $this->requestHandler->add_doctor($postData);
        if($result) {
            $data['message']="Succesful";
            $this->load->view('main',$data);
          } 
        else {
            $data['message']='Failed';
            $this->load->view('main',$data);
        }
      }
        
    }
    public function getMessages($requestId){
        
        $data['messages'] = $this->requestHandler->getMessages($requestId);
        return $data;
       }
    public function replyMessages(){
        $data['title'] = "Make Apppointment";
        $data['view'] = "add_appointment";
        $data['heading'] = "Make Appointmnet";
        $data['doctors']= $this->employeeHandler->get_doctor();
        $data['appointments'] = $this->requestHandler->get_appointments();
        $postData = $this->input->post();
        $data['message'] = $this->requestHandler->replyMessages($postData);
        $this->load->view('main',$data); 
       
    }
    public function users(){
        $data['title'] = "Manage Users";
        $data['view'] = "manage_users";
        $data['heading'] = "Manage Users";
        $postData= $this->input->post();
        
        if(!empty($this->input->post('password'))){
        $data['message'] = $this->requestHandler->new_user($postData);
        }
        $data['userdata'] = $this->requestHandler->getUsers();
        //print_r($data['users']);
      $this->load->view("main",$data);
        
    }
    public function updateuser(){
        $data['title'] = "Manage Users";
        $data['view'] = "manage_users";
        $data['heading'] = "Manage Users";
        $postData= $this->input->post();
        
        if(!empty($this->input->post('uuid'))){
        $data['message'] = $this->requestHandler->updateUsers($postData);
        }
        $data['userdata'] = $this->requestHandler->getUsers();
        //print_r($data['users']);
      $this->load->view("main",$data);
        
    }
    public function changePwd(){
        $data['title'] = "Change Password";
        $data['view'] = "change_password";
        $data['heading'] = "Change Password";
        if(!empty($this->input->post('password'))){
        $postData= $this->input->post();
        $changepwd['message'] = $this->requestHandler->changepwd($postData);
        }
        $this->load->view("main",$data);
    }
    public function userLogs(){
        $data['title'] = "Users Logs";
        $data['view'] = "user_logs";
        $data['heading'] = "User Logs";
        if($this->input->post('clearlogs')){
                            
            $data['message']=$this->db->Delete('logs');
            }
        $data['userslogs'] = $this->requestHandler->getLogs();
        $this->load->view("main",$data);
    }
    public function reports(){
        $data['title'] = "Reports";
        $data['view'] = "home_reports";
        $data['heading'] = "Reports";
        
        $this->load->view("main",$data);
    }
    public function app_notifications(){

    }
    public function billing(){
        $data['title'] = "Billing";
        $data['view'] = "billing";
        $data['heading'] = "Billing";
        $postdata=$this->input->post();
        
        $bill=$this->input->post('bill');
        $description=$this->input->post('description');
        $appointment_id=$this->input->post('appointment_id');
        $patient=$this->input->post('patient_id');
        if($this->input->post('bill_status')==1){
            $bill_status=$this->input->post('bill_status');
        }
        else{
            $bill_status=0;

        }
       $final= array();
         for ($x = 0; $x < count($bill); $x++ ) {
         $insert=array("amount" => $bill[$x],
                        "description" => $description[$x],
                        "posting_date" => $this->input->post('posting_date'),
                        "appointment_id" => $appointment_id,
                        "patient_id" => $patient,
                        "posted_by" => $_SESSION['name'],
                        "bill_status"=>$bill_status
         );
         array_push($final,$insert);
       
         }
         if(!empty($this->input->post('appointment_id'))){
         $data['message'] = $this->employeeHandler->post_bill($final,$appointment_id);
        
        }

        //print_r($final);
        
       $data['appointments'] = $this->requestHandler->get_appointments();
        $this->load->view("main",$data);      
    
   }
   
    Public function print_bill($appointment_id)
	{


	     $this->load->library('M_pdf');

        $data['bill'] = $this->employeeHandler->print_bill($appointment_id);
        
        //print_r($data);

		$html=$this->load->view('print_bill',$data,true);
      
          $patient=$data['bill'][0]->name;
          $date=$data['bill'][0]->posting_date;
         
        $filename=$patient."_Bill_". $date.".pdf";
        //print_r($filename);


        ini_set('max_execution_time',0);
        $PDFContent = mb_convert_encoding($html, 'UTF-8', 'UTF-8');


        ini_set('max_execution_time',0);
        $this->m_pdf->pdf->WriteHTML($PDFContent); 
        $this->m_pdf->pdf->Output($filename,'I');


 }
  public function diagnosis(){
    $data['title'] = "Diagnosis";
    $data['view'] = "diagnose";
    $data['heading'] = "Diagnosis";
    $tooth=$this->input->post('tooth_number');
    $pat=$this->input->post('patient');
    $app=$this->input->post('appointment_id');
    $exam=$this->input->post('examination');
    $diag=$this->input->post('diagnosis');
    $treat=$this->input->post('treatment');
    
    
    $diagnois= array('entry_id'=>date('Y-m-d').'App'.$app,'appointment_id'=>$app,	'examination'=>$exam,	'patient_id'=>$pat,	'diagnosis'=>$diag,	'treatment'=>$treat);

    $final_tooth=array();
    foreach($tooth as $key=>$value){
        
        $tooth= array('patient_id'=>$pat,'tooth_number'=>$value,'appointment_id'=>$app,'date'=>date('Y-m-d'));
        
        array_push($final_tooth,$tooth);
    }
    
    
   if(!empty($this->input->post('appointment_id'))){
   $data['message'] = $this->requestHandler->post_diagnosis($diagnois,$final_tooth);
    
   }
   if($this->uri->segment(3)=='previous'){
    $data['appointments'] = $this->requestHandler->getfinalAppointments();
   }
   else{
   $data['appointments'] = $this->requestHandler->get_appointments();
   }
    $this->load->view("main",$data);

   
  }
  public function manage_billing(){
    $data['title'] = "Manage Bills";
    $data['view'] = "manage_bill";
    $data['heading'] = "Manage Bill";
    $postdata=$this->input->post('appointment_id');
     if(!empty($this->input->post('appointment_id'))) {
     $data['message'] = $this->employeeHandler->update_bill($postdata);
    
    }
    
    
    $data['bill'] = $this->employeeHandler->get_bill();
   $this->load->view("main",$data);

   
  }

  public function billItems($id){
      $data['items']=$this->employeeHandler->billitems($id);
  return $data;
  }

    
  
  Public function print_diagnosis($appointment_id)
  {


       $this->load->library('M_pdf');

      $data['assessment'] = $this->requestHandler->get_diagnosis($appointment_id);
      
      //print_r($data);

      $html=$this->load->view('print_diagnosis',$data,true);
    
        $patient=$data['assessment'][0]->name;
        $date=$data['assessment'][0]->date_diagnosed;
       
      $filename=$patient."_Assesment_". $date.".pdf";
      //print_r($filename);


      ini_set('max_execution_time',0);
      $PDFContent = mb_convert_encoding($html, 'UTF-8', 'UTF-8');


      ini_set('max_execution_time',0);
      $this->m_pdf->pdf->WriteHTML($PDFContent); 
      $this->m_pdf->pdf->Output($filename,'I');


    }
//reports
   public function patient_list(){
    $data['title'] = "Patient List";
    $data['view'] = "patientslist";
    $data['heading'] = "Patient List";
       $query=$this->db->query("SELECT patient_id,mobile,address, name as patient, email as useremail FROM request  where patient_id!='' order by requested_date ASC, name ASC");
   $data['patients'] = $query->result();
   $this->load->view("main",$data);
   }
   public function returning_patient(){
    $data['title'] = "Patient List";
    $data['view'] = "returningRequest";
    $data['heading'] = "Patients";
       $query=$this->db->query("SELECT patient_id,mobile,address, name as patient, email as useremail FROM request  where patient_id!='' order by requested_date ASC, name ASC");
   $data['patients'] = $query->result();
   $this->load->view("main",$data);
   }
  
   public function stafflist_list(){
    $data['title'] = "Staff List";
    $data['view'] = "stafflist";
    $data['heading'] = "Staff List";
    $query=$this->db->query("SELECT * FROM `doctors`");
   $data['stafflist']=$query->result();
   $this->load->view("main",$data);
   }
   public function outstanding_payment(){
    $data['title'] = "Out Standing Payment";
    $data['view'] = "outstanding";
    $data['heading'] = "Outstanding Bills";
    $query=$this->db->query("SELECT sum(amount) as totalbill,description, posting_date,bill.appointment_id,name,mobile,bill_status,partial_payment,posted_by FROM bill, appointments,request where bill_status='0' and appointments.id=bill.appointment_id and request.id=appointments.request_id group by appointment_id");
   $data['payments']=$query->result();
   $this->load->view("main",$data);
}
public function sales(){
    $data['title'] = "Sales Report";
    $data['view'] = "sales_report";
    $data['heading'] = "Sales Report";
    if(!empty($this->input->post('dateFrom'))){
    $from= $this->input->post('dateFrom');
    $to= $this->input->post('dateTo');

    $filter="and posting_date between '$from' and '$to'";
    }
    else{
     $filter="";   
    }
    
    $query=$this->db->query("SELECT amount as totalbill,bill.patient_id,description, posting_date,bill.appointment_id,name,mobile,bill_status,partial_payment,posted_by FROM bill, appointments,request where  appointments.id=bill.appointment_id and request.patient_id=appointments.patient_id $filter order by posting_date DESC");
   $data['sales']=$query->result();
   $this->load->view("main",$data);
}
public function userprofile($id){
    $data['title'] = "Profile";
    $data['view'] = "userprofile";
    $data['heading'] = "User Profile";
       $query=$this->db->query("SELECT Distinct * FROM `request` WHERE patient_id='$id'");

   $data['profile'] = $query->result();

   //total appointments
   $query1=$this->db->query("SELECT count(id) as requestno FROM `appointments` WHERE patient_id='$id'");

   $data['requests'] = $query1->result();

   //diagnosis
   $query2=$this->db->query("SELECT diagnosis,treatment,doctors.name as doctor,date_diagnosed FROM diagnosis left join appointments on diagnosis.appointment_id=appointments.id left join request on appointments.patient_id=request.patient_id left join doctors on appointments.doctor=doctors.id where request.mobile='$id' order by diagnosis.id DESC LIMIT 50");

   $data['diagnosis'] = $query2->result();


   //print_r($data);
  $this->load->view("main",$data);
   }
public function scheduleAppointment(){
    if(!empty($this->input->post('chief_complaint'))){
        $postData=$this->input->post();
        $data=array(
            'patient_id' => $postData['patient_id'],
            'chief_complaint' => $postData['chief_complaint'],
            'start_date' => $postData['start_date'],
            'end_date' => $postData['start_date'],
            'allDay' => 'true',
            'status'=>0,
            'doctor'=>1
        );
        $this->requestHandler->followup_appointments($data);
        $message="Successful";
       $this->makeAppointment($message);

       
    }

}

public function variables(){
    $data['title'] = "Settings";
    $data['view'] = "variables";
    $data['heading'] = "System Variables";
    $data['settings'] = $this->requestHandler->settings();
    $postdata=$this->input->post();
    $data['message'] = $this->requestHandler->update_variables($postdata);
   $this->load->view("main",$data);
}

   
   
   


}
    


