<?php

class MoviesController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session', 'RequestHandler');

	public function index() {
		$this->set('movies', $this->Movie->find('all'));
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
}

?>
