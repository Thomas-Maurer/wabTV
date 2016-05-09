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
	<?= $this->Html->css('reset.css') ?> <!-- Reset style -->
	<?= $this->Html->css('style.css') ?> <!-- Default style -->

    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('prog.css') ?>

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
    <?= $this->Html->script('controllers/progController'); ?>
	<?= $this->Html->script('directives/chatDirective'); ?>
	
		<!--[if lt IE 9]> 
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>
<body ng-app="wabTV">
<div id="container">
	<div class="wrapper">
		<div class="contentInfoStream">
			<div class="logoWabTV"></div>
			<div class="partenaires">
				<a href="http://www.goclecd.fr/?boblegob" target="blank">
					<?php echo $this->Html->image('partenaires/GoclecdLogo.png', array( 'style' => 'width:144px; height:80px; margin-left: 20px;','alt'=>'Logo GOCLÉCD'));?>
				</a>
				<a href="http://www.melty.fr/esport-club/" target="blank">
					<?php echo $this->Html->image('partenaires/MeltyLogo.png', array( 'style' => 'width:144px; height:80px; margin-left: 20px;','alt'=>'Logo MELTY ESPORT'));?>
				</a>
				<a href="http://www.ouikos.com/fr/" target="blank">
					<?php echo $this->Html->image('partenaires/OuikosLogo.png', array( 'style' => 'width:144px; height:80px; margin-left: 20px;','alt'=>'Logo OUIKOS'));?>
				</a>
				<a href="https://www.verygames.net/fr/" target="blank">
					<?php echo $this->Html->image('partenaires/VeryGamesLogo.png', array( 'style' => 'width:144px; height:80px; margin-left: 20px;','alt'=>'Logo VERYGAMES'));?>
				</a>
				<a href="http://www.jeux5.fr/" alt="jeux" target="blank">
					<?php echo $this->Html->image('partenaires/logojeux5.png', array( 'style' => 'width:227px;','alt'=>'Jeux Jeux5'));?>
				</a>
			</div>
		</div>
		<div class="hr hr-top"></div>
<?= $this->Flash->render('auth') ;?>
<div id="">
	<div class="naviguation">
		<h2 style="margin: 0;">
			<center>
				<div class="boutonWab" style="width:130px; height:25px;" onclick="window.location='#programmation';">PROGRAMMATION</div>
				<div class="boutonWab" style="width:130px; height:25px;" onclick="window.location='https://secure.twitch.tv/products/weareb0b/ticket/new?ref=below_video_subscribe_button';">S'ABONNER A LA TV</div>
				<div class="boutonWabDonation" style="width:180px; height:25px;" onclick="window.location='https://www.twitchalerts.com/donate/weareb0b';"><div class="logoPaypal"></div>DONATION VIA PAYPAL</div>
				<div class="boutonWabDonation" style="width:180px; height:25px;" onclick="window.location='https://www.flooz.me/@wabtv';"><div class="logoFlooz"></div>DONATION VIA FLOOZ</div>
			</center>
		</h2>
	</div>
	<div class="hr"></div>
		<div id="sidebar-left" role="complementary">
		</div>
		<div id="">
			<div id="twitch-live">
				<iframe src="http://www.twitch.tv/weareb0b/embed" class="iframe-tv" frameborder="0" scrolling="no" height="545" width="902" allowFullScreen="true"></iframe>
			</div>
			<div id="twitch-chat">
				<iframe src="http://www.twitch.tv/weareb0b/chat?popout=" class="iframe-tchat" frameborder="0" scrolling="no" height="545" width="350"></iframe>
			</div>
		<?= $this->fetch('content') ?>
			<div class="infosLive">
				<h2 style="margin: 0; color: white;">
					<center>
						<font color="#962935"><?php if(isset($twitchApi->InfoStream['followers'])){echo $twitchApi->InfoStream['followers'];}?></font> - FOLLOWERS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<font color="#962935"><?php if(isset($twitchApi->InfoLive['viewers'])){echo $twitchApi->InfoLive['viewers'];}?></font> PERSONNES REGARDENT LE LIVE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						DANS LE JEU : <font color="#962935"><?php if(isset($twitchApi->InfoLive['game'])){echo $twitchApi->InfoLive['game'];}?></font>
					</center>
				</h2>
			</div>
			<div class="hr" style="margin-top: 600px;"></div>
			<div>
				<?= $this->element('prog');?>
			</div>
		</div>
		<div id="sidebar-right">
		</div>

		<footer>
			<p>© 2015-2016 Wab TV, Tous Droits Réservés.</br>Politique de confidentialité - <?php echo $this->Html->link('Mentions légale', '/pages/mentions_legales'); ?> - <?php echo $this->Html->link('Conditions d\'Utilisation', '/pages/conditions_generales'); ?></p>
		</footer>
</div>
</div>
</body>
</html>
