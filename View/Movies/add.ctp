<!-- File: /app/View/Movies/add.ctp -->

<h1>Add Movie</h1>
<?php
echo $this->Form->create('Movie');
?>
<div class="row">
	<div class="col-md-2">
	<?php
			echo $this->Form->input('description', array('type' => 'textarea'));
			echo $this->Form->input('comments', array('type' => 'textarea'));
			echo $this->Form->input('runtime', array('type' => 'text'));
			echo $this->Form->input('director', array('type' => 'textarea'));
			echo $this->Form->input('writer', array('type' => 'textarea'));
			echo $this->Form->input('actors', array('type' => 'textarea'));

			echo $this->Form->input('imdb_link');
			echo $this->Form->input('imdb_rating');
			echo $this->Form->input('poster', array('type' => 'hidden'));
		?>
	</div>
	
	<div class="col-md-2">
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('year');
			echo $this->Form->input('imdb_ID');
			echo $this->Form->button('Lookup', array('type' => 'button', 'id' => 'omdb-lookup'));
			echo $this->Form->end('Save');
		?>
	</div>

	<div class="col-md-2">
		<img src="" alt="poster" id="image-poster"/>
	</div>
</div>


<script type="text/javascript">
	$('button#omdb-lookup').click(function(){
		title = $('input#MovieTitle').val();
		imdb_id = $('input#MovieImdbID').val();
		
		if ( title ) { // Search by title
			url = "http://www.omdbapi.com/?t=" + title + "&plot=short&r=json";
			year = $('input#MovieYear').val()
			if (year) {
				url += "y=" + year;
			}
		}
		else if ( imdb_id ) { // Search by imdb id
			url = "http://www.omdbapi.com/?i=" + imdb_id + "&plot=short&r=json";
		}
		else {
			return;
		}
		$.ajax( url )
			.done(function(e) {
				response = JSON.parse(e);
				if (response.Response == 'True') {
					$('input#MovieTitle').val(response.Title);
					$('input#MovieYear').val(response.Year);
					$('input#MovieImdbID').val(response.imdbID);

					$('textarea#MovieRuntime').val(response.Runtime);
					$('textarea#MovieDirector').val(response.Director);
					$('textarea#MovieWriter').val(response.Writer);
					$('textarea#MovieActors').val(response.Actors);
					$('textarea#MovieDescription').val(response.Plot);
					$('input#MovieImdbLink').val("http://www.imdb.com/title/" + response.imdbID);
					$('input#MovieImdbRating').val(response.imdbRating);
					$('input#MoviePoster').val(response.Poster);
					
					$('#image-poster').attr("src", response.Poster);

				}
				else {
					alert('Invalid IMDb ID');
				}
			})
			.fail(function() {
			//alert( "error" );
			})
			.always(function() {
			//alert( "complete" );
			});	
	});
	
</script>
