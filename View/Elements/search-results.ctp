<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>

	<?php
		if (is_null($results)) {
			$message = 'Enter search criteria.';
		}
		else {
			$count = count($results);
			switch ($count) {
				case 0:
					$message = 'No results found...';
					break;
				case 1:
					$message = 'Found 1 movie';
					break;

				default:
					$message = "Found $count movies";
					break;
			}
			
		}
	?>
	<div class="result-count">
		<?php echo $message; ?>
	</div>
	
	<table class="movie-list table table-condensed">
		<tr>
			<th></th>
			<th>Movie details</th>
			<th>Comments</th>
			<?php if ($screenings): ?>
				<th>Screenings</th>
			<?php endif; ?>
			<th>Actions</th>
		</tr>

		<?php 
			if ($results) foreach ($results as $movie): ?>
			<tr class="<?php echo ($movie['Screening']['id'])? 'arranged': ''; ?>"> 
					<td> 
						<!-- Movie title and year -->
						<div class="title pull-left">
							<?php echo $this->Html->link(
								$movie['Movie']['title'],
								'#',
								array('target' => '_blank', 'data-id' => $movie['Movie']['id'])); 
							?>
							<?php if ($movie['Movie']['year']): ?>
								<span class="year"><?php echo $movie['Movie']['year']; ?></span>
							<?php endif; ?>
						</div>
						<div class="clearfix"></div>
						<!-- Movie details -->
						<div class="description">
							<?php 
							if ($screenings) {
								echo substr($movie['Movie']['description'], 0, 300) . '...';
							}
							else {
								echo substr($movie['Movie']['description'], 0, 200) . '...';
							} 
							?>
						</div>

					</td>
					<td>
						<!-- Comments -->
						<?php echo $movie['Movie']['comments']; ?>
					</td>
						<?php if ($screenings): ?>
							<td>
								<!-- Screening -->
								<div class="screening-date">
									<?php echo $this->Time->format('d/m/Y', $movie['Screening']['date']); ?> 
										<br />at 
									<?php echo $this->Time->format('H:i', $movie['Screening']['date']); ?>
								</div>
							</td>
						<?php endif; ?>
							<td>
								<div class="screening-actions">
								<?php if ($movie['Screening']['id']) {
									echo $this->Form->postLink(
										'cal -',
										array('controller' => 'screenings', 'action' => 'delete', $movie['Screening']['id']),
										array('confirm' => 'Are you sure you want to remove ' . $movie['Movie']['title'] . ' from the calendar?')
									);
								}
								else {
									echo $this->Html->link('cal +', '#', array('class' => 'add-movie-to-calendar', 'id' => $movie['Movie']['id']));
									echo $this->Form->create('Screening', array('type' => 'post', 'action' => 'add', 'class' => 'datetime-form'));
									echo $this->Form->input('datetime', array('class' => 'datetimepicker', 'label' => false, 'placeholder' => 'Date and time', 'name' => 'data[Screening][date]'));
									echo $this->Form->input('movie_id', array('type' => 'hidden', 'value' => $movie['Movie']['id']));
									echo $this->Html->link('cancel', '#', array('class' => 'hide-datetime pull-right'));
									echo $this->Form->submit();
									echo $this->Form->end();
								}
								?>
								<div class="delete">
									<?php
									echo $this->Form->postLink(
										'del',
										array('controller' => 'movies', 'action' => 'delete', $movie['Movie']['id']),
										array('confirm' => 'Are you sure you want to delete ' . $movie['Movie']['title'] . ' from the website?')
										);
										?>
								</div>
							</td>
						</tr>

					<?php endforeach; ?>


					<?php unset($arranged); ?>
				</table>

			</fieldset>