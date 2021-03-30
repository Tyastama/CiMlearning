<?php
defined('BASEPATH') OR exit('No direct script allowed');

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Makul extends REST_Controller{
	/*----------------------------------------CONSTRUCTOR----------------------------------------*/
	function __construct($config = 'rest'){
		parent::__construct($config);
		$this->load->database();
	}

	/*----------------------------------------GET KONTAK----------------------------------------*/
	function index_get(){
		$id = $this->get('id');
		
		if($id == ''){
			$makul = $this->db->get('makul')->result();
		}
		else{
			$this->db->where('id', $id);
			$makul = $this->db->get('makul')->result();
		}

		$this->response($makul, 200);
	}

	function index_post(){
		$data = array(
			'id'	=>	$this->post('id'),
			'makul'	=>	$this->post('makul'),
		);
		$insert = $this->db->insert('makul', $data);
		
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
			'makul'	=>	$this->put('makul'),
		);
		
		$this->db->where('id', $id);
		$update = $this->db->update('makul', $data);

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
		
		$delete = $this->db->delete('makul');

		if($delete){
			$this->response(array('status' => 'success'), 201);
		}
		else{
			$this->response(array('status' => 'fail'), 502);
		}
	}
}
?>
