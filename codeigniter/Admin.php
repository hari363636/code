<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		if (!auth_check()) {
			redirect(base_url());
		}
		
	}
	
	
	
	
	
	public function staff()
	{
		$data['user'] 	= user();  
		$data['name'] 	= $data['user']->first_name.' '.$data['user']->last_name;
		$data['staffs'] = get_staffs();
		$this->template->set('title', 'Dashboard');
		$this->template->load('back', 'contents' , 'back/admin/staffs', $data);
	}
	
	
	public function add_lead_post()
	{
		
		if (!is_admin()){
			if( !is_staff()) redirect(base_url() . 'dashboard');
		}
		
		
		$enquriy 	= $this->general_model->get_enquiry_indi($this->input->post('e_id'));
		
		$this->form_validation->set_rules('city_id',"Location", 'required|xss_clean');
		$this->form_validation->set_rules('s_name', "Seller Name", 'required|xss_clean');
		$this->form_validation->set_rules('s_mobileno', "Mobile Number", 'required|xss_clean');
		$this->form_validation->set_rules('s_email',"Email Address", 'required|xss_clean|max_length[200]');
		$this->form_validation->set_rules('duration', "Duration", 'required|xss_clean');
		$this->form_validation->set_rules('service_amt', "Service Amount", 'required|xss_clean');
		$this->form_validation->set_rules('status', "Status", 'required|xss_clean');
		if($enquriy->verification_type==3)  $this->form_validation->set_rules('courier_amt', "Courier Amount", 'required|xss_clean');
		
	
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('form_data', $this->admin_model->input_values());
			redirect(referrer());
		} else {
			
			if ($enquriy_id = $this->admin_model->update_enquriy()) {
				$enquriy 	= $this->general_model->get_enquiry_indi($this->input->post('e_id'));
				$this->email_model->send_invoice($enquriy);
				$this->notification_model->customer_notification_add($enquriy);
				$this->session->set_flashdata('success',"Lead Created Successfully!");
				redirect(base_url('manage-leads'));
			
			}else {
				$this->session->set_flashdata('form_data', $this->auth_model->input_values());
				$this->session->set_flashdata('error', "An error occurred please try again!");
				redirect(referrer());
			}
		}
	}
	
	
		
}
