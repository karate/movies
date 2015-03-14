<?php 
	$controller = $this->params['controller'];
?>

<nav class="main-menu">
	<ul class="nav nav-pills">
		<li><?php echo $this->Html->link('Calendar', '/calendars', array('class' => ($controller == 'calendars'? 'active': ''))); ?></li>
		<li class="parent-menu">
			<?php 
				$class = '';
				if ($controller == 'wishlists' || $controller == 'movies') {
					$class = 'active';
				}
				echo $this->Html->link('Movies ', '/movies', array('class' => $class)); ?>
			<ul class='submenu'>
				<li><?php echo $this->Html->link('Add movie', '/movies/add', array('class' => ($controller == 'movies'? 'active': ''))); ?></li>
				<li><?php echo $this->Html->link('Import Movies', '/wishlists/import', array('class' => ($controller == 'movies'? 'active': ''))); ?></li>
			</ul>
		</li>
		<li><?php echo $this->Html->link('Screenings', '/screenings', array('class' => ($controller == 'screenings'? 'active': ''))); ?></li>
		<li><?php echo $this->Html->link('Message Board', '/messages', array('class' => ($controller == 'messages'? 'active': ''))); ?></li>
	</ul>
</nav>