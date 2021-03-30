<?php
defined('BASEPATH') OR exit('No direct script allowed');

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Materi extends REST_Controller{
	/*----------------------------------------CONSTRUCTOR----------------------------------------*/
	function __construct($config = 'rest'){
		parent::__construct($config);
		$this->load->database();
	}

	/*----------------------------------------GET KONTAK----------------------------------------*/
	function index_get(){
		$id = $this->get('id');
		
		if($id == ''){
			$mapel = $this->db->get('mapel')->result();
		}
		else{
			$this->db->where('id', $id);
			$mapel = $this->db->get('mapel')->result();
		}

		$this->response($mapel, 200);
	}

	function index_post(){
		$data = array(
			'id'	=>	$this->post('id'),
			'materi'	=>	$this->post('materi'),
			'kategori_mapel'	=>	$this->post('kategori_mapel'),
		);
		$insert = $this->db->insert('mapel', $data);
		
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
			'materi'	=>	$this->put('materi'),
			'kategori_mapel'	=>	$this->put('kategori_mapel'),
		);
		
		$this->db->where('id', $id);
		$update = $this->db->update('mapel', $data);

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
		
		$delete = $this->db->delete('mapel');

		if($delete){
			$this->response(array('status' => 'success'), 201);
		}
		else{
			$this->response(array('status' => 'fail'), 502);
		}
	}
}
?>
