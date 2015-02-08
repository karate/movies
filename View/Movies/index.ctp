<!-- File: /app/View/Posts/index.ctp -->
<div class="float-left half block">
	<?php echo $this->element('movie-list-full', array('title' => 'Watched', 'screenings' => $past_screenings)); ?>
	<?php echo $this->element('movie-list-full', array('title' => 'Upcoming', 'screenings' => $upcoming_screenings)); ?>
</div>
<div class="float-left half block">
	<?php echo $this->element('movie-list-full', array('title' => 'The rest', 'screenings' => $not_arranged)); ?>
</div>