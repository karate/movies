<!-- File: /app/View/Posts/index.ctp -->

<h1>Movie Screenings</h1>

<div id="movie-list" class="row">

	<fieldset class="block">
		<legend>All screenings</legend>

		<table class="screenings table table-condensed">
			<tr>
				<th>Date</th>
				<th>Movie</th>
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
						<div class="actions">
							<div class="screening">
								<?php 
									echo $this->Form->postLink(
										'<span class="glyphicon glyphicon-calendar calendar"></span><span class="glyphicon glyphicon-remove remove"></span>',
										array('controller' => 'screenings', 'action' => 'delete', $screening['Screening']['id']),
										array(
											'title' => 'Remove from calendar',
											'confirm' => 'Are you sure you want to remove ' . $screening['Movie']['title'] . ' from the calendar?',
										 	'escape' => false
										)
									);
								?>
							</div>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php unset($screening); ?>
		</table>
	</fieldset>
</div>