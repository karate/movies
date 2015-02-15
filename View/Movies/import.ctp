<!-- File: /app/View/Movies/add.ctp -->

<h1>Import movies</h1>
<div class="import-file"></div>
	<?php
		echo $this->Form->create('movies', array('type' => 'file'));
		echo $this->Form->input('wishlist', array('type' => 'file'));
		echo $this->Form->end('Upload');
	?>
	</div>	
</div>