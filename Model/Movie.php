<?php

class Movie extends AppModel {
	public $hasOne = array('Screening');

	public $order = array("Screening.date" => "asc", "Movie.id" => "desc");
}

?>