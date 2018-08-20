<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("testing/testing_model");
		$this->load->helper('url');
	}

	function contoh(){
		$this->viewparams['website_title']   = "Testing program - ".$this->settings['app_website_title'];
		parent::view("contoh");
	}

	function contoh_form(){
		parent::view("contoh_form");
	}

	function dosubmit()
	{

		$send_to 		= $this->input->post('send_to');
		$date 			= $this->input->post('date');
		$email 			= $this->input->post('email');
		$attn_to 		= $this->input->post('attn_to');
		$subject 		= $this->input->post('subject');
		$created_by 	= $this->input->post('created_by');
		$jabatan 		= $this->input->post('jabatan');

		$field_name 	= ($this->input->post('field_name'))?implode("|",$this->input->post('field_name')):"";

		$field_name2 	= ($this->input->post('field_name2'))?implode("|",$this->input->post('field_name2')):"";

		$field_rate	 	= ($this->input->post('field_rate'))?implode("|",$this->input->post('field_rate')):"";

		$field_rate2	= ($this->input->post('field_rate2'))?implode("|",$this->input->post('field_rate2')):"";

		$field_remarks 	= ($this->input->post('field_remarks'))?implode("|",$this->input->post('field_remarks')):"";

		$field_remarks2 = ($this->input->post('field_remarks2'))?implode("|",$this->input->post('field_remarks2')):"";

		$field_remarks3 = ($this->input->post('field_remarks3'))?implode("|",$this->input->post('field_remarks3')):"";



		$this->load->library('form_validation');

		$this->form_validation->set_rules('send_to', 'lang:lname', 'trim|required');
		//$this->form_validation->set_rules('email', 'lang:lemail', 'trim|required|valid_email');
		//$this->form_validation->set_rules('category', 'lang:lcategory', 'trim|required');
		//$this->form_validation->set_rules('tentang', 'lang:lsubject', 'trim|required');
		//$this->form_validation->set_rules('question', 'lang:Question', 'trim|required');

		$this->form_validation->set_error_delimiters('', '');

		$is_error = false;
		//$redirect = base_url();
		$message = array();
		if ($this->form_validation->run() == FALSE)
		{
			$is_error = true;
			if(form_error('send_to'))
				$message[] = form_error('send_to');


		}

		$verifikasi = $this->testing_model->getInfo($email,$send_to);

		if(!$is_error)
		{

			if(($email==$verifikasi[0]->email_sender)||($send_to==$verifikasi[0]->kepada))
			{
				$is_error = true;
				$message[] = "Sudah pernah dikirim";
			}
			else
			{
				$values = array(
					"send_to"			=> $send_to
					,"email"			=> $email
					,"attn_to"			=> $attn_to
					,"subject"			=> $subject
					,"created_by" 		=> $created_by
					,"jabatan" 			=> $jabatan
					,"field_name"		=> $field_name
					,"field_name2"		=> $field_name2
					,"field_rate"		=> $field_rate
					,"field_rate2"		=> $field_rate2
					,"field_remarks"	=> $field_remarks
					,"field_remarks2"	=> $field_remarks2
					,"field_remarks3"	=> $field_remarks3
					,"date"				=> date("Y-m-d")
				);



				$input = $this->db->insert("decms_testing", $values);

				//-- send email question contact us
				if($input)
				{
					$this->directed_array();
					$message[] = "Berhasil";
				}
				else
				{
					$is_error = true;
					$message[] = "Ada Kesalahan input DB";
				}
			}

		}
		$result = array(
			"message"	=> implode("\r\n",$message)
			,"error"	=> $is_error
			,"redirect"	=> $redirect

		);

		echo json_encode($result);

	}

	function directed_array(){

		$this->load->library('email');
		$mail_config = $this->settings;

		$send_to 		= $this->input->post('send_to');
		$email 		= $this->input->post('email');
		$attn_to 		= $this->input->post('attn_to');
		$subject 		= $this->input->post('subject');
		$created_by 	= $this->input->post('created_by');
		$jabatan 		= $this->input->post('jabatan');
		$email2 		= "cc.fikri@gmail.com";

		$field_name = $this->input->post('field_name');
		$field_name2 = $this->input->post('field_name2');
		$field_rate	 	= $this->input->post('field_rate');
		$field_rate2	 	= $this->input->post('field_rate2');
		$field_remarks = $this->input->post('field_remarks');
		$field_remarks2 = $this->input->post('field_remarks2');
		$field_remarks3 = $this->input->post('field_remarks3');

		$this->viewparams['send_to']		= $send_to;
		$this->viewparams['attn_to']		= $attn_to;
		$this->viewparams['subject']		= $subject;
		$this->viewparams['created_by']		= $created_by;
		$this->viewparams['jabatan']		= $jabatan;
		$this->viewparams['field_name']		= $field_name;
		$this->viewparams['field_name2']		= $field_name2;
		$this->viewparams['field_rate']		= $field_rate;
		$this->viewparams['field_rate2']		= $field_rate2;
		$this->viewparams['field_remarks']	= $field_remarks;
		$this->viewparams['field_remarks2']	= $field_remarks2;
		$this->viewparams['field_remarks3']	= $field_remarks3;

		$email_message = parent::view("hasil",true);

		//Load the library
	    $this->load->library('html2pdf');

	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename(''.$send_to.'.pdf');
	    $this->html2pdf->paper('a4', 'portrait');

		//Load html view
	    $this->html2pdf->html(parent::view("hasil",true));

	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('save')) {

			$this->email->set_newline("\r\n");
			$this->email->to($email2);
			$this->email->bcc($email);

			$this->email->from($mail_config['mail_activation_sender_mail'], $mail_config['mail_contact_us']);
			$this->email->subject($subject);
			$this->email->message($email_message);

			$this->email->attach($path);

			$this->email->send();


	    }


	}






}
