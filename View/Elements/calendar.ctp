<fieldset class="block">
	<?php if (isset($title)): ?>
		<legend>
			<?php echo $title; ?>
		</legend>
	<?php endif; ?>

	<div id='calendar'></div>

</fieldset>

<script>
	
	$('#calendar').fullCalendar({
        events: [
        	<?php foreach ($screenings as $screening): ?>
    		{
	    		title: '<?php echo $screening['Movie']['title']; ?>',
	    		start: '<?php echo $screening['Screening']['date']; ?>',
    		},
        	<?php endforeach; ?>
        ],
        firstDay: 1,
        timeFormat: 'H:mm',
    });

</script>