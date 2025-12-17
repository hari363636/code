<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	public function input_values()
	{
		$data = array(
			'city_id' 			=> $this->input->post('city_id', true),
			's_name' 			=> $this->input->post('s_name', true),
			's_mobileno' 		=> $this->input->post('s_mobileno', true),
			's_email' 			=> $this->input->post('s_email', true),
			'duration' 			=> $this->input->post('duration', true),
			'service_amt' 		=> $this->input->post('service_amt', true),
			'status'			=> $this->input->post('status', true),
			'courier_amt' 		=> $this->input->post('courier_amt', true),
			'vertype' 			=> $this->input->post('vertype', true),
			'date_verfify' 		=> $this->input->post('date_verfify', true),
			'seller' 			=> $this->input->post('seller', true),
			'pno' 			=> $this->input->post('pno', true),
			'email' 		=> $this->input->post('email', true),
			'comments' 		=> $this->input->post('comments', true),
			'offname' 		=> $this->input->post('offname', true),
			'instatus' 		=> $this->input->post('instatus', true),
			'order_id' 		=> $this->input->post('order_id', true),
			'user_id' 		=> $this->input->post('user_id', true),
			'lead_id' 		=> $this->input->post('lead_id', true),
			'agent_id' 		=> $this->input->post('agent_id', true)
			
		);
		return $data;
	}


	
	
	public function update_enquriy(){
		
		$data['s_location'] 			= $this->input->post('city_id');
		$data['s_name'] 				= $this->input->post('s_name');
		$data['s_mobileno'] 			= $this->input->post('s_mobileno');
		$data['s_email'] 				= $this->input->post('s_email');
		$data['duration'] 				= $this->input->post('duration');
		$data['service_amt'] 			= $this->input->post('service_amt');
		$data['courier_amt'] 			= $this->input->post('courier_amt');
		$data['lead_verify_status'] 	= 1;
		$data['updated_date'] 			= date('Y-m-d H:i:s');
		$data['invoice_date'] 			= date('Y-m-d H:i:s');
		$data['updated_by']				= user()->id;
		$data['lead_status'] 			= $this->input->post('status');
		$id								=  $this->input->post('e_id');
		
		$this->db->where('id',$id);
		if($this->db->update('enquiry', $data)) {
			return $id;
		}
		else return false;
		
	}
	
	
	public function payments()
	{
		$this->db->where('lead_verify_status',1);
		$query = $this->db->get('enquiry');
		return $query->result();
	}

	
	public function payments_due()
	{
		$this->db->where('payment_status',0);
		$this->db->where('lead_verify_status',1);
		$query = $this->db->get('enquiry');
		return $query->result();
	}
	
	public function payments_completed()
	{
		$this->db->where('payment_status',1);
		$this->db->where('lead_verify_status',1);
		$query = $this->db->get('enquiry');
		return $query->result();
	}

	public function get_regbuyers()
	{
	    $this->db->where('role','client');
		$this->db->where('banned!=', 1);
		$query = $this->db->get('users');
		return $query->result();
	}
	
	
}
