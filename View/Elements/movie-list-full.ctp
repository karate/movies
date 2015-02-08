<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>
	
	<table class="movie-list">
		<tr>
			<th></th>
			<th>IMDb info</th>
			<th>Movie details</th>
			<th>Comments</th>
			<th>Screenings</th>
		</tr>

		<?php foreach ($screenings as $movie): ?>
			<tr class="<?php echo ($movie['Screening']['id'])? 'arranged': ''; ?>"> 
				<td>
					<!-- Title, year and cover image -->
					<span class="title">
						<?php echo $this->Html->link(
							$movie['Movie']['title'],
							$movie['Movie']['imdb_link'],
							array('target' => '_blank')
							); ?>
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
					<td>
						<!-- IMDb info -->
					</td>
					<td> 
						<!-- Movie details -->
						<?php echo $movie['Movie']['description']; ?>

					</td>
					<td>
						<!-- Comments -->
						<?php echo $movie['Movie']['comments']; ?></td>
						<td>
							<!-- Screening -->
							<?php if ($movie['Screening']['id']): ?>
								<div class="arranged">Arranged for screening:</div>
								<div class="screening-date">
									<?php echo $this->Time->format('l, F j \a\t H:i', $movie['Screening']['date']); ?>
								</div>
								<div class="screening-actions">
									<?php
									echo $this->Form->postLink(
										'Remove from calendar',
										array('controller' => 'screenings', 'action' => 'delete', $movie['Screening']['id']),
										array('confirm' => 'Are you sure you want to remove ' . $movie['Movie']['title'] . ' from the calendar?')
										);
										?>
									</div>
								<?php else: ?>
									<div class="">Not arranged for screening:</div>
									<div class="screening-actions">
										<div>
											<?php
											echo $this->Html->link('Add to calendar now', '#', array('class' => 'add-movie-to-calendar'));
											echo $this->Form->create('Screening', array('type' => 'post', 'action' => 'add', 'class' => 'datetime-form hidden'));
											echo $this->Form->input('datetime', array('class' => 'datetimepicker', 'label' => false, 'placeholder' => 'Date and time', 'name' => 'data[Screening][date]'));
											echo $this->Form->input('movie_id', array('type' => 'hidden', 'value' => $movie['Movie']['id']));
											echo $this->Form->submit();
											echo $this->Form->end();
											?>	
										</div>
									</div>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					<?php unset($arranged); ?>
				</table>

			</fieldset>
			<script type="text/javascript">

				$(".datetime-form").hide();

				$('.add-movie-to-calendar').click(function(e) {
					e.preventDefault();
					$(".datetime-form").fadeToggle();
				});
			</script>