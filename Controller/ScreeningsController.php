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

	public function ajax() {
		$this->autoRender = false;
		$raw = $this->Screening->find('all');
		$out = array();
		foreach ($raw as $idx => $scr) {
			$out[$idx] = array(
				'date' => $scr['Screening']['date'],
				'comments' => $scr['Screening']['comments'],
				'title' => $scr['Movie']['title'] . ' (' . $scr['Movie']['year'] . ')',
				'description' => $scr['Movie']['description'],
				'url' => Router::url('/')  . 'movies/view/' . $scr['Movie']['id'],
			);
		}

		return json_encode($out);
	}


}

?>
