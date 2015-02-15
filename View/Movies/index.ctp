<!-- File: /app/View/Movies/index.ctp -->
<div class="actions">
	<?php echo $this->Html->Link('Add movie', array('action' => 'add'), array('class' => 'btn btn-danger')); ?>
</div>

<div id="movie-list" class="row">
	<div class="col-md-6 col-xs-12">
		<?php echo $this->element('movie-list', array('title' => 'Watched', 'content' => $past_screenings, 'screenings' => true)); ?>
		<?php echo $this->element('movie-list', array('title' => 'Upcoming', 'content' => $upcoming_screenings, 'screenings' => true)); ?>
	</div>
	

	<div class="col-md-6  col-xs-12">
		<?php echo $this->element('movie-list', array('title' => 'The rest', 'content' => $not_arranged, 'screenings' => false)); ?>
	</div>
</div>