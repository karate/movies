<?php

class WishlistController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session', 'RequestHandler');

	public function index() {
		$this->redirect('action' => 'import');
	}

	public function import() {
		if ($this->request->is('post')) {
			$wishlist = WWW_ROOT. 'files' . DS . $this->data['movies']['wishlist']['name'];
			move_uploaded_file($this->data['movies']['wishlist']['tmp_name'], $wishlist);
			$data = $this->Movie->import($wishlist);
			pr($data); die;

           //$filename = WWW_ROOT. DS . 'documents'.DS.$this->data['posts']['doc_file']['name']; 
           //move_uploaded_file($this->data['posts']['doc_file']['tmp_name'], $filename);  
     }
 }

}

?>
