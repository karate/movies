<div id="movie-popup" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body row">
				<div class="poster col-md-5">
					<?php echo $this->Html->image('posters/' . $movie['Movie']['poster'], array('alt' => $movie['Movie']['title'], 'fullBase' => true, 'class' => 'poster-image img-responsive')); ?>
				</div>
				
				<div class="details col-md-7">
					<div class="title">
						<h2>
							<?php echo $movie['Movie']['title']; ?>
							<?php if ($movie['Movie']['year']): ?>
								<span class="year"><?php echo $movie['Movie']['year']; ?></span>
							<?php endif; ?>
						</h2>
					</div>
					
					<div class="movie-info plot">
						<?php echo $movie['Movie']['description'] .'...'; ?>
					</div>
					

					<?php if ($movie['Movie']['director']): ?>
						<div class="movie-info director">
							<span class="label director">Director: </span>
							<?php echo $movie['Movie']['director']; ?>
						</div>
					<?php endif; ?>
					
					<?php if ($movie['Movie']['writer']): ?>
						<div class="movie-info writer">
							<span class="label writer">Writer: </span>
							<?php echo $movie['Movie']['writer']; ?>
						</div>
					<?php endif; ?>
					
					<?php if ($movie['Movie']['actors']): ?>
						<div class="movie-info actors">
							<span class="label director">Actors: </span>
							<?php echo $movie['Movie']['actors']; ?>
						</div>
					<?php endif; ?>
					
					<?php if ($movie['Movie']['imdb_rating']): ?>
						<div class="movie-info imdb-rating">
							<span class="label imdb-rating">IMDb rating: </span>
							<?php echo $movie['Movie']['imdb_rating']; ?>
						</div>
					<?php endif; ?>
					

					<div class="movie-info tpb-link">
						<?php
						$tpb_url = 'https://thepiratebay.se/search/' . $movie['Movie']['title'] . ' ' . $movie['Movie']['year'].'/0/7/200';
						echo $this->Html->link(
							$this->Html->image('pirate_bay_tiny.jpg', array('alt' => 'Search in the pirate bay', 'title' => 'Search in the pirate bay', 'fullBase' => true)),
							$tpb_url,
							array('class' => 'tpb', 'escape' => false, 'target' => '_blank')
						);
						?>
					</div>

					<?php if ($movie['Movie']['imdb_link']): ?>
						<div class="movie-info imdb-link">
							<?php 
								echo $this->Html->link(
								$this->Html->image('imdb_tiny.jpg', array('alt' => 'IMDb link', 'title' => 'IMDb link', 'fullBase' => true)),
								$movie['Movie']['imdb_link'],
								array('class' => 'imdb', 'escape' => false, 'target' => '_blank'));
							?>
						</div>
					<?php endif; ?>
					
					
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$('#movie-popup').on('hidden.bs.modal', function (e) {
	      $('#movie-popup').remove();
	  })
	</script>
</div>