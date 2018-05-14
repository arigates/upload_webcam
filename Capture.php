<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Capture extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('capture');
	}

	public function save()
	{
		$username = $this->input->post('username', true);
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$image = $this->input->post('image');
		$image = str_replace('data:image/jpeg;base64,','', $image);
		$image = base64_decode($image);
		$filename = 'image_'.time().'.png';
		file_put_contents(FCPATH.'/uploads/'.$filename,$image);
		$data = array(
			'username' => $username,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'image' => $filename,
		);

		$this->load->model('user');
		$res = $this->user->insert($data);
		echo json_encode($res);
	}

}

/* End of file Capture.php */
/* Location: ./application/controllers/Capture.php */