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
		if ($upcoming_screenings) {
			$next_up = array_shift($upcoming_screenings);
		}
		else {
			$next_up = FALSE;
		}

		$this->set('next_up', $next_up);
		$this->set('upcoming_screenings', $upcoming_screenings);
		$this->set('past_screenings', $past_screenings);
		$this->set('all_screenings', $all_screenings);
	}
}

?>
