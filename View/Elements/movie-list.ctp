
<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>
	
	<table class="movie-list table table-condensed">
		<tr>
			<th></th>
			<th>Movie</th>
			<?php if ($screenings): ?>
				<th>Screenings</th>
			<?php endif; ?>
			<th>Actions</th>
		</tr>

		<?php foreach ($content as $movie): ?>
			<tr class="<?php echo ($movie['Screening']['id'])? 'arranged': ''; ?>"> 
				<td>
					<!-- Title, year and cover image -->
					<?php if ($movie['Movie']['poster']): ?>
						<div class="poster">
							<?php echo $this->Html->image(
								'posters/thumb_' . $movie['Movie']['poster'], 
								array(
									'alt' => $movie['Movie']['title'], 
									'fullBase' => true, 
									'class' => 'poster-thumb')
								); 
							?>
						</div>
					<?php endif; ?>
				</td>

					</td>
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

							<?php if ($movie['Movie']['comments']): ?>
								<!-- Comments -->
								<span class="comments glyphicon glyphicon-asterisk"></span>
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
								<div class="actions">
									<div class="screening">
											<?php if ($movie['Screening']['id']) {
												echo $this->Form->postLink(
													'<span class="glyphicon glyphicon-calendar calendar"></span><span class="glyphicon glyphicon-remove remove"></span>',
													array('controller' => 'screenings', 'action' => 'delete', $movie['Screening']['id']),
													array(
														'title' => 'Remove from calendar',
														'confirm' => 'Are you sure you want to remove ' . $movie['Movie']['title'] . ' from the calendar?',
													 	'escape' => false
													)
												);
											}
											else {
												echo $this->Html->link(
													'<span class="glyphicon glyphicon-calendar calendar"></span><span class="glyphicon glyphicon-plus add"></span>',
													'#', 
													array(
														'title' => 'Add to calendar',
														'class' => 'add-movie-to-calendar', 'id' => $movie['Movie']['id'],
														'escape' => false
													)
												);
												echo $this->Form->create('Screening', array('type' => 'post', 'action' => 'add', 'class' => 'datetime-form'));
												echo $this->Form->input('datetime', array('class' => 'datetimepicker', 'label' => false, 'placeholder' => 'Date and time', 'name' => 'data[Screening][date]'));
												echo $this->Form->input('movie_id', array('type' => 'hidden', 'value' => $movie['Movie']['id']));
												echo $this->Html->link('cancel', '#', array('class' => 'hide-datetime pull-right'));
												echo $this->Form->submit();
												echo $this->Form->end();
											}
											?>
									</div>
									<div class="delete">
										<?php
										echo $this->Form->postLink(
											'<span class="glyphicon glyphicon-minus"></span>',
											array('controller' => 'movies', 'action' => 'delete', $movie['Movie']['id']),
											array(
												'title' => 'Delete movie',
												'confirm' => 'Are you sure you want to delete ' . $movie['Movie']['title'] . ' from the website?',
												'escape' => false
											)
										);
										?>
									</div>
								</div>
							</td>
						</tr>

					<?php endforeach; ?>


					<?php unset($arranged); ?>
				</table>

			</fieldset>
			<?php if (!$screenings): ?>
				<div class="counter">
					<?php echo $this->Paginator->counter('Showing movies {:start}-{:end}, out of {:count}'); ?>
				</div>
				<div class="paginator">
					<?php 
						echo $this->Paginator->numbers(
							array(
								'first' => 'First', 
								'last' => 'Last',
								'separator' => '|',
								'modulus' => 2
							)
						); 
					?>
				</div>
			<?php endif; ?>
