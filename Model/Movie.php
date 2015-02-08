<?php

class Movie extends AppModel {
	public $hasOne = array('Screening');

	public $order = array("Screening.date" => "asc", "Movie.id" => "desc");

	public $validate = array(
		'title' => array(
            /*'required' => array(
                //'required' => true,
                'allowEmpty' => false,
                'message' => 'Please insert a title'
            ),*/
            'between' => array(
                'rule'    => array('maxLength', '100'),
                'message' => 'That\'s a very long title...'
            )
        ),
        'year' => array(
            'rule' => array('date', 'y'),
            'allowEmpty' => true,
            'message' => 'Insert a full year',
        ),
        'imdb_link' => array(
        	'rule' => array('url', true),
            'allowEmpty' => true,
            'message' => 'This is not a valid link',
        ),
        'imdb_rating' => array(
        	'between' => array(
            	'allowEmpty' => true,
            	'rule' => array('range', 0, 10),
            	'message' => 'Invalid number'
        	),
        ),
    );
}

?>