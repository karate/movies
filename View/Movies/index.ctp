<!-- File: /app/View/Movies/index.ctp -->
<div id="movie-list" class="row">
	<div class="col-md-6 col-xs-12">
		<?php echo $this->element('movie-list', array('title' => 'Upcoming', 'content' => $upcoming_screenings, 'screenings' => true, 'watched' => false)); ?>
		<?php echo $this->element('movie-list', array('title' => 'Watched', 'content' => $past_screenings, 'screenings' => true, 'watched' => true)); ?>
	</div>
	

	<div class="col-md-6  col-xs-12">
		<?php echo $this->element('movie-list', array('title' => 'The rest', 'content' => $not_arranged, 'screenings' => false, 'watched' => false)); ?>
	</div>
</div>