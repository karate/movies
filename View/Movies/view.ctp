<!-- File: /app/View/Posts/index.ctp -->
<h1 class="title"><?php echo $movie['Movie']['title']?> (<?php echo $movie['Movie']['year']; ?>)</h1>

<div class="movie-info">

	<div class="float-left">
		<div class="title">
			<?php 
				if ($movie['Movie']['imdb_link']) {
					echo $this->Html->link(
						$movie['Movie']['title'], 		// Label
						$movie['Movie']['imdb_link'], // URL
						array('target' => '_blank')		//Options
					); 
				}
				else {
					echo $movie['Movie']['title'];
				}
			?>
		</div>

		<?php if ($movie['Movie']['year']): ?>
			<div class="year">
				(<?php echo $movie['Movie']['year']; ?>)
			</div>
		<?php endif; ?>


		<?php if ($movie['Movie']['poster']): ?>
			<div class="poster">
				<?php echo $this->Html->image('posters/' . $movie['Movie']['poster'], array('alt' => $movie['Movie']['title'], 'fullBase' => true, 'class' => 'poster-image')); ?>
			</div>
			<div class="imdb-link">
				<?php 
					if ($movie['Movie']['imdb_link']) {
						echo $this->Html->link(
							'IMDb link', 					// Label
							$movie['Movie']['imdb_link'], 	// URL
							array('target' => '_blank')		//Options
						); 
					}
				?>
			</div>
			<div class="imdb_rating">
				IMDb rating: <?php echo $movie['Movie']['imdb_rating']; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="float-left">
		<fieldset class="description">
			<legend>Description</legend>
			<?php echo $movie['Movie']['description']; ?>
		</fieldset>
		<fieldset class="comments">
			<legend>Comments</legend>
			<?php echo $movie['Movie']['comments']; ?>
		</fieldset>	
	</div>
</div>
<?php unset($movie); ?>