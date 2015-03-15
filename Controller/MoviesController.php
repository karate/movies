<?php

class MoviesController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session', 'Paginator');

	public function index() {

		$this->Paginator->settings = $this->paginate;
		$this->Paginator->settings['limit'] = 20;

	    // similar to findAll(), but fetches paged results
		$not_arranged = $this->Paginator->paginate(
			'Movie',
			array('Screening.date' => '')
			);

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

	public function search() {

		$query = null;
		$year = null;

		if (isset($this->request->query['q'])) {
			$query = $this->request->query['q'] ? $this->request->query['q'] : null;
		}
		if (isset($this->request->query['y'])) {
			$year = $this->request->query['y'] ? $this->request->query['y'] : null;
		}

		// Return empty results, if no filters were selected
		if (!isset($this->request->query['q']) && !isset($this->request->query['y'])) {
			$this->set('results', null);
		}
		else {
			// Manualy validate title
			if (
				!is_null($query) && 
				(strlen($query) < 3) || 
				(strlen($query) > 20)
				) {
				$this->Movie->validationErrors['title'][0] = 'Search term must be between 3 and 20 characters';
			}

			// Use model to validate year
			$this->Movie->set(array('Movie' => array ('year' => $year)));
			if (!$this->Movie->validates()) {
				$errors = $this->Movie->validationErrors;
				foreach ($errors as $rule => $error) {
					$this->Session->setFlash($error[0]);
				}

				$this->set('results', array());
			}
			else {
				$conditions = array();
				if ($query) {
					$conditions[] = array(
						'OR' => array(
							'LOWER(Movie.title) LIKE' => strtolower("%$query%"),
							)
						);
				}

				if ($year) {
					$conditions[] = array('Movie.year' => $year);
				}

				$results = $this->Movie->find('all', array(
					'conditions' => $conditions
				));

				$this->set('results', $results);
			}
		}

	}

	public function view($id = NULL) {
		$this->layout = 'ajax';

		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}

		$movie = $this->Movie->findById($id);
		if (!$movie) {
			throw new NotFoundException(__('Invalid movie'));
		}
		$this->set('movie', $movie);
		$this->render('/Elements/movie-popup');
	}

	public function add() {
		if ($this->request->is('post')) {

				// Set movie poster data
			$data = $this->request->data;
			$this->Movie->fix_poster($data);

			$this->Movie->create();

	      // Save movie
			if ($this->Movie->save($data)) {
	      	// Download Image and generate thumbnail
				if ($data['Movie']['poster']) {
					$this->Movie->save_poster($data);
				}

				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to save your movie.'));
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		    // first delete all screenings with this movie
		$this->loadModel('Screening');

		$this->Screening->deleteAll(array(
			'Screening.movie_id' => $id
			));

		$this->Movie->delete($id);

		$this->redirect(array('controller' => 'movies', 'action' => 'index'));
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

	private function _create_thumb($img_path, $filename, $width) {
		$src_img = imagecreatefromjpeg($img_path . '/' . $filename);
		$src_w = imageSX($src_img);
		$src_h = imageSY($src_img);

		$dst_w = $width;
		$dst_h = ($src_h / $src_w) * $dst_w;

		$dst_img = ImageCreateTrueColor($dst_w, $dst_h);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		imagejpeg($dst_img, $img_path . '/thumb_' . $filename); 
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}

	function _flash($message,$type='message') {
		$messages = (array)$this->Session->read('Message.multiFlash');
		$messages[] = array(
			'message'=>$message,
			'layout'=>'default',
			'element'=>'default',
			'params'=>array('class'=>$type),
			);
		$this->Session->write('Message.multiFlash', $messages);
	}
}

?>
