<!-- File: /app/View/Calendars/index.ctp -->
<h1 class="title">Calendar</h1>

<div class="float-left">
    <?php echo $this->element('calendar', array('title' => 'Calendar', 'screenings' => $all_screenings)); ?>
</div>

<div class="float-left">
    <?php echo $this->element('movie-list-teaser', array('title' => 'Upcoming screenings', 'screenings' => $upcoming_screenings)); ?>
	<?php echo $this->element('movie-list-teaser', array('title' => 'Past screenings', 'screenings' => $past_screenings)); ?>
</div>
