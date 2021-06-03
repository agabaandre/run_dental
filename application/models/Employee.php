<?php


class Employee extends CI_Model
{
   
    public function get_doctor(){
        //$this->db->where ('flag',1);
        $this->db->order_by('name','ASC');
        $query=$this->db->get('doctors');
        return $query->result();
    
    }
    public function save_doctor($data){
        $query=$this->db->insert('doctors',$data);
        if ($query){
        return "Successful";
        }
        else{
        return "Failed";
        }
    }
    public function update_doctor($data,$id){

        $this->db->where('id', $id);
        $query=$this->db->update('doctors', $data);
        if ($query){
        return "Successful";
        }
        else{
        return "Failed";
        }
    }
    public function get_availabledoctors($date){
       
        $query=$this->db->query("SELECT doctors.id,doctors.name,doctors.cadre FROM doctors, schedules where doctors.id=schedules.doctor_id and schedules.date like'$date' ");
        if ($query){
        return $query->result();
        }
        else{
        return array();
        }
    }
    public function monthlyDoctors(){
        $dt = new DateTime();
        $dt->sub(new DateInterval('P1D'));
            //yesterday
        $date=$dt->format('Y-m-d');
        //after a month
        $new_date=strtotime("20 days", strtotime($date));
        $dateto = date("Y-m-d", $new_date);
            $query=$this->db->query("SELECT doctors.id,doctors.name,doctors.cadre,schedules.date FROM doctors, schedules where doctors.id=schedules.doctor_id and schedules.date BETWEEN '$date' AND '$dateto' order by schedules.date ASC");
        if ($query){
        return $query->result();
        }
        else{
        return array();
        }
    }
    public function scheduleDoctor($insert){
       
        $query=$this->db->insert_batch('schedules',$insert);
        if ($query){
        return "Successful";
        }
        else{
        return "Failed";
        }
    }
   
    public function get_services(){
        $query=$this->db->get('services');
        if ($query){
        return $query->result();
        }
        else{
        return array();
        }
    }
    public function add_services($data){
        $data=array(
            'name' => $data['name'],
            'img_url' => $data['img_url'],
            'description' =>$data['description'],
            'price' =>$data['price'],
            'type' =>$data['type']
        );
        $query=$this->db->insert('services',$data);
        if ($query){
        return 'Successful';
        }
        else{
        return 'Failed';
        }
    }
    public function update_services($data){
        $datas=array(
            'name' => $data['name'],
            'img_url' => $data['img_url'],
            'description' => $data['description'],
            'price' => $data['price']
        );
        $this->db->where('id',$data['sid']);
        $query=$this->db->update('services',$datas);
        if ($query){
            return 'Successful';
            }
            else{
            return 'Failed';
        }
    }
    public function delete_services($data){
        $this->db->where('id',$data['id']);
        $query=$this->db->Delete('services');
        if ($query){
            return 'Successful';
            }
            else{
            return 'Failed';
        }
    }
 
    public function add_clinic($data){
        $data=array(
            'clinic' => $data['clinic'],
     
        );
        $query=$this->db->insert('clinic',$data);
        if ($query){
        return 'Successful';
        }
        else{
        return 'Failed';
        }
    }
    public function update_clinic($data){
        $datas=array(
            'clinic' => $data['clinic'],
            
        );
        $this->db->where('id',$data['id']);
        $query=$this->db->update('clinic',$datas);
        if ($query){
            return 'Successful';
            }
            else{
            return 'Failed';
        }
    }
    public function delete_clinic($data){
        $this->db->where('id',$data['id']);
        $query=$this->db->Delete('clinic');
        if ($query){
            return 'Successful';
            }
            else{
            return 'Failed';
        }
    }
    public function post_bill($data,$appointment_id){
  
        $query1=$this->db->query("UPDATE `appointments` SET `status` = '2' WHERE `appointments`.`id` = $appointment_id");
        $query=$this->db->insert_batch('bill',$data);
        if ($query){
            return 'Successful';
            }
            else{
            return 'Failed';
        }
    }
    public function get_bill(){
       
        $query=$this->db->query("SELECT SUM(amount)as amount ,description, bill.patient_id as patient_id, posting_date, bill.appointment_id,name, mobile, bill_status,partial_payment,posted_by FROM bill left join appointments on appointments.id=bill.appointment_id left join request on request.patient_id=appointments.patient_id group by bill.appointment_id
        ");
        if ($query){
            return $query->result();
            }
            else{
            return 'Failed';
        }
    }
    public function print_bill($id){
       
        $query=$this->db->query("SELECT amount ,description, bill.patient_id as patient_id, posting_date,bill.appointment_id,name,mobile,bill_status,partial_payment,posted_by FROM bill left join appointments on appointments.id=bill.appointment_id left join request on request.patient_id=appointments.patient_id where bill.appointment_id='$id'
        ");
        if ($query){
            return $query->result();
            }
            else{
            return 'Failed';
        }
    }
    public function getProdlist($searchTerm){
        $query=$this->db->query("SELECT name as product,price from services where name like'$searchTerm%'");
        $data=$query->result();
    return $data;
    }
    public function update_bill($id){
       
        $query=$this->db->query("UPDATE `bill` SET `bill_status` = '1' WHERE `bill`.`appointment_id` = '$id'");
        if ($query){
            return 'Successful';
            }
            else{
            return 'Failed';
        }
    }

   }
