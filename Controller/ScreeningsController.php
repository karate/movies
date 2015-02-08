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
				'url' => $scr['Movie']['imdb_link'],
			);
		}

		return json_encode($out);
	}

	public function delete($id) {
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    $this->Screening->delete($id);

	    $this->redirect(array('controller' => 'movies', 'action' => 'index'));
	}

	public function add() {
		$request_data = $this->request->data;
		$date = $request_data['Screening']['date'];
		$request_data['Screening']['date'] = date("Y-m-d H:i:s", strtotime($date));

		if ($this->request->is('post')) {
            $this->Screening->create();
            $this->Screening->save($request_data);
        }

        $this->redirect(array('controller' => 'movies', 'action' => 'index'));

	}
}



?>
