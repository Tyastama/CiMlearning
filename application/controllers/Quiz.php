<?php
defined('BASEPATH') OR exit('No direct script allowed');

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Quiz extends REST_Controller{
	/*----------------------------------------CONSTRUCTOR----------------------------------------*/
	function __construct($config = 'rest'){
		parent::__construct($config);
		$this->load->database();
	}

	/*----------------------------------------GET KONTAK----------------------------------------*/
	function index_get(){
		$id = $this->get('id_quiz');
		
		if($id == ''){
			$quiz = $this->db->get('quiz')->result();
		}
		else{
			$this->db->where('id_quiz', $id);
			$quiz = $this->db->get('quiz')->result();
		}

		$this->response($quiz, 200);
	}

	function index_post(){
		$data = array(
			'id_quiz'	=>	$this->post('id_quiz'),
			'soal'	=>	$this->post('soal'),
			'pilihan_1'	=>	$this->post('pilihan_1'),
			'pilihan_2'	=>	$this->post('pilihan_2'),
			'pilihan_3'	=>	$this->post('pilihan_3'),
			'pilihan_4'	=>	$this->post('pilihan_4'),
			'pilihan_5'	=>	$this->post('pilihan_5'),
			'jawaban'	=>	$this->post('jawaban'),
			'idmakul'	=>	$this->post('idmakul'),
		);
		$insert = $this->db->insert('quiz', $data);
		
		if($insert){
			$this->response($data, 200);
		}
		else{
			$this->response(array('status' => 'fail', 502));
		}
	}

	function index_put(){
		$id = $this->put('id_quiz');
		$data = array(
			'id_quiz'	=>	$this->put('id_quiz'),
			'soal'	=>	$this->put('soal'),
			'pilihan_1'	=>	$this->put('pilihan_1'),
			'pilihan_2'	=>	$this->put('pilihan_2'),
			'pilihan_3'	=>	$this->put('pilihan_3'),
			'pilihan_4'	=>	$this->put('pilihan_4'),
			'pilihan_5'	=>	$this->put('pilihan_5'),
			'jawaban'	=>	$this->put('jawaban'),
			'idmakul'	=>	$this->put('idmakul'),
		);
		
		$this->db->where('id_quiz', $id);
		$update = $this->db->update('quiz', $data);

		if($update){
			$this->response($data, 200);
		}
		else{
			$this->response(array('status' => 'fail'), 502);
		}
	}

	function index_delete(){
		$id = $this->delete('id_quiz');

		$this->db->where('id_quiz', $id);
		
		$delete = $this->db->delete('quiz');

		if($delete){
			$this->response(array('status' => 'success'), 201);
		}
		else{
			$this->response(array('status' => 'fail'), 502);
		}
	}
}
?>
