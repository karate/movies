
<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>
	
	<h4 class="relative-time">
		<?php 
			echo $this->Time->timeAgoInWords(
			    $screening['Screening']['date']
			);
		?>
	</h4>

	<table class="movie-list table table-condensed">
			<tr class="arranged"> 
				<td>
					<!-- Title, year and cover image -->
					<?php if ($screening['Movie']['poster']): ?>
						<div class="poster">
							<?php echo $this->Html->image(
								'posters/thumb_' . $screening['Movie']['poster'], 
								array(
									'alt' => $screening['Movie']['title'], 
									'fullBase' => true, 
									'class' => 'poster-thumb')
								); 
							?>
						</div>
					<?php endif; ?>
				</td>

					</td>
					<td> 
						<!-- next_up title and year -->
						<div class="title pull-left">
							<?php echo $this->Html->link(
								$screening['Movie']['title'],
								'#',
								array('target' => '_blank', 'data-id' => $screening['Movie']['id'])); 
							?>
							<?php if ($screening['Movie']['year']): ?>
								<span class="year"><?php echo $screening['Movie']['year']; ?></span>
							<?php endif; ?>
						</div>
						<div class="clearfix"></div>
						<!-- next_up details -->
						<div class="description">
							<?php 
								echo substr($screening['Movie']['description'], 0, 300) . '...'; 
							?>
						</div>

					</td>
					<td>
						<!-- Comments -->
						<?php echo $screening['Movie']['comments']; ?>
					</td>
					</tr>



					<?php unset($arranged); ?>
				</table>

			</fieldset>