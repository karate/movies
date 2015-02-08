<?php

class CalendarsController extends AppController {
	public function index() {
		$this->loadModel('Screening');

		$upcoming_screenings = $this->Screening->find('all', 
			array('conditions' => array (
				'Screening.date >' => date('Y-m-d H:i')
				)
			)
		);

		$past_screenings = $this->Screening->find('all', 
			array('conditions' => array (
				'Screening.date <' => date('Y-m-d H:i')
				)
			)
		);

		$all_screenings = array_merge($upcoming_screenings, $past_screenings);
		$next_up = ($upcoming_screenings)? $upcoming_screenings[0]: array();

		$this->set('next_up', $next_up);
		$this->set('upcoming_screenings', $upcoming_screenings);
		$this->set('past_screenings', $past_screenings);
		$this->set('all_screenings', $all_screenings);
	}
	/*
	public $helpers = array ('Html', 'Session');
	public $components = array('Session', 'RequestHandler');


	public function view($id = NULL) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
        }

        $movie = $this->Movie->findById($id);
        if (!$movie) {
            throw new NotFoundException(__('Invalid movie'));
        }
        $this->set('movie', $movie);
	}*/
}

?>
