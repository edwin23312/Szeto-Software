<?php
class Testing_model extends CI_Model {
	var $is_count = false;
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
 	
	/* Change Comment 2 */ 
	function getInfo($email,$send_to){
		$this->db->select("decms_testing.email as email_sender");
		$this->db->select("decms_testing.send_to as kepada");
		$this->db->select("decms_testing.attn_to as attnd");
		$this->db->where("email",$email);
		$this->db->or_where("send_to",$send_to);
		$query = $this->db->get('testing');
		$result = $query->result();
	
		return $result;
	}
    
}
