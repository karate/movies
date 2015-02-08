<!-- File: /app/View/Posts/index.ctp -->
<div class="actions">
	<?php echo $this->Html->Link('Add movie', array('action' => 'add')); ?>
</div>

<div class="clear"></div>

<div class="float-left half block">
	<?php echo $this->element('movie-list-full', array('title' => 'Watched', 'screenings' => $past_screenings)); ?>
	<?php echo $this->element('movie-list-full', array('title' => 'Upcoming', 'screenings' => $upcoming_screenings)); ?>
</div>
<div class="float-left half block">
	<?php echo $this->element('movie-list-full', array('title' => 'The rest', 'screenings' => $not_arranged)); ?>
</div>