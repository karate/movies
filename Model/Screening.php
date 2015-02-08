<?php

class Screening extends AppModel {
	public $belongsTo = array('Movie');

	public $validate = array(
        'date' => array(
	        'rule' => array('datetime'),
	        'message' => 'Please enter a valid date and time.'
	    )
    );

    public $order = array("Screening.date" => "asc", "Screening.id" => "desc");
}

?>