<!-- File: /app/View/Calendars/index.ctp -->
<h1 class="title">Calendar</h1>

<div class="row">
    <div class="col-md-4 col-xs-12 calendar">
        <?php echo $this->element('calendar', array('title' => 'Calendar', 'screenings' => $all_screenings)); ?>
    </div>

    <div class="col-md-8 col-xs-12">
        <?php if ($next_up): ?>
            <div class="next-up">
                <?php echo $this->element('screening-list-next-up', array('title' => 'Next Up!', 'screening' => $next_up)); ?>
            </div>
        <?php endif; ?>
        
        <div id="movie-list">
            <div class="upcoming-screenings">
                <?php echo $this->element('screening-list-teaser', array('title' => 'Upcoming screenings', 'screenings' => $upcoming_screenings)); ?>
            </div>
            <div class="past-screenings">
                <?php echo $this->element('screening-list-teaser', array('title' => 'Past screenings', 'screenings' => $past_screenings)); ?>
            </div>
        </div>
    </div>
</div>
