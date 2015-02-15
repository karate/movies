<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>
	
	<table class="movie-list table">
		<tr>
			<th></th>
			<th>IMDb info</th>
			<th>Movie details</th>
			<th>Comments</th>
		</tr>

		<tr class="<?php echo ($screening['Screening']['id'])? 'arranged': ''; ?>"> 
			<td>
				<!-- Title, year and cover image -->
				<div class="title">
					<?php echo $this->Html->link(
						$screening['Movie']['title'],
						$screening['Movie']['imdb_link'],
					array('target' => '_blank')
					); ?>
					<?php if ($screening['Movie']['year']): ?>
						<span class="year"><?php echo $screening['Movie']['year']; ?></span>
					<?php endif; ?>
				</div>

					<?php if ($screening['Movie']['year']): ?>
					<?php endif; ?>


					<?php if ($screening['Movie']['poster']): ?>
						<div class="poster">
							<?php echo $this->Html->image('posters/' . $screening['Movie']['poster'], array('alt' => $screening['Movie']['title'], 'fullBase' => true, 'class' => 'poster-image img-responsive img-rounded')); ?>
						</div>
					<?php endif; ?>			
				</td>
				<td>
					<!-- IMDb info -->
				</td>
				<td> 
					<!-- Movie details -->
					<?php echo $screening['Movie']['description']; ?>

				</td>
				<td>
					<!-- Comments -->
					<?php echo $screening['Movie']['comments']; ?>
				</td>

			</tr>
		</table>

	</fieldset>
	<script type="text/javascript">

		$(".datetime-form").hide();

		$('.add-movie-to-calendar').click(function(e) {
			e.preventDefault();
			$(".datetime-form").fadeToggle();
		});
	</script>