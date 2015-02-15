<!-- File: /app/View/Movies/add.ctp -->

<h1>Import movies</h1>
<div class="info row">
	<div class="col-md-2">
		<div class="import-file"></div>
		<?php
		echo $this->Form->create('Wishlist', array('type' => 'file'));
		echo $this->Form->input('wishlist', array('type' => 'file'));
		echo $this->Form->end('Upload');
		?>
	</div>
	<div class="col-md-2">
		<h4>Instructions</h4>
		<ul>
			<li>Export your IMDb wishlist as a .csv file</li>
			<li>Click 'Browse...' and select your wishlist</li>
			<li>Click 'Upload'</li>
		</ul>

		<h4>Caution</h4>
		<ul>
			<li>Movies in your wishlist that already exist in the database, will be ignored</li>
			<li>
				If you want to update a movie in the database, delete in and import the .csv again. <span class="warning">Be aware the this will discard any custom info (e.g comments)</span>
			</li>
			<li>Depending on the size of your wishlist, this may take a long time. Please be patient.</li>
		</ul>
	</div>
</div>
