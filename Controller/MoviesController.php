<?php

class MoviesController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session', 'RequestHandler');

	public function index() {
		$not_arranged = $this->Movie->find('all', array(
			'conditions' => array(
				'Screening.date' => ''
				)
			));

		$arranged = $this->Movie->find('all', array(
			'conditions' => array(
				'Screening.date !=' => ''
				)
			));

		$past_screenings = $this->Movie->find('all', array(
			'conditions' => array(
				'Screening.date <' => date('Y-m-d H:i')
				)
			));


		$future_screenings = $this->_arrayRecursiveDiff($arranged, $past_screenings);

		$this->set('upcoming_screenings', $future_screenings);
		$this->set('not_arranged', $not_arranged);
		$this->set('past_screenings', $past_screenings);
	}

	public function view($id = NULL) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}

		$movie = $this->Movie->findById($id);
		if (!$movie) {
			throw new NotFoundException(__('Invalid movie'));
		}
		$this->set('movie', $movie);
	}

	private function _arrayRecursiveDiff($aArray1, $aArray2) {
		$aReturn = array();

		foreach ($aArray1 as $mKey => $mValue) {
			if (array_key_exists($mKey, $aArray2)) {
				if (is_array($mValue)) {
					$aRecursiveDiff = $this->_arrayRecursiveDiff($mValue, $aArray2[$mKey]);
					if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
				} else {
					if ($mValue != $aArray2[$mKey]) {
						$aReturn[$mKey] = $mValue;
					}
				}
			} else {
				$aReturn[$mKey] = $mValue;
			}
		}
		return $aReturn;
	} 
}

?>
