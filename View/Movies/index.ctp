<!-- File: /app/View/Posts/index.ctp -->

<h1 class="title">Saved Movies</h1>
<table class="movie-list">
	<tr>
		<th></th>
		<th>Description</th>
		<th>Comments</th>
	</tr>

	<!-- Here is where we loop through our $movies array, printing out movie info -->

	<?php foreach ($movies as $movie): ?>
	<tr>
		<td>
			<span class="title">
				<?php 
					echo $this->Html->link(
						$movie['Movie']['title'],
						array(
							'controller'=>'movies', 
							'action'=>'view', 
							$movie['Movie']['id']
						)
					);
				?>
			</span>

			<?php if ($movie['Movie']['year']): ?>
				<span class="year">
					(<?php echo $movie['Movie']['year']; ?>)
				</span>
			<?php endif; ?>


			<?php if ($movie['Movie']['poster']): ?>
				<div class="poster">
					<?php echo $this->Html->image('posters/' . $movie['Movie']['poster'], array('alt' => $movie['Movie']['title'], 'fullBase' => true, 'class' => 'poster-image')); ?>
				</div>
			<?php endif; ?>			
		</td>
		<td><?php echo $movie['Movie']['description']; ?></td>
		<td><?php echo $movie['Movie']['comments']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($movie); ?>
</table>