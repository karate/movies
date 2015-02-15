
<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>
	
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

		<?php foreach ($content as $movie): ?>
			<tr class="<?php echo ($movie['Screening']['id'])? 'arranged': ''; ?>"> 
				<td>
					<!-- Title, year and cover image -->
					<div class="main-movie-info">
						<div class="title">
							<?php echo $this->Html->link(
								$movie['Movie']['title'],
								'#',
								array('target' => '_blank', 'data-id' => $movie['Movie']['id'])); 
							?>
							<?php if ($movie['Movie']['year']): ?>
								<span class="year"><?php echo $movie['Movie']['year']; ?></span>
							<?php endif; ?>
						</div>
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
					</div>

					</td>
					<td> 
						<!-- Movie details -->
						<?php echo $movie['Movie']['description']; ?>

					</td>
					<td>
						<!-- Comments -->
						<?php echo $movie['Movie']['comments']; ?>
					</td>
						<?php if ($screenings): ?>
							<td>
								<!-- Screening -->
								<div class="screening-date">
									<?php echo $this->Time->format('d/m/Y \a\t H:i', $movie['Screening']['date']); ?>
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
									echo $this->Html->link('cal +', '#', array('class' => 'add-movie-to-calendar'));
									echo $this->Form->create('Screening', array('type' => 'post', 'action' => 'add', 'class' => 'datetime-form'));
									echo $this->Form->input('datetime', array('class' => 'datetimepicker', 'label' => false, 'placeholder' => 'Date and time', 'name' => 'data[Screening][date]'));
									echo $this->Form->input('movie_id', array('type' => 'hidden', 'value' => $movie['Movie']['id']));
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
			<script type="text/javascript">

				$(".datetime-form").hide();

				$('.add-movie-to-calendar').click(function(e) {
					e.preventDefault();
					$(".datetime-form").fadeToggle();
				});

				
			</script>