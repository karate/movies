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
                'rule'    => array('lengthBetween', 3, 50),
                'message' => 'That\'s either a very long or a very short title...'
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

    public function fix_poster(&$data) {
        if ($data['Movie']['poster']) {
            $data['Movie']['poster_url'] = $data['Movie']['poster'];
            $data['Movie']['poster'] = $data['Movie']['imdb_ID'] . '.jpg';
        }
    }

    public function save_poster($data) {    
        App::uses('HttpSocket', 'Network/Http');
        App::uses('File', 'Utility');
        $poster_url = $data['Movie']['poster_url'];
        $poster_full_path = 'img/posters/' . $data['Movie']['imdb_ID'] . '.jpg';

        $HttpSocket = new HttpSocket();
        $poster_data = $HttpSocket->get($poster_url, array(), array('redirect' => true));
        
        $file = new File($poster_full_path, true, 0777);
        $file->write($poster_data);
        $this->_create_thumb('img/posters/', $data['Movie']['poster'], 100);
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