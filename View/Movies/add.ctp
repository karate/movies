<!-- File: /app/View/Movies/add.ctp -->

<h1>Add Movie</h1>
<?php
echo $this->Form->create('Movie');
?>
<div class="float-left half">
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('year');
		echo $this->Form->input('description');
		echo $this->Form->input('comments');
	?>
</div>
<div class="float-left half">
	<?php
		echo $this->Form->input('imdb_ID');
		echo $this->Form->input('imdb_link');
		echo $this->Form->input('imdb_rating');
		echo $this->Form->input('poster', array('type' => 'hidden'));
		echo $this->Form->button('Lookup', array('type' => 'button', 'id' => 'omdb-lookup'));
	?>
</div>
<div class="float-left half poster">
	<img src="" alt="poster" id="image-poster"/>
</div>
<?php
		echo $this->Form->end('Save');
?>

<script type="text/javascript">
	$('button#omdb-lookup').click(function(){
		title = $('input#MovieTitle').val();
		imdb_id = $('input#MovieImdbID').val();
		
		if ( !imdb_id ) { // Search by title
			if (title) {
				url = "http://www.omdbapi.com/?t=" + title + "&plot=short&r=json";
				year = $('input#MovieYear').val()
				if (year) {
					url += "y=" + year;
				}
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
					$('input#MovieDescription').val(response.Plot);
					$('input#MovieImdbLink').val("http://www.imdb.com/title/" + response.imdbID);
					$('input#MovieImdbRating').val(response.imdbRating);
					$('input#MovieImdbID').val(response.imdbID);
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
