<?php
defined('BASEPATH') OR exit('No direct script allowed');

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Video extends REST_Controller{
	/*----------------------------------------CONSTRUCTOR----------------------------------------*/
	function __construct($config = 'rest'){
		parent::__construct($config);
		$this->load->database();
	}

	/*----------------------------------------GET KONTAK----------------------------------------*/
	function index_get(){
		$id = $this->get('id');
		
		if($id == ''){
			$video = $this->db->get('video')->result();
		}
		else{
			$this->db->where('id', $id);
			$video = $this->db->get('video')->result();
		}

		$this->response($video, 200);
	}

	function index_post(){
		$data = array(
			'id'	=>	$this->post('id'),
			'video'	=>	$this->post('video'),
			'kategori_video'	=>	$this->post('kategori_video'),
		);
		$insert = $this->db->insert('video', $data);
		
		if($insert){
			$this->response($data, 200);
		}
		else{
			$this->response(array('status' => 'fail', 502));
		}
	}

	function index_put(){
		$id = $this->put('id');
		$data = array(
			'id'	=>	$this->put('id'),
			'video'	=>	$this->put('video'),
			'kategori_video'	=>	$this->put('kategori_video'),
		);
		
		$this->db->where('id', $id);
		$update = $this->db->update('video', $data);

		if($update){
			$this->response($data, 200);
		}
		else{
			$this->response(array('status' => 'fail'), 502);
		}
	}

	function index_delete(){
		$id = $this->delete('id');

		$this->db->where('id', $id);
		
		$delete = $this->db->delete('video');

		if($delete){
			$this->response(array('status' => 'success'), 201);
		}
		else{
			$this->response(array('status' => 'fail'), 502);
		}
	}
}
?>
