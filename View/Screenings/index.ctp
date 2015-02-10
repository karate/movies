<!-- File: /app/View/Posts/index.ctp -->

<h1 class="title">Movie Screenings</h1>
<table class="screenings table table-condensed">
	<tr>
		<th>Date</th>
		<th>Movies</th>
		<th>Comments</th>
		<th>Actions</th>

	</tr>

	<!-- Here is where we loop through our $movies array, printing out movie info -->

	<?php foreach ($screenings as $screening): ?>
	<tr>
		<td class="date">
				<?php 
					echo $this->Time->format('l, F j - H:i', $screening['Screening']['date']); ?>
		</td>
		
		<td class="movie">
			<span class="title">
				<?php 
					echo $this->Html->link(
						$screening['Movie']['title'],
						array(
							'controller'=>'movies', 
							'action'=>'view', 
							$screening['Movie']['id']
						)
					);
				?>
			</span>
		</td>
		<td class="comments"> <?php echo $screening['Screening']['comments']; ?></td>
		<td>
			<?php 
				echo $this->Form->postLink(
	                'Cancel screening',
	                array('controller' => 'screenings', 'action' => 'delete', $screening['Screening']['id']),
	                array('confirm' => 'Are you sure you want to cancel screening for ' . $screening['Movie']['title'] . '?')
	            );
	        ?>
			
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($screening); ?>
</table>