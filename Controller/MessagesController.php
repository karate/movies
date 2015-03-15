<?php

class MessagesController extends AppController {
	public function index() {
		if ($this->request->is('post')) {
			$data = $this->request->data;	

			$data['Message']['user'] = h($data['Message']['user']);
			$data['Message']['message'] = h($data['Message']['message']);

			$this->Message->create();

      // Save message
			if ($this->Message->save($data)) {
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to save your movie.'));
		}
	}

	public function add() {
	}

	public function get_messages($last_msg = 0) {
		$this->layout = 'ajax';

		if ($last_msg !== 0) {
			$messages = $this->Message->find('all', array(
				'conditions' => array('Message.id >' => $last_msg),
				'limit'	=> 30
			));

		}
		else {
			$messages = $this->Message->find('all');
		}

		$this->set('messages', $messages);
		$this->render('/Elements/message-list');
	}
}
?>
