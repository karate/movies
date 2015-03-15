<?php

class Message extends AppModel {

	public $validate = array(
        'user' => array(
	        'rule' => array('datetime'),
	        'message' => 'Please enter a valid date and time.'
	    )
    );

    public $order = array("Message.date" => "desc");
}

?>