<?php foreach ($messages as $msg): ?>
	<div class="message" data-id="<?php echo $msg['Message']['id']; ?>">
		<div class="user">
			<?php echo $msg['Message']['user']; ?>
		</div>
		<div class="date">
			<?php
			echo $this->Time->timeAgoInWords(
				$msg['Message']['date']
			);
			// If message is older that one hou, display full date also
			if (!$this->Time->wasWithinLast('1 hour', $msg['Message']['date'])): ?>
				<span><?php echo $this->Time->niceShort($msg['Message']['date']); ?></span>
			<?php endif; ?>
		</div>
		<div class="user-message">
			<?php echo $msg['Message']['message']; ?>
		</div>
	</div>
<?php endforeach; ?>