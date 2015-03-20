<?php foreach ($messages as $msg): ?>
	<div class="message" data-id="<?php echo $msg['Message']['id']; ?>">
		<div class="user">
			<?php echo $msg['Message']['user']; ?>
		</div>
		<div class="date">
				<span class ="relative" title="<?php echo $msg['Message']['date']; ?>"></span>
				<span class ="absolute" ><?php echo $this->Time->format('F jS, H:i', $msg['Message']['date']); ?></span>
		</div>
		<div class="user-message">
			<?php echo $msg['Message']['message']; ?>
		</div>
	</div>
<?php endforeach; ?>