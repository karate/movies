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

			$data = $this->request->data;
            $poster_url = $data['Movie']['poster'];
            $data['Movie']['poster'] = $data['Movie']['imdb_ID'] . '.jpg';

            $poster_full_path = 'img/posters/' . $data['Movie']['imdb_ID'] . '.jpg';
            

            $this->Movie->create();
            
			App::uses('HttpSocket', 'Network/Http');
			App::uses('File', 'Utility');

			$HttpSocket = new HttpSocket();

            if ($this->Movie->save($data)) {
            		$poster_data = $HttpSocket->get($poster_url, array(), array('redirect' => true));
				    
            		$file = new File($poster_full_path, true, 0777);
            		$file->write($poster_data);

				    $this->_create_thumb('img/posters/', $data['Movie']['poster'], 100);
					
                $this->Session->setFlash(__('Your Movie has been saved.'));
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

	public function movie_info($id) {

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
}

?>
