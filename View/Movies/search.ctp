<!-- File: /app/View/Movies/index.ctp -->

<div class="search row">
	<div id="search-filters" class="col-xs-12 col-sm-2">
		<div>		
			<fieldset class="block">
				<legend>Filters</legend>
				<?php
					echo $this->Form->create('Movie', array('type' => 'get', 'action' => 'search'));

					echo $this->Form->input('q', array('label' => 'Title'));
					echo $this->Form->input('y', array('label' => 'Year'));

					echo $this->Form->end('Search');

				?>
			</fieldset>
		</div>
	</div>

	<div id="movie-list">
		<div class="col-xs-12 col-sm-10">
			<?php echo $this->element('search-results', array('title' => 'Results', 'screenings'=> false, 'results' => $results)); ?>
		</div>
	</div>
</div>