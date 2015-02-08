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

	public function add() {

		if ($this->request->is('post')) {

			$data = $this->request->data;
            $poster_url = $data['Movie']['poster'];
            $poster_filename = $data['Movie']['imdb_ID'] . '.jpg';
            $data['Movie']['poster'] = $poster_filename;

            $this->Movie->create();
            
			App::uses('HttpSocket', 'Network/Http');
			App::uses('File', 'Utility');

			$HttpSocket = new HttpSocket();

            if ($this->Movie->save($data)) {
            		$poster_data = $HttpSocket->get($poster_url, array(), array('redirect' => true));
            		/*$file = $poster_url;
				    $newfile = 'img/posters/' . $poster_filename;
					copy($file, $newfile);
*/
				    
            		$file = new File('img/posters/' . $poster_filename, true, 0777);
            		$file->write($poster_data);
					
                $this->Session->setFlash(__('Your Movie has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to save your movie.'));
        }
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
