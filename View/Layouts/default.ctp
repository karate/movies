<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('style');
		echo $this->Html->css('http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.css');
		echo $this->Html->css('jquery.datetimepicker');

		echo $this->Html->script('http://code.jquery.com/jquery-1.11.2.min.js');
		echo $this->Html->script('moment-with-locales');
		echo $this->Html->script('http:////cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.js');
		echo $this->Html->script('jquery.datetimepicker');
		echo $this->Html->script('jquery.timeago');

		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('script');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script type="text/javascript">
		var baseUrl = '<?php echo Router::url('/', true); ?>';
	</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->Element('menu', array()); ?>
		</div>
		<div id="content" class="container-fluid">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
