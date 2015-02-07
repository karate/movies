<?php

class ScreeningsController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session', 'RequestHandler');

	public function index() {

		$this->set('screenings', $this->Screening->find('all'));
	}

	public function date($date) {
		print_r($date); 
	}


}

?>
