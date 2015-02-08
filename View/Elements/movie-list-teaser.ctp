<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>
	
	<table class="movie-list">
		<tr>
			<th>Date</th>
			<th>Movie</th>
			<th>Comments</th>
		</tr>

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
		</tr>
		<?php endforeach; ?>
		<?php unset($screening); ?>
	</table>
	
</fieldset>
