<?php

class WishlistsController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('RequestHandler');
	var $uses = false;

	public function index() {
		return $this->redirect(array('action' => 'import'));
	}

	public function import() {
        App::import('Controller', 'Movie'); // mention at top
		if ($this->request->is('post')) {
			$wishlist = WWW_ROOT. 'files' . DS . $this->data['Wishlist']['wishlist']['name'];
			move_uploaded_file($this->data['Wishlist']['wishlist']['tmp_name'], $wishlist);

			
			$delim = ','; $enc = '"'; $line = "\n";
			$csv_contents = str_getcsv ( file_get_contents( $wishlist ), $line );

			foreach( $csv_contents as $row ) {
				if ($row) {
					$csv[] = str_getcsv( $row, $delim, $enc );
				}
			}

			$movies_array = $this->_load_movies_from_csv($csv);

			$this->loadModel('Movie');
			
			foreach ($movies_array as $wishlist_movie) {
				$movie = $this->Movie->find('first', array('conditions' => array('Movie.imdb_ID' => $wishlist_movie['Movie']['imdb_ID'])));

				if (!$movie) {
					$movie_full_info = $this->_get_movie_info_from_imdb($wishlist_movie['Movie']['imdb_ID']);
					$this->Movie->fix_poster($movie_full_info);
					$this->Movie->save_poster($movie_full_info);
					$this->Movie->create();
					$this->Movie->save($movie_full_info);
				}
			}
		}
	}

	private function _load_movies_from_csv($data) {
		$headers = array_flip($data[0]);
		unset($data[0]);
		
		$movies = array();
		
		foreach ($data as $id => $wishlist_movie) {
			$movies[]['Movie'] = array(
				'imdb_ID' 		=> $wishlist_movie[$headers['const']],
				'title' 		=> $wishlist_movie[$headers['Title']],
				'imdb_rating' 	=> $wishlist_movie[$headers['IMDb Rating']],
				'year'			=> $wishlist_movie[$headers['Year']],
				'imdb_link' 	=> $wishlist_movie[$headers['URL']],
			);
		}

		return $movies;
	}

	private function _get_movie_info_from_imdb($imdb_id) {
		App::uses('HttpSocket', 'Network/Http');
		
		$HttpSocket = new HttpSocket();
		$url = "http://www.omdbapi.com/?i=$imdb_id&plot=full&r=json";
        $response = $HttpSocket->get($url, array(), array('redirect' => true, 'header' => array('Content-Type' => 'application/json')));
        $movie_info = json_decode($response->body);

        $movie['Movie'] = array();
        if ($movie_info->Response == 'True') {
    		$movie['Movie'] = array(
        	    'title'		=> $movie_info->Title,
			    'year'		=> $movie_info->Year,
			    'runtime'	=> $movie_info->Runtime,
			    'director'	=> $movie_info->Director,
			    'writer'	=> $movie_info->Writer,
			    'actors'	=> $movie_info->Actors,
			    'description'	=> $movie_info->Plot,
			    'poster'	=> $movie_info->Poster,
			    'imdb_rating'	=> $movie_info->imdbRating,
			    'imdb_ID'	=> $movie_info->imdbID,
			    'imdb_link'	=> 'http://www.imdb.com/title/' . $movie_info->imdbID,
			);
        }

        return $movie;
	}
}

?>
