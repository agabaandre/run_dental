<?php 

Class Auth extends CI_Model {

    public function authenticate($userdata) {
        $username = $userdata['username'];
        $password = $userdata['password'];
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->where('status','1');
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows()>0) {
            $row = $query->row();
            $userInfo = array(
                "name"=> $row->name,
                "uuid"=>$row->uuid,
                "usertype" => $row->usertype,
            );

            return $userInfo;

        } else {
            return 0;
        }

    }
    public function validate($apikey) {
        
        $this->db->where('apikey', $apikey);
        $this->db->where('status','1');
        $this->db->from('users');
        $query = $this->db->get();

        if($query->num_rows() === 1) {
            $row = $query->row();
            $userInfo = array(
                "name"=> $row->name,
            );

            return TRUE;

        } else {
            return FALSE;
        }

    }
    public function log($apikey,$action) {
        if (!empty($action)){
        $this->db->query ("INSERT into logs values(NULL,'$apikey',NULL,'$action')");
        }

    }
}