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
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
		$this->set('title', 'We are bob');
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>
      
    </title>
	
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<meta name="description" content="WAB TV">
	
    <?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('style.css') ?> <!-- Default style -->
	<?= $this->Html->css('reset.css') ?> <!-- Reset style -->
	<?= $this->Html->css('colorpicker.min.css') ?> 	
			
    <?= $this->Html->css('chat.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('bower_components/angular/angular'); ?>
    <?= $this->Html->script('bower_components/angular-route/angular-route.min'); ?>
    <?= $this->Html->script('bower_components/jquery/dist/jquery.min'); ?>
    <?= $this->Html->script('bower_components/jquery-ui/jquery-ui.min'); ?>
    <?= $this->Html->script('node_modules/socket.io/node_modules/socket.io-client/socket.io.js'); ?>
    <?= $this->Html->script('node_modules/underscore/underscore.js'); ?>
    <?= $this->Html->script('bower_components/angular-socket-io/socket.js'); ?>
    <?= $this->Html->script('bootstrap-colorpicker-module.min'); ?>	
    <?= $this->Html->script('awesomplete/jquery.a-tools-1.4.1'); ?>
    <?= $this->Html->script('awesomplete/jquery.asuggest'); ?>
    <?= $this->Html->script('app'); ?>
    <?= $this->Html->script('services/services'); ?>
    <?= $this->Html->script('services/serverUrl'); ?>
    <?= $this->Html->script('controllers/chatController'); ?>
	<?= $this->Html->script('directives/chatDirective'); ?>
	
		<!--[if lt IE 9]> 
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>
<body ng-app="wabTV">
<div id="container">
<?= $this->Flash->render('auth') ;?>
<?= $this->element('header'); ?>
<div id="content">
		<div id="sidebar-left" role="complementary">
		<?= $this->element('opmarket'); ?>
		<?= $this->element('social'); ?>
		<?= $this->element('event'); ?>
		</div>
		<div id="sidebar-middle">
		<?= $this->fetch('content') ?>
		</div>
		<div id="sidebar-right">
		<?= $this->element('chat'); ?>
		<?= $this->element('walloffame'); ?>
		</div>
		<footer>
			<p>© 2015-2016 Wab TV, Tous Droits Réservés.</br>Politique de confidentialité - <?php echo $this->Html->link('Mentions légale', '/pages/mentions_legales'); ?> - <?php echo $this->Html->link('Conditions d\'Utilisation', '/pages/conditions_generales'); ?></p>
			
		</footer>
</div>
</div>
</body>
</html>
