<!-- File: /app/View/Posts/index.ctp -->
<?php echo $this->element('movie-list-full', array('title' => 'Past movies', 'screenings' => $past_screenings)); ?>
<?php echo $this->element('movie-list-full', array('title' => 'Upcoming movies', 'screenings' => $upcoming_screenings)); ?>
<?php echo $this->element('movie-list-full', array('title' => 'The rest', 'screenings' => $not_arranged)); ?>